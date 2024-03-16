<?php
set_time_limit(240);
require '../../connect.php';
require _DIR_('library/function/RotasiWhatsapp');
require 'helper.php';


// $myfile = fopen("logs2.txt", "wr") or die("Unable to open file!");
// $txt = "user id date";
// fwrite($myfile, $txt);
// fclose($myfile);
$getkey = isset($_GET['noresult']) ? false : true;
$showpw = isset($_SESSION['user']['level']) ? $_SESSION['user']['level'] : 'invalid';



$stdate = date('Y-m-d', strtotime('-3 Months', strtotime($date)));
$search = $call->query("SELECT * FROM trx_ppob WHERE status IN ('waiting','') AND provider != 'X' AND DATE(date_cr) BETWEEN '$stdate' AND '$date' ORDER BY rand() LIMIT 20");
if ($search->num_rows == 0) {
} else {
    while ($row = $search->fetch_assoc()) {
        $p = $call->query("SELECT * FROM provider WHERE code = 'WA'")->fetch_assoc();
        $apikey =  $p['apikey'];
        $sender = $p['userid'];
        $wid = $row['wid'];
        $tid = $row['tid'];
        $user = $row['user'];
        $price = $row['price'];
        $service = $row['name'];
        $server = $row['provider'];
        $ostatus = $row['status'];
        $prov = $call->query("SELECT * FROM provider WHERE code = '$server'")->fetch_assoc();
        $uplink = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc()['uplink'];
        $data_user = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc();
        

    if($server == 'DIGI') {
            if($row['trxtype'] == 'prepaid') {
                $try = $DIGI->CheckTopup($row['code'],$row['data'],$tid);
                $data['success'] = isset($try['result']) ? $try['result'] : false;
                $data['status'] = $data['success'] == true ? $try['data']['status'] : 'waiting';
                $data['errors'] = $data['success'] == false ? isset($try['message']) ? $try['message'] : 'Connection Failed!' : '';
                $data['note'] = $data['success'] == true ? $try['message'] : '';
            } else if($row['trxtype'] == 'postpaid') {
                $try = $DIGI->StatusBill($row['code'],$row['data'],$tid);
                $data['success'] = isset($try['result']) ? $try['result'] : false;
                $data['status'] = $data['success'] == true ? $try['data']['status'] : 'waiting';
                $data['errors'] = $data['success'] == false ? isset($try['message']) ? $try['message'] : 'Connection Failed!' : '';
                $data['note'] = $data['success'] == true ? $try['message'] : '';
            } else {
                $data = [
                    'success' => false,
                    'status' => 'error',
                    'errors' => 'Transaction not supported / still in the making stage.',
                    'note' => ''
                ];
            }
        }  else if($server == 'VIP') {
            if ($row['trxtype'] == 'prepaid') {
                $try = $curl->connectPost($prov['link'] . 'prepaid', ['key' => $prov['apikey'], 'sign' => md5($prov['userid'] . $prov['apikey']), 'type' => 'status', 'trxid' => $tid]);
                $data['success'] = isset($try['result']) ? $try['result'] : false;
                $data['status'] = $data['success'] == true ? $try['data'][0]['status'] : 'waiting';
                $data['note'] = $data['success'] == true ? $try['data'][0]['note'] : '';
                $data['errors'] = $data['success'] == false ? (isset($try['message']) ? $try['message'] : '') : 'Connection Failed!';
            } else if ($row['trxtype'] == 'postpaid') {
                $try = $curl->connectPost($prov['link'] . 'prepaid', ['key' => $prov['apikey'], 'sign' => md5($prov['userid'] . $prov['apikey']), 'type' => 'status', 'trxid' => $tid]);
                $data['success'] = isset($try['result']) ? $try['result'] : false;
                $data['status'] = $data['success'] == true ? $try['data'][0]['status'] : 'waiting';
                $data['note'] = $data['success'] == true ? $try['data'][0]['note'] : '';
                $data['errors'] = $data['success'] == false ? (isset($try['message']) ? $try['message'] : '') : 'Connection Failed!';
            } else {
                $data = [
                    'success' => false,
                    'status' => 'error',
                    'errors' => 'Transaction not supported / still in the making stage.',
                    'note' => ''
                ];
            }
        } else {
            $data = [
                'success' => false,
                'status' => 'error',
                'errors' => 'Provider not supported / still in the making stage.',
                'note' => ''
            ];
        }

        if ($data['success'] == true) {
            $status = $helper->status($data['status']);
            $note = $data['note'];
            $point = point($row['price'], $row['profit'], 'ppob');

            if ($call->query("UPDATE trx_ppob SET note = '$note', status = '$status', date_up = '$date $time' WHERE wid = '$wid'") == true) {
                if ($status == 'success' && $row['spoint'] == '0' && $call->query("SELECT * FROM users WHERE referral = '$uplink'")->num_rows == 1) {
                    $call->query("UPDATE users SET point = point+$point WHERE referral = '$uplink'");
                    $call->query("UPDATE trx_ppob SET profit = profit-$point, spoint = '1', point = '$point' WHERE wid = '$wid'");
                }
                
 
                if ($status == 'success') {

$pesan = "
Hi $user !

*Pesanan* *$status*!
Berikut Detail Orderan Anda:

*Order ID*: $wid
*Layanan*: $service
*Target*: " . $row['data'] . "
*Catatan/SN*: $note
*Total Harga*: Rp " . currency($price) . "
*Status*: $status

*Sisa Saldo*: Rp " . currency($data_user['balance']) . "

Hormat Kami 
-nurulsmmpedia2.my.id
";

$data = [
    'api_key' => 'b2d95af932eedb4de92b3496f338aa5f97b36ae0',
    'sender'  => '6283164695340',
    'number'  => '6283164695340',
    'message' => $pesan
];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://wagetewaymurah.npproductionstore.my.id/app/api/send-message",
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
                }



                if ($status == 'error' && $row['refund'] == '0') {
                    if ($call->query("UPDATE trx_ppob SET price = '0', profit = '0', refund = '1', note = '$note' WHERE wid = '$wid'") == true) {
                        $call->query("INSERT INTO mutation VALUES (null,'$user','+','$price','Pulsa PPOB Refunds :: $wid','$date $time')");
                        $call->query("UPDATE users SET balance = balance+$price WHERE username = '$user'");
                        
if($status == 'error'){

$pesan = 
"Hi $user !

*Pesanan* *$status*!
Berikut Detail Orderan Anda:

*Order ID*: $wid
*Layanan*: $service
*Target*: " . $row['data'] . "
*Catatan/SN*: $note
*Total Harga*: Rp " . currency($price) . "
*Status*: $status

*SALDO DI RETURN*

*Sisa Saldo*: Rp " . currency($data_user['balance']) . "

Hormat Kami 
-nurulsmmpedia2.my.id
";

$data = [
    'api_key' => 'b2d95af932eedb4de92b3496f338aa5f97b36ae0',
    'sender'  => '6283164695340',
    'number'  => '6285156064650',
    'message' => $pesan
];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://wagetewaymurah.npproductionstore.my.id/app/api/send-message",
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
           
           
           
            }
                        if ($row['spoint'] == '1' && $call->query("SELECT * FROM users WHERE referral = '$uplink'")->num_rows == 1) {
                            $call->query("UPDATE users SET point = point-" . $row['point'] . " WHERE referral = '$uplink'");
                            $call->query("UPDATE trx_ppob SET point = '0' WHERE wid = '$wid'");
                        }
                    }
                }
            }
        }
    }
}

squery("UPDATE conf SET c5 = '$date $time' WHERE code = 'status-refund-access'");
