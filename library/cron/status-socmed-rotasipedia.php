<?php
set_time_limit(240);
require '../../connect.php';
require_once 'helper.php';

$stdate = date('Y-m-d', strtotime('-3 Months', strtotime($date)));
$search = $call->query("SELECT * FROM trx_socmed WHERE status IN ('waiting','processing','') AND provider = 'ROTASIPEDIA' AND DATE(date_cr) BETWEEN '$stdate' AND '$date' ORDER BY rand() LIMIT 10");

if ($search->num_rows == 0) {
} else {
    while ($row = $search->fetch_assoc()) {
        $wid = $row['wid'];
        $tid = $row['tid'];
        $user = $row['user'];
        $server = $row['provider'];
        $ostatus = $row['status'];
        $profit = $row['profit'];
        $prov = $call->query("SELECT * FROM provider WHERE code = '$server'")->fetch_assoc();
        $uplink = $call->query("SELECT * FROM users WHERE username = '$user'")->fetch_assoc()['uplink'];

        if ($server == 'ROTASIPEDIA') {
            $try = $curl->connectPost($prov['link'] . 'social-media', ['key' => $prov['apikey'], 'sign' => md5($prov['userid'] . $prov['apikey']),'type' => 'status', 'trxid' => $tid]);
            // var_dump($try);
            // die();
            $data['success'] = isset($try['result']) ? $try['result'] : false;
            $data['status'] = $data['success'] == true ? $try['data'][0]['status'] : 'waiting';
            $data['remain'] = $data['success'] == true ? $try['data'][0]['remain'] : 0;
            $data['counts'] = $data['success'] == true ? $try['data'][0]['count'] : 0;
            $data['errors'] = $data['success'] == false ? (isset($try['message']) ? $try['message'] : '') : 'Connection Failed!';
        } else {
            $data = [
                'success' => false,
                'status' => 'error',
                'remain' => 0,
                'counts' => 0,
                'errors' => 'Provider not supported / still in the making stage.',
            ];
        }
        
        
        //  var_dump($try);
        //          die();


        if ($data['success'] == true) {
            $status = $helper->status($data['status']);
            $remain = $data['remain'];
            $count = $data['counts'];
            $point = point($row['price'], $row['profit'], 'socmed');

            if ($call->query("UPDATE trx_socmed SET count = '$count', remain = '$remain', status = '$status', date_up = '$date $time' WHERE wid = '$wid'") == true) {
                if ($status == 'success' && $row['spoint'] == '0' && $call->query("SELECT * FROM users WHERE referral = '$uplink'")->num_rows == 1) {
                    $call->query("UPDATE users SET point = point+$point WHERE referral = '$uplink'");
                    $call->query("UPDATE trx_socmed SET profit = profit-$point, spoint = '1', point = '$point' WHERE wid = '$wid'");
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
