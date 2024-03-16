<?php
$web_token = isset($_POST['service']) ? filter($_POST['service']) : '';
$tgt_token = isset($_POST['data_no']) ? filter($_POST['data_no']) : '';

$check_service = $call->query("SELECT * FROM srv_ppob WHERE code = '$web_token' AND status = 'available'");
if($check_service->num_rows > 0) {
    $data_srv = $check_service->fetch_assoc();
    $provider = $data_srv['provider'];
    $service = $data_srv['name'];
    $web_token = $data_srv['code'];
    $profit = (in_array($data_user['level'],['Admin','Premium'])) ? $data_srv['premium'] : $data_srv['basic'];
    $price = $data_srv['price']+$profit;
    $point = point($price,$profit,'ppob');

    $check_provider = $call->query("SELECT * FROM provider WHERE code = '$provider'");
    if($check_provider->num_rows > 0) $data_prv = $check_provider->fetch_assoc();
}

$data_user = data_user($username);
if($_CONFIG['lock']['status'] == true)                                      ShennDie(['result' => false,'data' => null,'message' => $_CONFIG['lock']['reason']]);
if($_CONFIG['mt']['trx'] == 'true')                                         ShennDie(['result' => false,'data' => null,'message' => 'Ada pemeliharaan sistem transaksi, coba lagi nanti.']);
if(!$web_token || !$tgt_token)                                              ShennDie(['result' => false,'data' => null,'message' => 'Masih ada parameter yang kosong.']);
if($check_service->num_rows == 0)                                           ShennDie(['result' => false,'data' => null,'message' => 'Layanan tidak ditemukan atau saat ini tidak tersedia.']);
if($check_provider->num_rows == 0)                                          ShennDie(['result' => false,'data' => null,'message' => 'Server tidak ditemukan atau saat ini tidak tersedia.']);
if($data_user['balance'] < $price)                                          ShennDie(['result' => false,'data' => null,'message' => 'Saldo Anda tidak cukup untuk melakukan pemesanan ini.']);
if($data_user['balance'] < ($price+$_CONFIG['hold'][$data_user['level']]))  ShennDie(['result' => false,'data' => null,'message' => 'Saldo akun minimum Anda adalah '.number_format($_CONFIG['hold'][$data_user['level']]).'.']);
if(date_diffs(last_trx($username, 'ppob'), $dtme, 'second') < 6)            ShennDie(['result' => false,'data' => null,'message' => 'Transaksi dibatasi, coba lagi dalam 6 detik.']);

$ShennTRX = date('YmdHis').random_number(2);
$out_res = false;
$out_msg = 'Connection not Found';
require _DIR_('library/shennboku.app/order-postpaid-invcurl');

if($out_res == false) {
    ShennXit(['type' => false,'message' => $out_msg]);
} else if($out_res == true) {
    $price = $price+$out_bills;
    
    if($data_user['balance'] < $price)                                          ShennDie(['result' => false,'data' => null,'message' => 'Saldo Anda tidak cukup untuk melakukan pemesanan ini.']);
    if($data_user['balance'] < ($price+$_CONFIG['hold'][$data_user['level']]))  ShennDie(['result' => false,'data' => null,'message' => 'Saldo akun minimum Anda adalah '.number_format($_CONFIG['hold'][$data_user['level']]).'.']);
    if(squery("SELECT id FROM trx_ppob WHERE wid = '$ShennTRX'")->num_rows > 0) ShennDie(['result' => false,'data' => null,'message' => 'Sistem Bentrok, coba lagi nanti!']);
        
    $inp = $call->query("INSERT INTO trx_ppob VALUES (null,'$ShennTRX','','$username','$web_token','$service','$tgt_token','','$price','0','$profit','waiting','0','0','API,$client_ip','postpaid','$dtme','$dtme','$provider')");
    if($inp == true) $inp1 = $call->query("UPDATE users SET balance = balance-$price WHERE username = '$username'");
    
    if($data_user['balance'] > $price) {
        if(isset($inp1) && $inp1 == false) {
            if($inp == true) $call->query("DELETE FROM trx_ppob WHERE wid = '$ShennTRX'");
            ShennDie(['result' => false,'data' => null,'message' => 'Terjadi kesalahan dengan data pengguna.']);
        } else if($inp == true && $inp1 == true) {
            $req_result = false;
            $req_message = 'Connection not found.';
            require _DIR_('library/shennboku.app/order-postpaid-paycurl');
            
            if($req_result == true) {
                $call->query("INSERT INTO mutation VALUES (null,'$username','-','$price','Postpaid Order :: $ShennTRX','$dtme')");
                $call->query("INSERT INTO logs VALUES (null,'$username','order','Postpaid Order :: $ShennTRX','primary','$client_ip','$client_iploc','$dtme')");
                $call->query("UPDATE trx_ppob SET tid = '$req_provid', note = '$req_note', status = '$req_status' WHERE wid = '$ShennTRX'");
                if(isset($req_lastbl)) $call->query("UPDATE provider SET balance = '$req_lastbl' WHERE code = '$provider'");
                if($req_status == 'success' && $call->query("SELECT * FROM users WHERE referral = '".$data_user['uplink']."'")->num_rows == 1) {
                    $call->query("UPDATE users SET point = point+$point WHERE referral = '".$data_user['uplink']."'");
                    $call->query("UPDATE trx_ppob SET profit = profit-$point, spoint = '1', point = '$point' WHERE wid = '$ShennTRX'");
                }
                ShennDie(['result' => true,'data' => [
                    'trxid' => $ShennTRX,
                    'data' => [
                        'no' => $tgt_token,
                        'name' => $out_name
                    ],
                    'code' => $web_token,
                    'service' => $service,
                    'status' => $req_status,
                    'note' => $req_note,
                    'balance' => (int)data_user($username, 'balance'),
                    'price' => (int)$price
                ],'message' => 'Pesanan berhasil, pesanan akan diproses.']);
            } else {
                $call->query("INSERT INTO logs VALUES (null,'system','system','[$provider] [API] [$ShennTRX] Postpaid: $req_message','primary','$client_ip','$client_iploc','$dtme')");
                $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
                $req_msg = (stristr(strtolower($req_message),'saldo') || stristr(strtolower($req_message),'balance')) ? 'Something went wrong, please contact the admin.' : $req_message;
                if(conf('xtra-fitur',7) == 'true') {
                    $req_msg = $req_message;
                    $call->query("INSERT INTO logs VALUES (null,'$sess_username','order','Postpaid Order :: $ShennTRX','primary','$client_ip','$client_iploc','$dtme')");
                    $call->query("INSERT INTO mutation VALUES (null,'$sess_username','-','$price','Postpaid Order :: $ShennTRX','$dtme'), (null,'$sess_username','+','$price','Postpaid Refunds :: $ShennTRX','$dtme')");
                    $call->query("UPDATE trx_ppob SET note = '$req_msg', status = 'error', price = '0', profit = '0', refund = '1' WHERE wid = '$ShennTRX'");
                } else {
                    $call->query("DELETE FROM trx_ppob WHERE wid = '$ShennTRX'");
                }
                ShennDie(['result' => false,'data' => null,'message' => $req_msg]);
            }
        } else {
            if($inp == true) $call->query("DELETE FROM trx_ppob WHERE wid = '$ShennTRX'");
            if($inp1 == true) $call->query("UPDATE users SET balance = balance+$price WHERE username = '$username'");
            ShennDie(['result' => false,'data' => null,'message' => 'Terjadi error pada data transaksi.']);
        }
    } else {
        if($inp == true) $call->query("DELETE FROM trx_ppob WHERE wid = '$ShennTRX'");
        if($inp1 == true) $call->query("UPDATE users SET balance = balance+$price WHERE username = '$username'");
        ShennDie(['result' => false,'data' => null,'message' => 'Saldo Anda rendah.']);
    }
} else {
    ShennDie(['result' => false,'data' => null,'message' => 'Gagal memeriksa pascabayar Anda.']);
}