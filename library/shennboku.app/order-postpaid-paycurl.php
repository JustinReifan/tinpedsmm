<?php
if(!isset($call) && !isset($provider) && !isset($data_prv))
    die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
    
if($provider == 'DIGI') {
    $try = $DIGI->PayBill($web_token,$tgt_token,$ShennTRX);
    if($try['result'] == true) {
        $req_result = true;
        $req_provid = $try['data']['trxid'];
        $req_status = $try['data']['status'];
        $req_lastbl = $try['data']['balance'];
        $req_note = ($try['message'] == '') ? 'Your order will be processed immediately.' : $try['message'];
    } else {
        $req_message = isset($try['message']) ? $try['message'] : 'Connection Failed!';
    }
}