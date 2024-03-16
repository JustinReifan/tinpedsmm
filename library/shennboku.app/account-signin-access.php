<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['del_cookie'])) {
    $post_1 = filter(base64_decode($_POST['web_token']));
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if($call->query("SELECT * FROM users_cookie WHERE cookie = '$post_1' AND username = '$sess_username'")->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Akses Masuk tidak ditemukan.']);
    } else {
        if($call->query("DELETE FROM users_cookie WHERE cookie = '$post_1' AND username = '$sess_username'") == true) {
            ShennXit(['type' => true,'message' => 'Akses Masuk telah dihapus.']);
        } else {
            ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nanti.']);
        }
    }
}