<?php
if (!isset($call) && !isset($provider) && !isset($data_prv))
    die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");

if ($provider == 'MAUPEDIA') {
    $try = $curl->connectPost($data_prv['link'] . 'prepaid', ['key' => $data_prv['apikey'], 'sign' => sha1($data_prv['userid'] . $data_prv['apikey']), 'secret' => $data_prv['secretkey'], 'type' => 'order', 'service' => $web_token, 'data_no' => $tgt_token]);
    if ($try['result'] == true) {
        $req_result = true;
        $req_provid = $try['data']['trxid'];
        $req_status = $try['data']['status'];
        $req_lastbl = $try['data']['balance'];
        $req_note = ($try['message'] == '') ? 'Pesanan Anda akan segera diproses.' : $try['message'];
    } else {
        $req_result = false;
        $req_message = isset($try['message']) ? $try['message'] : 'Connection Failed!';
    }
} else if($provider == 'DIGI') {
    $try = $DIGI->Topup($web_token,$tgt_token,$ShennTRX);
    if($try['result'] == true) {
        $req_result = true;
        $req_provid = $try['data']['trxid'];
        $req_status = $try['data']['status'];
        $req_lastbl = $try['data']['balance'];
        $req_note = ($try['message'] == '') ? 'Pesanan Anda akan segera diproses.' : $try['message'];
    } else {
        $req_result = false;
        $req_message = isset($try['message']) ? $try['message'] : 'Connection Failed!';
    }
} else if($provider == 'VIP') {
   $try = $curl->connectPost($data_prv['link'] . 'prepaid', ['key' => $data_prv['apikey'], 'sign' => md5($data_prv['userid'] . $data_prv['apikey']), 'type' => 'order', 'service' => $web_token, 'data_no' => $tgt_token]);
    if ($try['result'] == true) {
        $req_result = true;
        $req_provid = $try['data']['trxid'];
        $req_status = $try['data']['status'];
        $req_lastbl = $try['data']['balance'];
        $req_note = ($try['message'] == '') ? 'Pesanan Anda akan segera diproses.' : $try['message'];
    } else {
        $req_result = false;
        $req_message = isset($try['message']) ? $try['message'] : 'Connection Failed!';
    }
}else if ($provider == 'X') {
    $req_result = true;
    $req_provid = $ShennTRX;
    $req_status = 'waiting';
    $req_note = 'Your order will be processed immediately.';
    // $try = TrxNotifier($sess_username,$service,$tgt_token);
    // if($try['result'] == true) {
    //     $req_result = true;
    //     $req_provid = $ShennTRX;
    //     $req_status = 'waiting';
    //     $req_note = 'Pesanan akan diproses secepatnya.';
    // } else {
    //     $req_result = false;
    //     $req_message = 'Gagal melakukan pemesanan, silahkan coba lagi nanti.';
    // }
}
