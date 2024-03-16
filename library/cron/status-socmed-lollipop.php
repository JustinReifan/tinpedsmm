<?php
set_time_limit(240);
require '../../connect.php';
require _DIR_('library/function/RotasiWhatsapp');
require_once 'helper.php';

$getkey = isset($_GET['noresult']) ? false : true;
$showpw = isset($_SESSION['user']['level']) ? $_SESSION['user']['level'] : 'invalid';
$stdate = date('Y-m-d', strtotime('-3 Months', strtotime($date)));
$search = $call->query("SELECT * FROM trx_socmed WHERE status IN ('waiting','processing','') AND provider = 'LOLLIPOP' AND DATE(date_cr) BETWEEN '$stdate' AND '$date' ORDER BY rand() LIMIT 1");

if($search->num_rows == 0) {
} else {
    while($row = $search->fetch_assoc()) {
        $p = $call->query("SELECT * FROM provider WHERE code = 'WA'")->fetch_assoc();
        $apikey =  $p['apikey'];
        $sender = $p['userid'];
        $wid = $row['wid'];
        $tid = $row['tid'];
        $user = $row['user'];
        $server = $row['provider'];
        $ostatus = $row['status'];
        $prov = $call->query("SELECT * FROM provider WHERE code = '$server'")->fetch_assoc();
        $uplink = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc()['uplink'];
        $data_user = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc();


        if($server == 'LOLLIPOP') {
            $try = $curl->connectPost($prov['link'].'status',['api_id' => $prov['userid'],'api_key' => $prov['apikey'],'id' => $row['tid']]);
            var_dump($try);
            $data['success'] = isset($try['status']) ? $try['status'] : false;
            $data['status'] = $data['success'] == true ? $try['data']['status'] : 'waiting';
            $data['remains'] = $data['success'] == true ? $try['data']['remains'] : 0;
            $data['start_count'] = $data['success'] == true ? $try['data']['start_count'] : 0;
            $data['errors'] = $data['success'] == false ? (isset($try['message']) ? $try['message'] : '') : 'Connection Failed!';
        } else {
            $data = [
        		"status" => false,
        		"start_count" => 0,
        		"remains" => 0,
        		'errors' => 'Provider not supported / still in the making stage.',
            ];
        }


            if ($data['success'] == true) {
            $status = $helper->status($data['status']);
            $remain = $data['remains'];
            $count = $data['start_count'];
            $point = point($row['price'], $row['profit'], 'socmed');

            if ($call->query("UPDATE trx_socmed SET count = '$count', remain = '$remain', status = '$status', date_up = '$date $time' WHERE wid = '$wid'") == true) {
                if ($status == 'success' && $row['spoint'] == '0' && $call->query("SELECT * FROM users WHERE referral = '$uplink'")->num_rows == 1) {
                    $call->query("UPDATE users SET point = point+$point WHERE referral = '$uplink'");
                    $call->query("UPDATE trx_socmed SET profit = profit-$point, spoint = '1', point = '$point' WHERE wid = '$wid'");
                }
          if ($status == 'success' || $status == 'partial') {
                    //Setiap mau kirim bot tinggal copas aja 1 kode dibawah ini.
$WATL->sendMessage($apikey, $sender,  $data_user['phone'],
"
Hi " . $data_user['username'] . " !

*Pesanan Sosmed* *$status*!
Berikut Detail Orderan Anda:

*Order ID*: $wid
*Layanan*: ".$row['name']."
*Target*: " . $row['data'] . "
*Jumlah Order*: ".currency($row['amount'])."
*Jumlah Awal*: ".currency($data['start_count'])."
*Jumlah Kurang*: ".currency($data['remains'])."
*Total Harga*: Rp  ".currency($row['price'])."
*Status*: $status

*Sisa Saldo*: Rp ".currency($data_user['balance'])."

Hormat Kami 
-nurulsmmpedia2.my.id
");
            }
                if (($status == 'error' || $status == 'partial') && $row['refund'] == '0') {
                    if ($status == 'partial') {
                        $remains = ($remain > $row['amount']) ? $row['amount'] : $remain;
                        $min_price = ($row['price'] / $row['amount']) * $remains;
                        $min_profit = ($profit / $row['amount']) * $remains;
                    } else if ($status == 'error') {
                        $remains = 0;
                        $min_price = $row['price'];
                        $min_profit = $profit;
                    } else {
                        exit;
                    }

            if ($status == 'error') {
                    //Setiap mau kirim bot tinggal copas aja 1 kode dibawah ini.

$WATL->sendMessage($apikey, $sender,  $data_user['phone'],
"
Hi " . $data_user['username'] . " !

*Pesanan Sosmed* *$status*!
Berikut Detail Orderan Anda:

*Order ID*: $wid
*Layanan*: ".$row['name']."
*Target*: " . $row['data'] . "
*Jumlah Order*: ".currency($row['amount'])."
*Jumlah Awal*: ".currency($data['start_count'])."
*Jumlah Kurang*: ".currency($data['remains'])."
*Status*: $status

*SALDO ANDA RETURN*


Hormat Kami 
-nurulsmmpedia2.my.id

");
                }
                    
                    if ($call->query("UPDATE trx_socmed SET price = price-$min_price, profit = profit-$min_profit, remain = '$remains', refund = '1' WHERE wid = '$wid'") == true) {
                        $call->query("INSERT INTO mutation VALUES (null,'$user','+','$min_price','Socmed Refunds :: $wid','$date $time')");
                        $call->query("UPDATE users SET balance = balance+$min_price WHERE username = '$user'");
                        if ($row['spoint'] == '1' && $call->query("SELECT * FROM users WHERE referral = '$uplink'")->num_rows == 1) {
                            $call->query("UPDATE users SET point = point-$point WHERE referral = '$uplink'");
                            $call->query("UPDATE trx_socmed SET point = '0' WHERE wid = '$wid'");
                        }
                    }
                }
            }
        }
    }
}
squery("UPDATE conf SET c6 = '$date $time' WHERE code = 'status-refund-access'");
