<?php 
$api_id = "3582";
$api_key = "6befde-2fa199-6d6ad4-bfaccd-17c4ea";
$data = "api_id=$api_id&api_key=$api_key";
$endpoint = "https://lollipop-smm.com/api/profile";

    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $chresult = curl_exec($ch);
            curl_close($ch);
            $json_result = json_decode($chresult, true);

var_dump($json_result);

