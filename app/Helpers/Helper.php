<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use App\Models\ProcedureTrialMark;

function IntoString($int)
{
        if($int == 1) {
            $string = "1st";
        }elseif($int == 2) {
            $string = "2nd";
        }elseif($int == 3) {
            $string = "3rd";
        }else{
             $string = $int."th";
        }
        return $string;
}


if (!function_exists('send_sms')) {
    function send_sms($recipient, $otp_code)
    {

        $url = 'http://online.chennaisms.com/api/mt/SendSMS';
        $queryParams = http_build_query([
            'user' => 'kirshi',
            'password' => 'india123',
            'senderid' => 'CHNNAI',
            'channel' => 'Trans',
            'DCS' => '0',
            'flashsms' => '0',
            'number' => '91'.$recipient,
            'text' => $otp_code.' is your OTP. Valid for 2mins.MedismVr CEPC',
            'route' => '6',
        ]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if($err) {
           Log::channel('medism')->debug('SMS error '.$err);
        }else{
            Log::channel('medism')->debug('SMS Send Success '.$recipient);
        }

    }
}


        