<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkshopRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use URL;


class BkashController extends Controller
{
    private $base_url;
    private $username;
    private $password;
    private $app_key;
    private $app_secret;

    public function __construct()
    {
        env('SANDBOX') ? $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta' : $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
        $this->username = env('BKASH_USERNAME');
        $this->password = env('BKASH_PASSWORD');
        $this->app_key = env('BKASH_APP_KEY');
        $this->app_secret = env('BKASH_APP_SECRET');
    }
    public function authHeaders()
    {
        return array(
            'Content-Type:application/json',
            'Authorization:' . $this->grant(),
            'X-APP-Key:' . $this->app_key
        );
    }

    public function curlWithBody($url, $header, $method, $body_data)
    {
        $curl = curl_init($this->base_url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function getIdTokenFromRefreshToken($refresh_token){

	    $header = array(
            'Content-Type:application/json',
            'username:' . $this->username,
            'password:' . $this->password
        );

        $body_data = array('app_key' => $this->app_key, 'app_secret' => $this->app_secret, 'refresh_token' => $refresh_token);

        $response = $this->curlWithBody('/tokenized/checkout/token/refresh', $header, 'POST', json_encode($body_data));

        $idToken = json_decode($response)->id_token;

        return $idToken;

    }

    public function grant()
    {

        if (!Schema::hasTable('bkash_token')) {
//            DB::beginTransaction();
            Schema::create('bkash_token', function ($table) {
                $table->boolean('sandbox_mode')->notNullable();
                $table->bigInteger('id_expiry')->notNullable();
                $table->string('id_token', 2048)->notNullable();
                $table->bigInteger('refresh_expiry')->notNullable();
                $table->string('refresh_token', 2048)->notNullable();
            });
            $insertedRows = DB::table('bkash_token')->insert([
                'sandbox_mode' => 1,
                'id_expiry' => 0,
                'id_token' => 'id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'refresh_token',
            ]);

            if ($insertedRows > 0) {

                // echo 'Row inserted successfully.';
            } else {
                echo 'Error inserting row.';
            }



            $insertedRows = DB::table('bkash_token')->insert([
                'sandbox_mode' => 0,
                'id_expiry' => 0,
                'id_token' => 'id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'refresh_token',
            ]);

            if ($insertedRows > 0) {
                // echo 'Row inserted successfully.';

            } else {
                echo 'Error inserting row.';
            }
            // DB::commit();
        }


//        DB::beginTransaction();

        $sandbox = env('SANDBOX');

        $tokenData = DB::table('bkash_token')->where('sandbox_mode', $sandbox)->first();

        if ($tokenData) {
            // Access the token data
            $idExpiry = $tokenData->id_expiry;
            $idToken = $tokenData->id_token;
            $refreshExpiry = $tokenData->refresh_expiry;
            $refreshToken = $tokenData->refresh_token;

            if($idExpiry>time()){
                // dd("Id token from db: ".$idToken);
                return $idToken;
            }
            if($refreshExpiry>time()){
                $idToken = $this->getIdTokenFromRefreshToken($refreshToken);
                $updatedRows = DB::table('bkash_token')
                    ->where('sandbox_mode',$sandbox)
                    ->update([
                        'id_expiry' => time() + 3600, // Set new expiry time
                        'id_token' => $idToken,
                    ]);

                if ($updatedRows > 0) {
//                    DB::commit();
                    //echo 'Rows updated successfully.';
                } else {
                    //echo 'Error updating rows.';
                }
                // dd("Id token from refresh api: ".$idToken);
                return $idToken;
            }
            // Do something with the token data
        } else {
            echo 'Token not found.';
        }


        $header = array(
            'Content-Type:application/json',
            'username:' . $this->username,
            'password:' . $this->password
        );

        $body_data = array('app_key' => $this->app_key, 'app_secret' => $this->app_secret);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant', $header, 'POST', json_encode($body_data));

        $idToken = json_decode($response)->id_token;

        $updatedRows = DB::table('bkash_token')
            ->where('sandbox_mode',$sandbox)
            ->update([
                'id_expiry' => time() + 3600, // Set new expiry time
                'id_token' => $idToken,
                'refresh_expiry' => time() + 864000,
                'refresh_token' => json_decode($response)->refresh_token,
            ]);

        if ($updatedRows > 0) {
//            DB::commit();
            //echo 'Rows updated successfully.';
        } else {
            //echo 'Error updating rows.';
        }
        // dd("Id token from grant api: ".$idToken);
        return $idToken;


    }

    public function payment(Request $request)
    {
        return view('bkash.pay');
    }

//    public function createPayment(Request $request)
//    {
//        if(empty($request->applicantID) || empty($request->packageCategory) ||  empty($request->amount)){
//            return redirect('/registrationSuccess/'.$request->applicantID)->with('error', 'Mandatory Information Missing');
//        }
//        $id = (!empty($request->applicantID)? decrypt($request->applicantID) :NULL);
//        $applicantData = WorkshopRegistration::where('id', $id)->first();
//        if (empty($applicantData)) {
//            return redirect('/registration')->with('error', 'Applicant Information is required.');
//        }
//
//        $header         = $this->authHeaders();
//        $website_url    = URL::to("/");
//        if($request->packageCategory==1 ){
//            $durationPresent = $request->durationPresent;
//            if($request->durationPresent==1 && $request->amount!=3000){
//                return redirect('/registrationSuccess/'.$request->applicantID)->with('error', 'Amount is Mismatch, One Days(BDT 3000) !!');
//
//            }else if($request->durationPresent==2 && $request->amount!=3000){
//                return redirect('/registrationSuccess/'.$request->applicantID)->with('error', 'Amount is Mismatch, Both Days(BDT 5000) !!');
//            }
//        }elseif($request->packageCategory==2){
//            $durationPresent=3;
//            if($request->amount!=1){
//                return redirect('/registrationSuccess/'.$request->applicantID)->with('error', 'Amount is Mismatch, Trainee Both Days (BDT 3000) !!');
//            }
//        }
////        DB::enableQueryLog(); // Enable the query log
//
//        $applicantInfo = [
//            'package_category'    => $request->packageCategory ?? NULL,
//            'attend_days'         => $durationPresent ?? NULL,
//            'amount'              => $request->amount ?? NULL,
//            // 'payment_id'          => $responseData['paymentID'] ?? NULL,
//            // 'payment_status_code' => $responseData['statusCode'] ?? NULL,
//            'updated_time'        => date('Y-m-d H:i:s'),
//            'updated_ip'          => NULL,
//        ];
//
//        DB::table('workshop_registration')
//            ->where('id', $applicantData->id)
//            ->update($applicantInfo);
//
//// Get the last executed query
////        $queries = DB::getQueryLog();
////        $lastQuery = end($queries);
////        dd($lastQuery);
//
//
//        $body_data = array(
//            'mode'                  => '0011',
//            'payerReference'        => $request->payerReference ? $request->payerReference : ' ', // pass oderId or anything
//            'callbackURL'           => $website_url . '/bkash-callback',
//            'amount'                => $request->amount,
//            'currency'              => 'BDT',
//            'intent'                => 'sale',
//            'merchantInvoiceNumber' => $request->merchantInvoiceNumber ? $request->merchantInvoiceNumber : "Inv_" . Str::random(6)
//        );
//
//        $response = $this->curlWithBody('/tokenized/checkout/create', $header, 'POST', json_encode($body_data));
//        $responseData   = (!empty($response)? json_decode($response,true):'');
//
//
//
//        return redirect((json_decode($response)->bkashURL));
//    }

    public function createPayment(Request $request)
    {
        $validatedData = $request->validate([
            'applicantID'       => 'required|string',
            'packageCategory'   => 'required|integer',
            'amount'            => 'required|numeric',
        ]);

        try {
            $id = decrypt($validatedData['applicantID']);
        } catch (\Exception $e) {
            return redirect('/registration')->with('error', 'Invalid Applicant ID.');
        }

        $applicantData = WorkshopRegistration::find($id);

        if (!$applicantData) {
            return redirect('/registration')->with('error', 'Applicant Information is required.');
        }

        $durationPresent = null;
        if ($validatedData['packageCategory'] == 1) {
            $durationPresent = $request->durationPresent;
            if ($durationPresent == 1 && $validatedData['amount'] != 3000) {
                return redirect('/registrationSuccess/'.$validatedData['applicantID'])
                    ->with('error', 'Amount Mismatch: One Day (BDT 3000)');
            } elseif ($durationPresent == 2 && $validatedData['amount'] != 5000) {
                return redirect('/registrationSuccess/'.$validatedData['applicantID'])
                    ->with('error', 'Amount Mismatch: Both Days (BDT 5000)');
            }
        } elseif ($validatedData['packageCategory'] == 2) {
            $durationPresent = 3;
            if ($validatedData['amount'] != 3000) {
//            if ($validatedData['amount'] != 1) {
                return redirect('/registrationSuccess/'.$validatedData['applicantID'])
                    ->with('error', 'Amount Mismatch: Trainee Both Days (BDT 3000)');
            }


//            $applicantDegree = "m.bbs"; // Example input
            $applicantDegree    =   $applicantData->degree??NULL;
            $allowedValues = ["MBBS", "M.B.B.S", "mbbs", "m.b.b.s", "m.bbs"];

            if (in_array($applicantDegree, $allowedValues, true)) {
//                echo "Valid input.";
            } else {
                return redirect('/registrationSuccess/'.$validatedData['applicantID'])
                    ->with('error', 'Trainee Category Only MBBS degree Allow. Your provided degree is '.$applicantDegree. ". Please Change Payment Category");
            }
        }

        $bodyData = [
            'mode' => '0011',
            'payerReference' => $request->payerReference ?? ' ',
            'callbackURL' => URL::to('/bkash-callback'),
            'amount' => $validatedData['amount'],
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $request->merchantInvoiceNumber ?? 'Inv_' . Str::random(6),
        ];



        $response = $this->curlWithBody('/tokenized/checkout/create', $this->authHeaders(), 'POST', json_encode($bodyData));


        $responseData = !empty($response) ? json_decode($response, true) : null;
        if (empty($responseData) || !isset($responseData['bkashURL'])) {
            return redirect('/registrationSuccess/'.$validatedData['applicantID'])->with('error', 'Payment process failed.');
        }

        $applicantData->update([
            'package_category' => $validatedData['packageCategory'],
            'attend_days' => $durationPresent,
            'amount' => $validatedData['amount'],
            'payment_id'          => $responseData['paymentID'] ?? NULL,
            'payment_status_code' => $responseData['statusCode'] ?? NULL,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $request->ip(),
        ]);

        return redirect($responseData['bkashURL']);
    }


    public function executePayment($paymentID)
    {

        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );


        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', json_encode($body_data));

        return $response;
    }
    public function queryPayment($paymentID)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', json_encode($body_data));

        return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();
        if (isset($allRequest['status']) && $allRequest['status'] == 'success') {
            $response           =   $this->executePayment($allRequest['paymentID']);
            if(is_null($response)){
                sleep(1);
                $response = $this->queryPayment($allRequest['paymentID']);
            }
            $res_array = !empty($response)? json_decode($response, true):NULL;
            if (array_key_exists("statusCode", $res_array) && $res_array['statusCode'] == '0000' && array_key_exists("transactionStatus", $res_array) && $res_array['transactionStatus'] == 'Completed') {


                $applicantInfo=[
                    'is_payment_status'   =>  1,
                    'bkash_success_response'=> $response,
                    'to_bksah'            => NULL,
                    'bkash_mobile'        => $res_array['customerMsisdn']??NULL,
                    'bkash_trans_id'      => $res_array['trxID']??NULL,
                    'received_amount'     => $res_array['amount']??NULL,
                    'updated_at'          =>  date('Y-m-d H:i:s'),
                    'updated_ip'          =>  NULL,
                ];
                DB::table('workshop_registration')->where('payment_id',$res_array['paymentID'])->update($applicantInfo);


                $applicantData = WorkshopRegistration::where('payment_id',$res_array['paymentID'])->first();

                if(!empty($applicantData)) {
                    $applicantName  =  (!empty($applicantData->name)?$applicantData->name:'');
                    $applicantID    =  (!empty($applicantData->member_id)?$applicantData->member_id:'');
                    $msg    =   "Congrats! ". $applicantName.", Registration is Completed Successfully for 'BREASTBDCON 2025'. ID No ". $applicantID;
                    $smsEmail = [
                        'visitor_id'        => $applicantData->id??NULL,
                        'mobile_number'     => $applicantData->mobile??NULL,
                        'email'             => $applicantData->email??NULL,
                        'msg'               => $msg,
                        'send_sms_status'   => 1,
                        'send_email_status' => 1,
                        'ins_date'          => date('Y-m-d H:i:s'),
                        'ins_by'            => NULL,
                    ];
                    DB::table('sms_history')->insert($smsEmail);
                }
                return redirect('regSuccess/'.encrypt($applicantData->id));
               // return redirect('/registration')->with('success', 'Successfully Complete your registration Payment. TrxID is '.$res_array['trxID']);
            }

            return redirect('/registration')->with('error', $res_array['statusMessage']);
//
//            return view('bkash.fail')->with([
//                'response' => $res_array['statusMessage'],
//            ]);

        } else {
            return redirect('/registration')->with('error', 'Payment Cancelled !! Try to Again');

//            return view('bkash.fail')->with([
//                'response' => 'Payment Failed !!',
//            ]);
        }

    }
    public function getRefund(Request $request)
    {
        return view('bkash.refund');
    }

    public function refundPayment(Request $request)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'trxID' => $request->trxID
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', json_encode($body_data));

        $res_array = json_decode($response, true);

        $message = "Refund Failed !!";

        if (!isset($res_array['refundTrxID'])) {

            $body_data = array(
                'paymentID' => $request->paymentID,
                'amount' => $request->amount,
                'trxID' => $request->trxID,
                'sku' => 'sku',
                'reason' => 'Quality issue'
            );

            $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', json_encode($body_data));

            $res_array = json_decode($response, true);

            if (isset($res_array['refundTrxID'])) {
                // your database insert operation
                $message = "Refund successful !!.Your Refund TrxID : " . $res_array['refundTrxID'];
            }

        } else {
            $message = "Already Refunded !!.Your Refund TrxID : " . $res_array['refundTrxID'];
        }

        return view('bkash.refund')->with([
            'response' => $message,
        ]);
    }

    public function queryPaymentAPI(Request $request,$paymentID)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', json_encode($body_data));

        return $response;
    }


    public function getSearchTransaction(Request $request)
    {
        return view('bkash.search');
    }

    public function searchTransaction(Request $request)
    {

        $header = $this->authHeaders();
        $body_data = array(
            'trxID' => $request->trxID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/general/searchTransaction', $header, 'POST', json_encode($body_data));


        return view('bkash.search')->with([
            'response' => $response,
        ]);
    }

}
