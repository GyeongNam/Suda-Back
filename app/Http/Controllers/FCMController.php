<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use DB;

class FCMController extends Controller
{
    //
    public function fcm(){
      // $sql = "Select Token From users Where id = test";

        $result = DB::table('users')->select("Token")->get();
        $tokens = array();

        if(sizeof($result) > 0 ){
            foreach ($result as $Rresult) {
                $tokens[] = $Rresult->Token;
            }
        }

        $myMessage = "새글이 등록되었습니다.";

        $message = array("message" => $myMessage);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
                    'registration_ids' => $tokens,
                    'data' => $message
                );

        $headers = array(
                'Authorization:key =' . 'AAAA9066qgY:APA91bE6OlNYEv2zXEIH7pfPwMElEKBZxK81i99QJ30gKu47Vt9Hc6jvDQxhD_RnSXD0V4AEkPyV_FkBUEMFahAuvUpgCpxzA9EoolMhgOaOf7FEHOKOJzRq3DF3QrNcSXkf8QnVsEdI'
                ,'Content-Type:application/json'
                );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // return $fields;
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        echo $result;
    }
}