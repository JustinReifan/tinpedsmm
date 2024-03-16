<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
// $closeRegist = true;

$get_verif_code = isset($_GET['code']) ? filter($_GET['code']) : '- - - - - -';
if(isset($_POST['sendOTP'])) {
    $pst_mail = isset($_POST['mail']) ? filter($_POST['mail']) : '';
    $pst_name = isset($_POST['name']) ? ucwords(strtolower(filter($_POST['name']))) : '';
    $pst_user = isset($_POST['user']) ? filter($_POST['user']) : '';
    $pst_phone = isset($_POST['phone']) ? filter_phone('62',$_POST['phone']) : '';
    $pst_pin = isset($_POST['pin']) ? filter($_POST['pin']) : '';
    $pst_pas1 = isset($_POST['pas1']) ? filter($_POST['pas1']) : '';
    $pst_pas2 = isset($_POST['pas2']) ? filter($_POST['pas2']) : '';
    $pst_code = isset($_POST['code']) ? filter($_POST['code']) : '';
    
    $expMail = explode('@', $pst_mail);
    $accMail = ['gmail.com','yahoo.com','outlook.com','icloud.com'];
    

    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if(isset($closeRegist)) {
        ShennXit(['type' => false,'message' => 'Pendaftaran ditutup.']);
    } else if($_CONFIG['mt']['web'] == 'true') {
        ShennXit(['type' => false,'message' => 'Ada pemeliharaan sistem situs web, silakan coba lagi nanti.']);
    } else if($gcaptcha_use == true && $gcaptcha['success'] == false) {
        ShennXit(['type' => false,'message' => 'reCaptcha tidak valid.']);
    } else if(!isset($expMail[1]) || !$pst_name || !$pst_user || !$pst_phone || !$pst_pin || !$pst_pas1 || !$pst_pas2) {
        ShennXit(['type' => false,'message' => 'Masih ada formulir kosong.']);
    } else if(!in_array($expMail[1], $accMail)) {
        ShennXit(['type' => false,'message' => 'Anda tidak dapat mendaftar menggunakan email ini.']);
    } else if($pst_pas1 <> $pst_pas2) {
        ShennXit(['type' => false,'message' => 'Konfirmasi kata sandi tidak cocok.']);
    } else if(strlen($pst_pin) != 6 || !is_numeric($pst_pin)) {
        ShennXit(['type' => false,'message' => 'Pin harus berisi 6 digit angka.']);
    } else if($_POST['accepttos'] != 'true') {
        ShennXit(['type' => false,'message' => 'Apakah Anda setuju dengan Persyaratan Layanan.']);
    } else if($call->query("SELECT id FROM users WHERE username = '$pst_user'")->num_rows == 1) {
        ShennXit(['type' => false,'message' => 'Nama pengguna telah terdaftar.']);
    } else if($call->query("SELECT phone FROM users WHERE phone = '$pst_phone'")->num_rows == 1) {
        ShennXit(['type' => false,'message' => 'Nomor telepon telah terdaftar.']);
    } else if($call->query("SELECT phone FROM users WHERE info LIKE '%\"new_phone\": \"$pst_phone\"%'")->num_rows == 1) {
        ShennXit(['type' => false,'message' => 'Nomor telepon telah terdaftar pada perubahan.']);
    } else if($call->query("SELECT email FROM users WHERE email = '$pst_mail'")->num_rows == 1) {
        ShennXit(['type' => false,'message' => 'Alamat email telah didaftarkan.']);
    } else if($call->query("SELECT email FROM users WHERE info LIKE '%\"new_email\": \"$pst_mail\"%'")->num_rows == 1) {
        ShennXit(['type' => false,'message' => 'Alamat email telah didaftarkan pada perubahan.']);
    } else {
        $pst_name = ucwords(strtolower(preg_replace('/[^A-Za-z ]/', '', $pst_name)));
        $pst_user = ucwords(strtolower(preg_replace('/[^A-Za-z0-9 ]/', '', $pst_user)));
        $uplink = $call->query("SELECT id FROM users WHERE referral = '$pst_code'")->num_rows == 1  ? $pst_code : 'SYSTEM';

        
        $waValid = (!empty(conf('atlantic-cfg', 4))) ? true : false;
        $_SESSION['temp']['whatsapp'] = ($waValid == true) ? random_number(6) : false;
        $_SESSION['temp']['email'] = random(12);
        $_SESSION['temp']['data'] = [
            'name' => $pst_name,
            'email' => $pst_mail,
            'phone' => $pst_phone,
            'username' => $pst_user,
            'password' => bcrypt($pst_pas1),
            'secure' => bcrypt($pst_pin),
            'uplink' => $uplink
        ];
        
        $send_mail = mailer($_MAILER, [
            'dest' => $pst_mail,
            'name' => $pst_name,
            'subject' => 'Code for '.$_CONFIG['title'],
            'message' => base64_encode(file_get_contents(base_url('library/layout-mail/confirm-email?name='.urlencode($pst_name).'&code='.$_SESSION['temp']['email']))),
            'is_template' => 'yes'
        ]);

  // <!--setting geteway whatsap di sini --> // <!--setting geteway whatsap di sini -->
   // <!--setting geteway whatsap di sini -->
    // <!--setting geteway whatsap di sini -->
     // <!--setting geteway whatsap di sini -->
      // <!--setting geteway whatsap di sini -->
$pesan = "Hallo $pst_name
*Pastikan anda memasukan huruf kecil dan besar dengan teliti dan benar.*\n
Kode OTP Registrasi Anda :\n *".$_SESSION['temp']['email']."*

Jika Anda tidak mengenali aktivitas ini, segera hubungi CS admin TINPED
wa.me/6281932888380
             
Hormat Kami
- TINPED
";


$data = [
    'api_key' => 'dc69b4ee8a8767ab8fd074b5d7b17ded6b127ab0',
    'sender'  => '6287765245261',
    'number'  => $pst_phone,
    'message' => $pesan
];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://wagetewayv4.tinped.com/app/api/send-message",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($data))
);

$response = curl_exec($curl);

curl_close($curl);
 // <!--setting geteway whatsap di sini --> // <!--setting geteway whatsap di sini -->
   // <!--setting geteway whatsap di sini -->
    // <!--setting geteway whatsap di sini -->
     // <!--setting geteway whatsap di sini -->
      // <!--setting geteway whatsap di sini -->
        $send_whats = (isset($send_mail) == true) ? (($waValid == false) ? ['result' => true] : $WASENDEsR->SendMessage("*Halo $pst_user*\n*Kode OTP anda adalah* ".$_POST['code']." \n  ```".$_SESSION['temp']['whatsapp']."``` \n* -".$_CONFIG['title']."*",  $pst_phone)) : ['result' => false];
        // $send_whats = ($send_mail == true) ? (($waValid == false) ? ['result' => true] : $WATL->sendMessage( $pst_phone, "*Halo $pst_user*\n*Kode OTP anda adalah* ```".$_SESSION['temp']['whatsapp']."```\n*- ".$_CONFIG['title']."*")) : ['result' => false];
        
        
        
        if(isset($send_mail) == true && isset($send_whats['result']) == true) {
        //   $WATL->sendMessage($apikey, $sender, $pst_phone, "*Halo $pst_user*\n*Kode OTP anda adalah* ```".$_SESSION['temp']['email']."```\n*- ".$_CONFIG['title']."*");
//           $WATL->sendMessage($apikey, $sender,  $pst_phone,
// "
// Salam $pst_name

// Kode OTP Registrasi Anda : *".$_SESSION['temp']['email']."*

// Jika Anda tidak mengenali aktivitas ini, segera hubungi CS admin TINPED.
             
// Hormat Kami
// - TINPED
// ");

$WASENDER->SendMessage("
Hallo $pst_name
Kode OTP Registrasi Anda : *".$_SESSION['temp']['email']."*

Jika Anda tidak mengenali aktivitas ini, segera hubungi CS admin TINPED.
             
Hormat Kami
- TINPED
", $pst_phone);
            $msg = (isset($waValid) == true) ? ' and whatsapp' : '';
            ShennXit(['type' => true,'message' => 'OTP telah berhasil terkirim, silahkan cek inbox,whatsapp atau email spam anda'.$msg.'.']);
        } else {
            unset($_SESSION['temp']);
            ShennXit(['type' => false,'message' => 'Gagal mengirim OTP.']);
        }
    }
} if(isset($_SESSION['temp']) && isset($_POST['confirm'])) {
    $pst2 = $_SESSION['temp']['data']['name'];
    $pst3 = $_SESSION['temp']['data']['email'];
    $pst4 = $_SESSION['temp']['data']['phone'];
    $pst5 = $_SESSION['temp']['data']['username'];
    $pst6 = $_SESSION['temp']['data']['password'];
    $pst7 = $_SESSION['temp']['data']['secure'];
    $pst12 = $_SESSION['temp']['data']['uplink'];
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if(isset($closeRegist)) {
        ShennXit(['type' => false,'message' => 'Pendaftaran ditutup.']);
    } else if($_CONFIG['mt']['web'] == 'true') {
        ShennXit(['type' => false,'message' => 'Ada pemeliharaan sistem situs web, silakan coba lagi nanti.']);
    } else if($_SESSION['temp']['whatsapp'] != false && $_SESSION['temp']['whatsapp'] <> $_POST['otpwa']) {
        ShennXit(['type' => false,'message' => 'Kode verifikasi nomor telepon salah.']);
    } else if($_SESSION['temp']['email'] <> $_POST['otpgm']) {
        ShennXit(['type' => false,'message' => 'Kode verifikasi alamat email tidak cocok.']);
    } else {
        $user_env = json_encode([
            'old_email' => $pst3,'new_email' => $pst3,
            'otp_email' => ['code' => rand(111111,999999),'date_create' => date('Y-m-d H:i:s'),'date_resend' => date('Y-m-d H:i:s'),'date_expired' => rdate('Y-m-d H:i:s', '+3 days'),'count_resend' => 0],
            'old_phone' => $pst4,'new_phone' => $pst4,
            'otp_phone' => ['code' => rand(111111,999999),'date_create' => date('Y-m-d H:i:s'),'date_resend' => date('Y-m-d H:i:s'),'date_expired' => rdate('Y-m-d H:i:s', '+3 days'),'count_resend' => 0],
            'change_password' => ['code' => rand(111111,999999),'date_create' => date('Y-m-d H:i:s'),'date_expired' => rdate('Y-m-d H:i:s', '+1 days')],
            'store' => ['name' => $pst2],
        ]);
        
        if($call->query("INSERT INTO users VALUES (null, '$pst2', '$pst3', '$pst4', '$pst5', '$pst6', '$pst7', '0', '0', 'Basic', '".random(16)."', '$pst12', 'active', '$dtme', '$user_env', '".sha1(sha1(strtotime(date('Y-m-d H:i:s'))))."')") == true) {
            $call->query("INSERT INTO logs VALUES (null, '$pst5', 'register', 'Welcome!', 'success', '$client_ip', '$client_iploc', '$dtme')");
            $call->query("INSERT INTO users_api VALUES ('$pst5', '".random(8)."', '".random(64)."', '', '', 'development')");
            unset($_SESSION['temp']);
            ShennXit(['type' => true,'message' => 'Akun Anda telah berhasil didaftarkan.']);
        } else {
            ShennXit(['type' => false,'message' => 'Server kami sedang bermasalah, silakan coba lagi nanti.']);
        }
    }
} if(isset($_SESSION['temp']) && isset($_POST['cancel'])) {
    unset($_SESSION['temp']);
    ShennXit(['type' => true,'message' => 'Berhasil dibatalkan.']);
}