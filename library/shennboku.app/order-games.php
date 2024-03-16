<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['order'])) {
    $post_srv = filter($_POST['layanan']);
    $post_tgt = isset($_POST['target']) ? filter($_POST['target']) : '';
    $post_zon = isset($_POST['target2']) ? filter($_POST['target2']) : '';
    $pin_lock = filter($_POST['pin']);
    
    $check_service = $call->query("SELECT * FROM srv_game WHERE code = '$post_srv' AND status = 'available'");
    if($check_service->num_rows > 0) {
        $data_srv = $check_service->fetch_assoc();
        $provider = $data_srv['provider'];
        $service = $data_srv['game'].' - '.$data_srv['name'];
        $profit = (in_array($data_user['level'],['Admin','Premium'])) ? $data_srv['premium'] : $data_srv['basic'];
        $price = $data_srv['price']+$profit;
        $point = point($price,$profit,'game');
        
        $check_provider = $call->query("SELECT * FROM provider WHERE code = '$provider'");
        if($check_provider->num_rows > 0) $data_prv = $check_provider->fetch_assoc();
    }
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if($_CONFIG['mt']['trx'] == 'true') {
        ShennXit(['type' => false,'message' => 'There is a transaction system maintenance, please try again later.']);
    } else if(!$post_srv || !$post_tgt) {
        ShennXit(['type' => false,'message' => 'Order Data not detected.']);
    } else if(!$pin_lock) {
        ShennXit(['type' => false,'message' => 'Enter your Security PIN.']);
    } else if(check_bcrypt($pin_lock,$data_user['secure']) == false) {
        ShennXit(['type' => false,'message' => 'Invalid Security PIN.']);
    } else if($check_service->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Service not found or currently unavailable.']);
    } else if($check_provider->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Server not found or currently unavailable.']);
    } else if($data_user['balance'] < $price) {
        ShennXit(['type' => false,'message' => 'Your balance is not sufficient to place this order.']);
    } else if($data_user['balance'] < ($price+$_CONFIG['hold'][$data_user['level']])) {
        ShennXit(['type' => false,'message' => 'Your minimum account balance is '.number_format($_CONFIG['hold'][$data_user['level']]).'.']);
    } else if(date_diffs(last_trx($sess_username, 'game'), $dtme, 'second') < 6) {
        ShennXit(['type' => false,'message' => 'Transactions are limited, please try again within 6 seconds.']);
    } else {
        $ShennTRX = date('YmdHis').random_number(2);
        if($call->query("SELECT id FROM trx_game WHERE wid = '$ShennTRX'")->num_rows > 0) ShennXit(['type' => false,'message' => 'Clashing System, please try again later!']);
        
        $inp = $call->query("INSERT INTO trx_game VALUES (null,'$ShennTRX','','$sess_username','$post_srv','$service','$post_tgt','$post_zon','','$price','$point','$profit','waiting','0','0','WEB,$client_ip','$date $time','$date $time','$provider')");
        if($inp == true) $inp1 = $call->query("UPDATE users SET balance = balance-$price WHERE username = '$sess_username'");
        
        if($data_user['balance'] > $price) {
            if(isset($inp1) && $inp1 == false) {
                if($inp == true) $call->query("DELETE FROM trx_game WHERE wid = '$ShennTRX'");
                ShennXit(['type' => false,'message' => 'An error occurred with the user data.']);
            } else if($inp == true && $inp1 == true) {
                $req_result = false;
                $req_message = 'Connection not found.';
                require 'order-games-curl.php';
                
                if($req_result == true) {
                    $call->query("INSERT INTO mutation VALUES (null,'$sess_username','-','$price','Game Order :: $ShennTRX','$date $time')");
                    $call->query("INSERT INTO logs VALUES (null,'$sess_username','order','Game Order :: $ShennTRX','primary','$client_ip','$client_iploc','$date $time')");
                    $call->query("UPDATE trx_game SET tid = '$req_provid', note = '$req_note' WHERE wid = '$ShennTRX'");
                    ShennXit(['type' => true,'message' => $req_note]);
                } else {
                    $call->query("INSERT INTO logs VALUES (null,'system','system','[$provider] [WEB] [$ShennTRX] Game: $req_message','primary','$client_ip','$client_iploc','$date $time')");
                    $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
                    $req_msg = (stristr(strtolower($req_message),'saldo') || stristr(strtolower($req_message),'balance')) ? 'Something went wrong, please contact the admin.' : $req_message;
                    if(conf('xtra-fitur',7) == 'true') {
                        $req_msg = $req_message;
                        $call->query("INSERT INTO logs VALUES (null,'$sess_username','order','Game Order :: $ShennTRX','primary','$client_ip','$client_iploc','$date $time')");
                        $call->query("INSERT INTO mutation VALUES (null,'$sess_username','-','$price','Game Order :: $ShennTRX','$date $time'), (null,'$sess_username','+','$price','Game Refunds :: $ShennTRX','$date $time')");
                        $call->query("UPDATE trx_game SET note = '$req_msg', status = 'error', price = '0', profit = '0', refund = '1' WHERE wid = '$ShennTRX'");
                    } else {
                        $call->query("DELETE FROM trx_game WHERE wid = '$ShennTRX'");
                    }
                    ShennXit(['type' => false,'message' => $req_msg]);
                }
            } else {
                if($inp == true) $call->query("DELETE FROM trx_game WHERE wid = '$ShennTRX'");
                if($inp1 == true) $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
                ShennXit(['type' => false,'message' => 'An error occurred in the transaction data.']);
            }
        } else {
            if($inp == true) $call->query("DELETE FROM trx_game WHERE wid = '$ShennTRX'");
            if($inp1 == true) $call->query("UPDATE users SET balance = balance+$price WHERE username = '$sess_username'");
            ShennXit(['type' => false,'message' => 'Your balance is low.']);
        }
    }
}