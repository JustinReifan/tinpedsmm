<?php

require '../../../connect.php';

$date = date('Y-m-d G:i:s');

$json = json_decode(file_get_contents('php://input'), true);

if ($json) {
    if ($json['status'] == 'PAID') {
        $wid = $json['merchant_ref'];
        
        $qdeposit = mysqli_query($call, "SELECT * FROM deposit WHERE wid = '$wid' AND status = 'unpaid'");
        
        if (mysqli_num_rows($qdeposit) == 1) {
            $fdeposit = mysqli_fetch_assoc($qdeposit);
            
            mysqli_query($call, "UPDATE deposit SET status = 'paid' WHERE wid = '$wid'");
            
            $quser = mysqli_query($call, "SELECT * FROM users WHERE username = '".$fdeposit['user']."'");
            
            $balance = $fdeposit['amount'] - $fdeposit['fee'];
            
            if (mysqli_num_rows($quser) == 1) {
                
                mysqli_query($call, "UPDATE users SET balance = balance+$balance WHERE username = '".$fdeposit['user']."'");
            }
            
            mysqli_query($call, "INSERT INTO mutation VALUES ('','".$fdeposit['user']."','+','$balance','Deposit :: ".$fdeposit['wid']."','$date')");
            
            echo json_encode(['success' => true]);
        } else {
            exit('Deposit tidak ditemukan');
        }
    }
} else {
    exit('Json invalid');
}