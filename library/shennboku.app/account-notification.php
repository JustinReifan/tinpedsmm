<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_GET['shennboku']) && isset($_POST['app']) && isset($_POST['type'])) {
    if(!in_array($_POST['app'],['browser'])) die(sessResult(false, 'Invalid App.'));
    if($result_csrf == false) {
        print sessResult(false, 'Kesalahan Sistem, silakan coba lagi nanti.');
    } else if($_CONFIG['lock']['status'] == true) {
        print sessResult(false, $_CONFIG['lock']['reason']);
    } else if(!in_array($data_user['level'],['Admin'])) {
        print sessResult(false, 'Anda tidak memiliki akses untuk menggunakan fitur ini.');
    } else {
        $json_user['notification'][$_POST['app']][filter($_POST['type'])] = (getUserNotif($sess_username, $_POST['app'], filter($_POST['type'])) == true) ? 'false' : 'true';
        if($call->query("UPDATE users SET info = '".json_encode($json_user)."' WHERE username = '$sess_username'")) {
            print sessResult(true, 'Perubahan telah berhasil dilakukan.');
        } else {
            print sessResult(false, 'Server kami sedang bermasalah, silakan coba lagi nanti.');
        }
    }
    die;
}