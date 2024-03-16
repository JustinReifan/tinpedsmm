<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['submitvcr'])) {
    $post_rid = date('YmdHis').random_number(2);
    $post_code = strtoupper(filter($_POST['keycode']));
    
    $search_voc = $call->query("SELECT * FROM voucher WHERE code = '$post_code' AND status = 'available'");
    $data_voc = $search_voc->fetch_assoc();
    $vocvalue = $data_voc['value'];
    

    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);    
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);    
    } else if($search_voc->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Kode Voucher tidak ditemukan.']);
    } else if(LannCheckVocOwn($data_voc['own'], $sess_username) == true) {
        ShennXit(['type' => false,'message' => 'Voucher tidak dapat ditukarkan sebagai akun sendiri.']);
    } else if($call->query("SELECT wid FROM deposit WHERE wid = '$post_rid'")->num_rows > 0) {
        ShennXit(['type' => false,'message' => 'Sistem bentrok, silakan coba lagi.']);
    } else {                        
        $in = $call->query("INSERT INTO deposit VALUES ('','$post_rid','$sess_username','voucher','Voucher Code','Reff: $post_code','','0','0','$vocvalue','paid','$date $time')");
        if(isset($in) == true) {
            $call->query("INSERT INTO mutation VALUES ('','$sess_username','+','$vocvalue','Voucher $post_code :: $post_rid','$date $time')");
            $call->query("UPDATE users SET balance = balance+$vocvalue WHERE username = '$sess_username'");
            $call->query("UPDATE voucher SET user = '$sess_username', status = 'used', date_up = '$date $time' WHERE code = '$post_code'");
            ShennXit(['type' => true,'message' => 'Anda mendapatkan saldo tambahan sebesar '.currency($vocvalue).' dari Kode Voucher.']);
        } else {
            ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nanti.']);
        }
    }
}