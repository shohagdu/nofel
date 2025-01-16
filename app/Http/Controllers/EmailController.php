<?php

namespace App\Http\Controllers;

use App\Models\Sms_history;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;
use DB;
class EmailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Test Email',
            'message' => 'This is a test email sent from Laravel using cPanel.'
        ];

        Mail::to('omarshohag93@gmail.com')->send(new ExampleMail($details));

        return 'Email sent successfully!';
    }

    public function sendSms(){
        $i=1;
        $sms_history    =[];
        $sms            = Sms_history::where(['send_sms_status'=>1])->limit(10)->get();
        if(count($sms)>0){
           foreach ($sms as $row){
               $sms_status= Sms_history::SendSms($row->mobile_number,$row->msg);
               $sms_history[]=Sms_history::successStatus($row->id,$sms_status);
               $i++;
           }
        }else{
            echo "No Record Found";
        }
        if(!empty($sms_history)){
            echo "<pre>";
            print_r($sms_history);
        }
    }
}
