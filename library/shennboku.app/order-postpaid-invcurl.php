<?php
if(!isset($call) && !isset($provider) && !isset($data_prv))
    die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
    
if($provider == 'DIGI') {
    $try_check = $DIGI->CheckBill($web_token,$tgt_token,$ShennTRX);
    if($try_check['result'] == true) {
        $out_bills = $try_check['data']['price'];
        $out_name = $try_check['data']['customer_name'];
        $out_res = true;
        $out_no = $try_check['data']['customer_no'];
    } else {
        $out_msg = (isset($try_check['message'])) ? $try_check['message'] : 'Connection Failed';
    }
}