<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Sms_history extends Model
{
    use HasFactory;
    protected $table = 'sms_history';

    public static function SendSms($mobile,$sms) {
        $url = 'https://www.24bulksmsbd.com/api/smsSendApi';
        $data = array(
            'customer_id'   => 1196,
            'api_key'       => 'a0aa3280fd9c058c382985dc5a4731f5c3df5d6de09ad',
            'message'       => $sms,
            'mobile_no'     => $mobile
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($curl);
        curl_close($curl);

        if($result === false){
            echo sprintf('<span>%s</span>CURL error:', curl_error($curl));
            return;
        }

        $response = (!empty($result)?json_decode($result,true):'');

        if (!empty($response['status']) && $response['status'] == 'ok') {
            return "SUCCESS";
        }else{
            return "ERROR";
        }
    }
    public static function successStatus($update_id,$sending_status){
        if ($sending_status == 'SUCCESS') {
            $affectedRows = DB::table('sms_history')
                ->where('id', $update_id)
                ->update(['success_status_sms' => 1, 'send_sms_status' => 2]);

            if ($affectedRows > 0) {
                return 'successfully sent sms';
            } else {
                return 'failed to send sms';
            }
        } else {
            $affectedRows = DB::table('sms_history')
                ->where('id', $update_id)
                ->update(['success_status_sms' => 2, 'send_sms_status' => 2]);

            if ($affectedRows > 0) {
                return 'failed to send sms system error';
            } else {
                return 'failed to send sms';
            }
        }
    }
}

