<?php
set_time_limit(240);
require '../../connect.php';
require 'helper.php';

$getkey = isset($_GET['noresult']) ? false : true;
$showpw = isset($_SESSION['user']['level']) ? $_SESSION['user']['level'] : 'invalid';
$stdate = date('Y-m-d', strtotime('-3 Months', strtotime($date)));
$search = $call->query("SELECT * FROM trx_game WHERE status IN ('waiting','','Processing') AND provider != 'X' AND DATE(date_cr) BETWEEN '$stdate' AND '$date' ORDER BY rand() LIMIT 20");
if($search->num_rows == 0) {
    #print '<font color="red"><pre>Order Waiting not found</pre></font>';
} else {
    while($row = $search->fetch_assoc()) {
        $wid = $row['wid'];
        $harga = $row['price'];
        $tid = $row['tid'];
        $user = $row['user'];
        $tjn = $row['data'];
        $der = $row['name'];
        $server = $row['provider'];
        $ostatus = $row['status'];
        $nomor = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc()['phone'];
        $prov = $call->query("SELECT * FROM provider WHERE code = '$server'")->fetch_assoc();
        $data_user = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc();
        
        if($server == 'VIP') {
            $try = $curl->connectPost($prov['link'].'game-feature',['key' => $prov['apikey'],'sign' => md5($prov['userid'].$prov['apikey']),'type' => 'status','trxid' => $tid]);
            $data['success'] = isset($try['result']) ? $try['result'] : false;
            $data['status'] = $data['success'] == true ? $try['data'][0]['status'] : 'waiting';
            $data['errors'] = $data['success'] == false ? isset($try['message']) ? $try['message'] : 'Connection Failed!' : '';
            $data['note'] = $data['success'] == true ? $try['data'][0]['message'] : '';
        } else {
            $data = [
                'success' => false,
                'status' => 'error',
                'errors' => 'Provider not supported / still in the making stage.',
                'note' => ''
            ];
        }
        
        if($data['success'] == true) {
            $status = $helper->status($data['status']);
            $note = $data['note'];
            $point = point($row['price'],$row['profit'],'game');
            
            if($call->query("UPDATE trx_game SET note = '$note', status = '$status', date_up = '$date $time' WHERE wid = '$wid'") == true) {

  
                if ($status == 'success') {

                    $WASENDER->SendMessage("
Hi $user !

*Pesanan* *$status*!
Berikut Detail Orderan Anda:

*Order ID*: $wid
*Layanan*: $service
*Target*: $tjn
*Catatan/SN*: $note
*Total Harga*: Rp " . currency($harga) . "
*Status*: $status

*Sisa Saldo*: Rp " . currency($data_user['balance']) . "

Hormat Kami 
-nurulsmmpedia2.my.id
",  $data_user['phone']);
                }
                if($status == 'success' && $row['spoint'] == '0' && $call->query("SELECT * FROM users WHERE referral = '{$usr_data['uplink']}'")->num_rows == 1) {
                    $call->query("UPDATE users SET point = point+$point WHERE referral = '{$usr_data['uplink']}'");
                    $call->query("UPDATE trx_game SET profit = profit-$point, spoint = '1', point = '$point' WHERE wid = '$wid'");
                }
                
                $tujuan = (!$row['zone']) ? $row['data'] : "{$row['data']} ({$row['zone']})";
                if($getkey == true) {
                    #print '<font color="green"><pre>[+] '.$tid.' {Update Success}</pre></font>';
                    if($showpw == 'Admin') {
                        #print '<font color="green"><pre>User: '.$row['user'].'</pre></font>';
                        #print '<font color="green"><pre>Prov: '.$server.'</pre></font>';
                        #print '<font color="green"><pre>Note: '.$note.'</pre></font>';
                        #print '<font color="green"><pre>Status: '.$ostatus.' -> '.$status.'</pre></font>';
                    }
                    #print '<hr>';
                }
            } else {
                if($getkey == true) {
                    #print '<font color="red"><pre>[!] '.$tid.' {Update Failed}</pre></font>';
                    if($showpw == 'Admin') {
                        #print '<font color="red"><pre>User: '.$row['user'].'</pre></font>';
                        #print '<font color="red"><pre>Prov: '.$server.'</pre></font>';
                        #print '<font color="red"><pre>Note: '.$note.'</pre></font>';
                        #print '<font color="red"><pre>Status: '.$status.'</pre></font>';
                    }
                   # print '<hr>';
                }
            }
        } else {
            if($getkey == true) {
                #print '<font color="red"><pre>[!] '.$tid.' {'.$data['errors'].'}</pre></font>';
                if($showpw == 'Admin') {
                    #print '<font color="red"><pre>User: '.$row['user'].'</pre></font>';
                    #print '<font color="red"><pre>Prov: '.$server.'</pre></font>';
                }
                #print '<hr>';
            }
        }
    }
}
squery("UPDATE conf SET c4 = '$date $time' WHERE code = 'status-refund-access'");