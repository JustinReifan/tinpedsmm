<?php
require '../../connect.php';
require _DIR_('library/function/RotasiWhatsapp');
require _DIR_('library/session/session');

$did = isset($_GET['id']) ? filter(base64_decode($_GET['id'])) : '';
$ddt = isset($_GET['data']) ? filter(base64_decode($_GET['data'])) : '';
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_SESSION['user'])) exit(sessResult(false,'No direct script access allowed!'));
    if($data_user['level'] !== 'Admin') exit(sessResult(false,'No direct script access allowed!'));
    if(!$did || !in_array($ddt,['paid','cancelled'])) exit(sessResult(false,'No direct script access allowed!'));
    $search = $call->query("SELECT * FROM deposit WHERE id = '$did' AND status = 'unpaid'");
    if($search->num_rows == 0) exit(sessResult(false,'Unpaid Data not found.'));
    $data = $search->fetch_assoc();
    $psld = $data['amount']+$data['uniq'];
    
    $data_usr = $call->query("SELECT * FROM users WHERE username = '".$data['user']."'")->fetch_assoc();
    $p = $call->query("SELECT * FROM provider WHERE code = 'WA'")->fetch_assoc();
    $apikey =  $p['apikey'];
    $sender = $p['userid'];
    $get = ($data['amount'] + $data['fee'] + $data['uniq']);

    if($ddt == 'paid') {
        $up = $call->query("UPDATE deposit SET status = 'paid' WHERE id = '$did'");
        $up = $call->query("UPDATE users SET balance = balance+$psld WHERE username = '".$data['user']."'");
        if($up == true) {
            $call->query("INSERT INTO mutation VALUES (null,'".$data['user']."','+','$psld','Deposit :: ".$data['wid']."','$date $time')");
            print sessResult(true,'Permintaan setoran diterima.');
            //disini

$pesan = "Hai  *".$data['user']."*.

Terimakasih banyak atas kepercayaan kakak kepada https://nurulsmmpedia2.my.id/.

Kami informasikan bahwa deposit via ".$data['method']."  Dengan Invoice #".$data['wid']." Sebesar RP ".currency($get)." Telah *BERHASIL*

Hormat Kami
*nurulsmmpedia2*
";
$WASENDER->SendMessage($pesan, $data_usr['phone']);

        } else {
            print sessResult(false,'The system is in trouble, please try again later.');
        }
    } else {
        if($call->query("UPDATE deposit SET status = 'cancelled' WHERE id = '$did' AND status = 'unpaid'") == true) {
            print sessResult(true,'Deposit request canceled successfully.');
        } else {
            print sessResult(false,'The system is in trouble, please try again later.');
        }
    }
} else {
	exit(sessResult(false,'No direct script access allowed!'));
}