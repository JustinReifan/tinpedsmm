<?php
if (!isset($call)) die("You cannot directly connect your application!<br>");
if (isset($_POST['order'])) {
    $post_srv = filter($_POST['service']);
    $post_tgt = str_replace(' ', '', filter($_POST['target']));
    $post_qty = filter($_POST['quantity']);
    $post_cmnt = filter_comments($_POST['comments']);
    $post_cstmlink = filter($_POST['custom_link']);
    $post_usrnms = filter_comments($_POST['usernames']);
    $post_usrnm = filter($_POST['username']);
    $post_hashtag = filter($_POST['hashtag']);
    $post_answern = filter($_POST['answer_number']);
    $pin_lock = filter($_POST['pin']);

    $check_service = $call->query("SELECT * FROM srv_socmed WHERE id = '$post_srv' AND status = 'available'");
    if ($check_service->num_rows > 0) {
        $data_srv = $check_service->fetch_assoc();
        $provider = $data_srv['provider'];
        $service = $data_srv['name'];
        $provid = $data_srv['pid'];

        $profit_db = (in_array($data_user['level'], ['Admin', 'Premium'])) ? $data_srv['premium'] : $data_srv['basic'];
        $price_db = $data_srv['price'] + $profit_db;
        $price = ($price_db / 1000) * $post_qty;
        $profit = ($profit_db / 1000) * $post_qty;
        
        $hitung = count(explode(PHP_EOL, $post_cmnt));
        if (!empty($post_cmnt)) {
            $post_qty = $hitung;
            $price = ($price_db / 1000) * $hitung;
            $profit = ($profit_db / 1000) * $hitung;
        }
        $hitungusrnms = count(explode(PHP_EOL, $post_usrnms));
        if (!empty($post_usrnms)) {
            $post_qty = $hitungusrnms;
            $price = ($price_db / 1000) * $hitungusrnms;
            $profit = ($profit_db / 1000) * $hitungusrnms;
        }

        $check_provider = $call->query("SELECT * FROM provider WHERE code = '$provider'");
        if ($check_provider->num_rows > 0) $data_prv = $check_provider->fetch_assoc();
    }

    if ($result_csrf == false) {
        ShennXit(['type' => false, 'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if ($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false, 'message' => $_CONFIG['lock']['reason']]);
    } else if ($_CONFIG['mt']['trx'] == 'true') {
        ShennXit(['type' => false, 'message' => 'Ada pemeliharaan sistem transaksi, silakan coba lagi nanti.']);
    } else if (!$post_srv || !$post_tgt || !$post_qty) {
        ShennXit(['type' => false, 'message' => 'Data Pesanan tidak terdeteksi.']);
    } else if (!$pin_lock) {
        ShennXit(['type' => false, 'message' => 'Masukkan PIN Keamanan Anda.']);
    } else if (check_bcrypt($pin_lock, $data_user['secure']) == false) {
        ShennXit(['type' => false, 'message' => 'PIN Keamanan tidak valid.']);
    } else if ($check_service->num_rows == 0) {
        ShennXit(['type' => false, 'message' => 'Layanan tidak ditemukan atau saat ini tidak tersedia.']);
    } else if ($post_qty < $data_srv['min']) {
        ShennXit(['type' => false, 'message' => 'Pesanan Anda kurang dari jumlah pesanan minimum.']);
    } else if ($post_qty > $data_srv['max']) {
        ShennXit(['type' => false, 'message' => 'Pesanan Anda melebihi batas pesanan maksimum.']);
    } else if ($data_user['balance'] < $price) {
        ShennXit(['type' => false, 'message' => 'Saldo Anda tidak cukup untuk melakukan pemesanan ini.']);
    } else if ($data_user['balance'] < ($price + $_CONFIG['hold'][$data_user['level']])) {
        ShennXit(['type' => false, 'message' => 'Saldo akun minimum Anda adalah ' . number_format($_CONFIG['hold'][$data_user['level']]) . '.']);
    } else if (date_diffs(last_trx($sess_username, 'socmed'), $dtme, 'second') < 1) {
        ShennXit(['type' => false, 'message' => 'Transaksi terbatas, silakan coba lagi dalam 1 detik.']);
    } else if ($call->query("SELECT id FROM trx_socmed WHERE name = '$service' AND data = '$post_dn' AND status NOT IN ('error', 'partial', 'success')")->num_rows > 0) {
        ShennXit(['type' => false, 'message' => 'Masih ada pending order dengan target yang sama.']);
    } else {
        $ShennTRX = date('YmdHis') . random_number(2);
        if ($call->query("SELECT id FROM trx_socmed WHERE wid = '$ShennTRX'")->num_rows > 0) ShennXit(['type' => false, 'message' => 'Sistem bentrok, silakan coba lagi nanti!']);

        $inp = $call->query("INSERT INTO trx_socmed VALUES (null,'$ShennTRX','','$sess_username','$service','$post_tgt','','','','$post_qty','$price','0','$profit','0','0','waiting','0','0','WEB,$client_ip','$date $time','$date $time','$provider')");
        if ($inp == true) $inp1 = $call->query("UPDATE users SET balance = balance-$price WHERE username = '$sess_username'");

        if ($data_user['balance'] > $price) {
            if (isset($inp1) && $inp1 == false) {
                if ($inp == true) $call->query("DELETE FROM trx_socmed WHERE wid = '$ShennTRX'");
                ShennXit(['type' => false, 'message' => 'Terjadi kesalahan dengan data pengguna.']);
            } else if ($inp == true && $inp1 == true) {
                $req_result = false;
                $req_message = 'Connection not found.';
                require 'order-sosmed-curl.php';

                if ($req_result == true) {
                    $call->query("INSERT INTO mutation VALUES (null,'$sess_username','-','$price','Sosmed Order :: $ShennTRX','$date $time')");
                    $call->query("INSERT INTO logs VALUES (null,'$sess_username','order','Sosmed Order :: $ShennTRX','primary','$client_ip','$client_iploc','$date $time')");
                    $call->query("UPDATE trx_socmed SET tid = '$req_provid', note = '-', count = '$req_count', remain = '$req_remain' WHERE wid = '$ShennTRX'");
                    ShennXit(['type' => true, 'message' => 'Pesanan akan segera diproses.']);
                } else {
                    $call->query("INSERT INTO logs VALUES (null,'system','system','[$provider] [WEB] [$ShennTRX] Sosmed: $req_message','primary','$client_ip','$client_iploc','$date $time')");
                    $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
                    $req_msg = (stristr(strtolower($req_message), 'saldo') || stristr(strtolower($req_message), 'balance')) ? 'Ada yang tidak beres, harap hubungi admin.' : $req_message;
                    if (conf('xtra-fitur', 7) == 'true') {
                        $req_msg = $req_message;
                        $call->query("INSERT INTO logs VALUES (null,'$sess_username','order','Sosmed Order :: $ShennTRX','primary','$client_ip','$client_iploc','$date $time')");
                        $call->query("INSERT INTO mutation VALUES (null,'$sess_username','-','$price','Sosmed Order :: $ShennTRX','$date $time'), (null,'$sess_username','+','$price','Sosmed Refunds :: $ShennTRX','$date $time')");
                        $call->query("UPDATE trx_socmed SET note = '$req_msg', status = 'error', price = '0', profit = '0', refund = '1' WHERE wid = '$ShennTRX'");
                    } else {
                        $call->query("DELETE FROM trx_socmed WHERE wid = '$ShennTRX'");
                    }
                    ShennXit(['type' => false, 'message' => $req_msg]);
                }
            } else {
                if ($inp == true) $call->query("DELETE FROM trx_socmed WHERE wid = '$ShennTRX'");
                if ($inp1 == true) $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
                ShennXit(['type' => false, 'message' => 'Terjadi kesalahan pada data transaksi.']);
            }
        } else {
            if ($inp == true) $call->query("DELETE FROM trx_socmed WHERE wid = '$ShennTRX'");
            if ($inp1 == true) $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
            ShennXit(['type' => false, 'message' => 'Saldo Anda rendah.']);
        }
    }
}
