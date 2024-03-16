<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['sendautemail'])) {
    $pst_email = filter($_POST['email']);
    $su = $call->query("SELECT * FROM users WHERE email = '$pst_email'");
    if($su->num_rows == 1) {
        $du = $su->fetch_assoc();
        $dc = json_decode($du['info'], true);
        $_CONFIG['lock'] = check_lock($du['username']);
    }

    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if($su->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Email tidak terdaftar.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else {
        $New_OTP = random_number(6);
        $dc['change_password']['code'] = $New_OTP;
        $dc['change_password']['date_create'] = "$date $time";
        $dc['change_password']['date_resend'] = "$date $time";
        $dc['change_password']['date_expired'] = rdate('Y-m-d H:i:s', '+8 hours');
        $dc['change_password']['count_resend'] = 0;

        
        $send = mailer($_MAILER, [
            'dest' => $du['email'],
            'name' => $du['name'],
            'subject' => 'Code for '.$_CONFIG['title'],
            'message' => base64_encode(file_get_contents(base_url('library/layout-mail/confirm-password?name='.urlencode($du['name']).'&code='.$New_OTP))),
            'is_template' => 'yes',
        ]);
        

        if(isset($send) == true) {
            if($call->query("UPDATE users SET info = '".json_encode($dc)."' WHERE username = '".$du['username']."'") == true) {
$WASENDER->SendMessage("
Hallo ".$du['username']."
Kode OTP PASSWORD Anda  : *".$New_OTP."*
Jika Anda tidak mengenali aktivitas ini, segera hubungi CS admin nurulsmmpedia2.
             
Hormat Kami
- nurulsmmpedia2
", $du['phone']);

// $WATL->sendMessage($apikey, $sender,  $du['phone'],
// "
// Hallo ".$du['username']."
// Kode OTP PASSWORD Anda  : *".$New_OTP."*
// Jika Anda tidak mengenali aktivitas ini, segera hubungi CS admin nurulsmmpedia2.
             
// Hormat Kami
// - nurulsmmpedia2
// ");
                $_SESSION['changepass'] = $du['email'];
                ShennXit(['type' => true,'message' => 'Kode OTP telah berhasil dikirim ke Email/No WhatsApp Anda.']);
            } else {
                ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nanti.']);
            }
        } else {
            ShennXit(['type' => false,'message' => 'Gagal Mengirim OTP, silakan coba lagi nanti.']);
        }
    }
}
    
if(isset($_POST['resend']) && isset($_SESSION['changepass'])) {
    $pst_email = filter($_SESSION['changepass']);
    $su = $call->query("SELECT * FROM users WHERE email = '$pst_email'");
    if($su->num_rows == 1) {
        $du = $su->fetch_assoc();
        $dc = json_decode($du['info'], true);
        $_CONFIG['lock'] = check_lock($du['username']);
    }
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if($su->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Email tidak terdaftar.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(strtotime($dc['change_password']['date_expired']) < strtotime($dtme)) {
        ShennXit(['type' => false,'message' => 'Kode telah melampaui batas waktu, harap ulangi permintaan reset kata sandi.']);
    } else if($dc['change_password']['count_resend'] >= 3) {
        ShennXit(['type' => false,'message' => 'Batas pengiriman ulang kode adalah 3 kali.']);
    } else if(date_diffs($dc['change_password']['date_resend'],$dtme,'minute') < 1) {
        ShennXit(['type' => false,'message' => 'Kirim ulang kode hanya dapat dilakukan dalam 45 menit.']);
    } else {
        $dc['change_password']['date_resend'] = $dtme;
        $dc['change_password']['date_expired'] = rdate('Y-m-d H:i:s', '+8 hours');
        $dc['change_password']['count_resend'] += 1;
        $send = mailer($_MAILER, [
            'dest' => $du['email'],
            'name' => $du['name'],
            'subject' => 'Code for '.$_CONFIG['title'],
            'message' => base64_encode(file_get_contents(base_url('library/layout-mail/confirm-password?name='.urlencode($du['name']).'&code='.$dc['change_password']['code']))),
            'is_template' => 'yes'
        ]);
        if(isset($send) == true) {
            $call->query("UPDATE users SET info = '".json_encode($dc)."' WHERE username = '".$du['username']."'");
$WASENDER->SendMessage("
Hallo ".$du['username']."
Kode OTP PASSWORD Anda  : *".$dc['change_password']['code']."*
Jika Anda tidak mengenali aktivitas ini, segera hubungi CS admin nurulsmmpedia2.
             
Hormat Kami
- nurulsmmpedia2
", $du['phone']);
                $_SESSION['changepass'] = $du['email'];
            ShennXit(['type' => true,'message' => 'Kode OTP telah berhasil dikirim ke Email Anda.']);
        } else {
            ShennXit(['type' => false,'message' => 'Gagal Mengirim OTP, silakan coba lagi nanti.']);
        }
    }
}
    
if(isset($_POST['cancel']) && isset($_SESSION['changepass'])) {
    $pst_email = filter($_SESSION['changepass']);
    $su = $call->query("SELECT * FROM users WHERE email = '$pst_email'");
    if($su->num_rows == 0) ShennXit(['type' => false,'message' => 'Email tidak terdaftar.']);
    $du = $su->fetch_assoc();
    $dc = json_decode($du['info'], true);
    $dc['change_password']['date_expired'] = $dtme;
    if($call->query("UPDATE users SET info = '".json_encode($dc)."' WHERE username = '".$du['username']."'") == true) {
        unset($_SESSION['changepass']);
        ShennXit(['type' => true,'message' => 'Permintaan reset kata sandi berhasil dibatalkan.']);
    } else {
        ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nantiServer kami sedang bermasalah, silakan coba lagi nanti.']);
    }
}
    
if(isset($_POST['confirm']) && isset($_SESSION['changepass'])) {
    $pst_email = filter($_SESSION['changepass']);
    $pst_onetime = filter($_POST['otp']);
    $pst_password = filter($_POST['password']);
    $su = $call->query("SELECT * FROM users WHERE email = '$pst_email'");
    if($su->num_rows == 1) {
        $du = $su->fetch_assoc();
        $dc = json_decode($du['info'], true);
        $_CONFIG['lock'] = check_lock($du['username']);
    }
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if($su->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Email tidak terdaftar.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(strtotime($dc['change_password']['date_expired']) < strtotime($dtme)) {
        ShennXit(['type' => false,'message' => 'Kode telah melampaui batas waktu, harap ulangi permintaan reset kata sandi.']);
    } else if($pst_onetime <> $dc['change_password']['code']) {
        ShennXit(['type' => false,'message' => 'Kode yang dimasukkan salah.']);
    } else {
        $dc['change_password']['date_expired'] = $dtme;
        if($call->query("UPDATE users SET password = '".bcrypt($pst_password)."', info = '".json_encode($dc)."' WHERE username = '".$du['username']."'") == true) {
            $call->query("DELETE FROM users_cookie WHERE username = '".$du['username']."'");
            unset($_SESSION['changepass']);
            ShennXit(['type' => true,'message' => 'Kata sandi Anda telah berhasil diatur ulang, silakan masuk.']);
        } else {
            ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nanti.']);
        }
    }
}