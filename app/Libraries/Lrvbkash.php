<?php
namespace App\Libraries;
use View, Input, Log, Session;
use Illuminate\Support\Facades\Request;
use App\Models\Order;
/**
 * Description of Cibkash
 *
 * @author tahsin
 */
class Lrvbkash {

    protected $_lrvbkash_username;
    protected $_lrvbkash_password;
    protected $_lrvbkash_msisdn;
    protected $_lrvbkash_reference_number_length;
    protected $_lrvbkash_appkey;
    protected $_lrvbkash_appsecret;
    protected $_lrvbkash_ipn_username;
    protected $_lrvbkash_ipn_password;
    protected $_lrvbkash_url;
    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function __construct($appKey = null, $appSecret = null, $username = null, $password = null, $bkash_checkout_type = 'live') {
       
        // $this->_lrvbkash_username = "SALEBUY100";
        // $this->_lrvbkash_password = "s4aL3phA8O9b";
        // $this->_lrvbkash_msisdn = "01713244420";

        $this->_lrvbkash_username = "CTMTLTD";
        $this->_lrvbkash_password = "Cp2#ghW101s";
        $this->_lrvbkash_msisdn = "01842044455";

        // $this->_lrvbkash_appkey = '5tunt4masn6pv2hnvte1sb5n3j';
        // $this->_lrvbkash_appsecret = '1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka';
        // $this->_lrvbkash_ipn_username = 'sandboxTestUser';
        // $this->_lrvbkash_ipn_password = 'hWD@8vtzw0';
        
        // logger($appKey);
        // logger($appSecret);
        // logger($username);
        // logger($bkash_checkout_type);
        if($appKey && $appSecret && $username && $password) {

            $this->_lrvbkash_appkey = $appKey;
            $this->_lrvbkash_appsecret = $appSecret;
            $this->_lrvbkash_ipn_username = $username;
            $this->_lrvbkash_ipn_password = $password;

        } else {

            $this->_lrvbkash_appkey = env('BKASH_PGW_APPKEY');
            $this->_lrvbkash_appsecret = env('BKASH_PGW_APPSECRET');
            $this->_lrvbkash_ipn_username = env('BKASH_PGW_USERNAME');
            $this->_lrvbkash_ipn_password = env('BKASH_PGW_PASSWORD');
        }

        if($bkash_checkout_type == 'live'){
            $this->_lrvbkash_url = env('BKASH_PGW_URL');
        }else{
            $this->_lrvbkash_url = env('BKASH_PGW_URL_SANDBOX');
        }
        
        date_default_timezone_set('Asia/Dhaka');
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function response($request) {
        if (Request::isMethod('post')) {
            $msisdn = $this->_lrvbkash_msisdn;
            $tran_id = $request->input('lrvbkash_transaction_id');
            $total_amount = $request->input('total_amount');
            if (!Order::where('transaction_id', '=', $tran_id)->count()) {
                $reference_number = $request->input('lrvbkash_reference_number');
                $request = array(
                    'user' => $this->_lrvbkash_username,
                    'pass' => $this->_lrvbkash_password,
                    'msisdn' => $msisdn,
                    'trxid' => $tran_id,
                );
                $data_string = json_encode($request);
                $curl = curl_init('https://www.bkashcluster.com:9081/dreamwave/merchant/trxcheck/sendmsg');
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                $response = curl_exec($curl);
                Log::error($response);
                $response_object = json_decode($response);
                var_dump(!is_object($response_object));
                if (!is_object($response_object) || $response_object->transaction->trxStatus != '0000') {
                    Log::error('bKash failed: ' . curl_error($curl) . '(' . curl_errno($curl) . ')');
                }
                curl_close($curl);
                if ($response_object->transaction->trxStatus == '0000') {
                    $tran_time = strtotime($response_object->transaction->trxTimestamp);
                    $difftime = (time() - $tran_time);
                    $oneday = 10 * 24 * 60 * 60;
                    if ($difftime < $oneday||1) {
                        if ($total_amount == $response_object->transaction->amount) {
                            return $response_object->transaction;
                        } else {
                            Log::error('Invalid transaction: Transaction amount mismatch.');
                            Session::flash('not_fade_error', 'Invalid transaction: Transaction amount mismatch.');
                            return false;
                        }
                    } else {
                        Log::error('Invalid transaction: Transaction expired (older than one day).');
                        Session::flash('not_fade_error', 'Invalid transaction: Transaction expired (older than one day).');
                        return false;
                    }
                } else {
                    Log::error('bKash failed: ' . $this->responseMessage($response_object->transaction->trxStatus) . 'Status Code: ' . $response_object->transaction->trxStatus);
                    Session::flash('not_fade_error', 'bKash failed: ' . $this->responseMessage($response_object->transaction->trxStatus));
                    return false;
                }
            } else {
                Log::error('Invalid transaction: Transaction ID already in use.');
                Session::flash('not_fade_error', 'Invalid transaction: Transaction ID already in use.');
                return false;
            }
        }
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function responseMessage($code) {
        switch ($code) {
            case '0000':
                return 'Transaction Successful: trxID is valid and transaction is successful.';
            case '0010':
            case '0011':
                return 'Transaction Pending: trxID is valid but transaction is in pending state.';
            case '0100':
                return 'Transaction Reversed: trxID is valid but transaction has been reversed.';
            case '0111':
                return 'Transaction Failure: trxID is valid but transaction has failed.';
            case '1001':
                return 'Format Error: Invalid MSISDN input. Try with correct mobile no.';
            case '1002':
                return 'Invalid Reference: Invalid trxID, it does not exist.';
            case '1003':
                return 'Authorization Error: Access denied. Username or Password is incorrect.';
            case '1004':
                return 'Authorization Error: Access denied. trxID is not related to this username.';
            case '4001':
                return 'Please try after 5 minutes.';
            case '9999':
                return 'System Error: Could not process request.';
        }
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function generate_random_letters($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function generate_random_numbers($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 9);
        }
        return $random;
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function process()
    {
        $tokens = $this->__create_accesstoken();
        $payment_response = $this->__create_payment($tokens);
        
        $execute_payment_response = $this->__execute_payment($tokens, $payment_response);
        
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function create_accesstoken()
    {
        // logger($this->_lrvbkash_appkey);
        // logger($this->_lrvbkash_appsecret);
        // logger($this->_lrvbkash_ipn_username);
        // logger($this->_lrvbkash_ipn_password);
        // logger($this->_lrvbkash_url);

        $request = array(
            'app_key' => $this->_lrvbkash_appkey,
            'app_secret' => $this->_lrvbkash_appsecret
        );
        $data_string = json_encode($request);
        
        $url =  $this->_lrvbkash_url .'/checkout/token/grant';
        // $url = 'https://checkout.sandbox.bka.sh/v1.0.0-beta/checkout/token/grant';
        $headers = array(
            'Content-Type: application/json',
            'password: ' . $this->_lrvbkash_ipn_password,
            'username: ' . $this->_lrvbkash_ipn_username
        );
        $response_object = $this->__process_curl($url, $headers, $data_string);
        // logger($url);
        // logger($headers);
        // logger($data_string);
        // logger($response_object);
        return $response_object;
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function create_payment($id_token, $amount)
    {
        $request = array(
            'amount' => $amount,//$request->input('amount'),
            'currency' => "BDT",
            'intent' => "sale",
            'merchantInvoiceNumber' => uniqid() //$request->input('order_id')
        );
        $data_string = json_encode($request);
        $url = $this->_lrvbkash_url . '/checkout/payment/create';
        $headers = array(
            'Content-Type: application/json',
            'authorization: ' . $id_token,
            'x-app-key: ' . $this->_lrvbkash_appkey
        );
        $response_object = $this->__process_curl($url, $headers, $data_string);
        // logger($headers);
        // logger($response_object);
        return $response_object;
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    public function execute_payment($id_token, $paymentID)
    {
        $url = $this->_lrvbkash_url . '/checkout/payment/execute/'. $paymentID;
        
        $headers = array(
            'Content-Type: application/json',
            'authorization: ' . $id_token,
            'x-app-key: ' . $this->_lrvbkash_appkey
        );
        $response_object = $this->__process_curl($url, $headers);
        // logger($headers);
        // logger($response_object);
        return $response_object;
    }

    /*
     * @author Tahsin Hasan <http://newdailyblog.blogspot.com>
     */
    private function __process_curl($url, $headers, $data_string = null)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($data_string)){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        $response_object = json_decode($response, true);
        curl_close($curl);
        return $response_object;
    }
}
