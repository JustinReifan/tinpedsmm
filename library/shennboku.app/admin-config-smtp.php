<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['savesmtp'])) {
    $post_1 = filter($_POST['mailer_host']);
    $post_2 = filter($_POST['mailer_user']);
    $post_3 = filter($_POST['mailer_pass']);
    $post_4 = filter($_POST['mailer_from']);
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(!in_array($data_user['level'],['Admin'])) {
        ShennXit(['type' => false,'message' => 'Anda tidak memiliki akses untuk menggunakan fitur ini.']);
    } else {
        if($call->query("UPDATE conf SET c1 = '$post_1', c2 = '$post_2', c3 = '$post_3', c4 = '$post_4' WHERE code = 'mailer'") == true) {
            ShennXit(['type' => true,'message' => 'SMTP Mailer updated.']);
        } else {
            ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nanti.']);
        }
    }
}