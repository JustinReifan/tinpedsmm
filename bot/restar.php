<?php
require '../connect.php';

    
$key = $keyWapi;
$device = $deviceWapi;


$postdata = "api_key=$key&device_key=$device";

curl_close($curl);
echo $response;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://wapisender.id/api/v1/restart-device");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$result_data = json_decode($chresult, true);

echo $chresult;

