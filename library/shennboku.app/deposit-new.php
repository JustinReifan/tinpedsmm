<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
$search1 = $call->query("SELECT * FROM deposit WHERE user = '$sess_username' AND status = 'unpaid'");
$name = $call->query("SELECT * FROM users WHERE username = '$sess_username'")->fetch_assoc()['name'];
        
if($search1->num_rows == 1) redirect(0,base_url('deposit/invoice/'.$search1->fetch_assoc()['wid']));

if(isset($_POST['confirm'])) {
    $post_rid = date('YmdHis').random_number(2);
    $post_payment = filter($_POST['payment']);
    $post_method = filter_entities($_POST['method']);
    $post_sender = ($_POST['phone'] !== '') ? filter_phone('62',$_POST['phone']) : '';
    $post_quantity = $_POST['quantity'];
    $post_kodeuniq = ($post_payment == 'pulsa') ? '0' : rand(001,410);

    $data_depo = $call->query("SELECT * FROM deposit_method WHERE id = '$post_method'")->fetch_assoc();
    $p = $call->query("SELECT * FROM provider WHERE code = 'WA'")->fetch_assoc();
    $apikey =  $p['apikey'];
    $sender = $p['userid'];
	$post_note = $data_depo['data'];
	$post_name = $data_depo['name'];
	$post_vendr = $data_depo['method'];
	$plsa = $data_depo['fee'];
	
	$post_price3 = ($data_depo['xfee'] == '-') ? $data_depo['fee'] : ($post_quantity * $data_depo['fee']);
    $post_price2 = $post_quantity - $post_price3;
    $post_price1 = $post_price2 * $data_depo['rate'];
    $post_price = $post_price2 - $post_price1;
    $fee1 = $data_depo['fee'];
	
	$check_operators = $SimCard->operator($post_sender);
    $check_operator = (in_array($check_operators, ['Axis','XL'])) ? 'axiata' : strtolower($check_operators);
    if($post_payment == 'pulsa') {
       $fee1 = $post_quantity * (2.00 / 10) ;
        $gte_max = "999999";
        $gte_acc = ($post_vendr === $check_operator) ? true : false;
	} else {
        $gte_max = "9999999";
        $gte_acc = true;
        }
	$gte_sal = $post_price1;
	$gte_fee = $post_price3+$post_price;
	$gte_min = $data_depo['min'];
	 $gte_tf = $post_quantity + $post_kodeuniq;
	if($post_vendr == 'qris') {
        $fee1 = (1.0 / 100) * $post_quantity;
        }
	$fee = $fee1;
	$trf = $post_quantity + $post_kodeuniq;
	$get = $post_quantity + $post_kodeuniq - $fee;

    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'Kesalahan Sistem, silakan coba lagi nanti.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if($_CONFIG['mt']['topup'] == 'true') {
        ShennXit(['type' => false,'message' => 'Ada pemeliharaan sistem deposit, silakan coba lagi nanti.']);
    } else if(!$post_method || !$post_quantity) {
        ShennXit(['type' => false,'message' => 'Masih ada formulir kosong.']);
    } else if($post_payment == 'pulsa' && $gte_acc == false) {
        ShennXit(['type' => false,'message' => ucfirst($check_operators).' nomor tidak didukung dalam metode ini.']);
    } else if($post_quantity < $gte_min) {
        ShennXit(['type' => false,'message' => 'Jumlah setoran minimum adalah Rp '.number_format($gte_min).'.']);
    } else if($post_quantity > $gte_max) {
        ShennXit(['type' => false,'message' => 'Jumlah setoran maksimum adalah Rp '.number_format($gte_max).'.']);
    } else if($call->query("SELECT id FROM deposit WHERE user = '$sess_username' AND status = 'unpaid'")->num_rows >= 1) {
        ShennXit(['type' => false,'message' => 'Anda masih memiliki permintaan setoran yang belum dibayar.']);
    }  else if($call->query("SELECT wid FROM deposit WHERE wid = '$post_rid'")->num_rows > 0) {
        ShennXit(['type' => false,'message' => 'Sistem bentrok, silakan coba lagi.']);
    } else {
        
        $next = false;

        if ($data_depo['auto'] == 1) {
            $apiKey       = u('get', 'tripay_key');
            $privateKey   = u('get', 'tripay_private');
            $merchantCode = u('get', 'tripay_merchant');

            $gte_tf = round($gte_tf);

            $data = [
                'method'         => $data_depo['method'],
                'merchant_ref'   => $post_rid,
                'amount'         => $gte_tf,
                'customer_name'  => $data_user['name'],
                'customer_email' => $data_user['email'],
                'customer_phone' => $data_user['phone'],
                'order_items'    => [
                    [
                        'name'        => 'Deposit saldo',
                        'price'       => $gte_tf,
                        'quantity'    => 1,
                    ]
                ],
                'return_url'   => base_url('deposit/invoice/' . $post_rid),
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode . $post_rid . $gte_tf, $privateKey)
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/api/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $response = json_decode($response, true);

            if ($response['success'] == true) {
                $next = true;
                $post_note = $response['data']['checkout_url'];
            } else {
                ShennXit(['type' => false, 'message' => 'Tripay Result : ' . $response['message']]);
            }
            
        } else {
            $next = true;
        }
        

        if ($next == true) {

            $in = $call->query("INSERT INTO deposit VALUES (null,'$post_rid','$sess_username','$post_vendr','$post_name','$post_note','$post_sender','$post_kodeuniq','$gte_fee','$gte_sal','unpaid','$date $time','$gte_tf')");
            $getSaldoDepo = $gte_sal + $gte_fee + $post_kodeuniq;

$pesan2 = "
Hai kak ".$data_user['name'].",
Terimakasih banyak atas kepercayaan kakak kepada TINPED.

Kami informasikan bahwa deposit baru saja di buat, dengan rincian : 

ID DEPOSIT : #$post_rid
METODE DEPOSIT : $post_name
TRANSFER : RP ".currency($getSaldoDepo)."
FEE : RP $gte_fee
GET SALDO : RP ".currency($getSaldoDepo)."


Silahkan Lakukan Pembayaran ke *$post_note* dengan total Rp ".currency($getSaldoDepo)." agar deposit kakak dapat diterima.

Note
jika belum masuk silahkan hubungi admin
Wa.me//6281932888380
---
TINPED

";
$WASENDER->SendMessage($pesan,$data_user['phone']);



$pesan = "Hai  *Admin*.

User *$sess_username*. Melakukan deposite dengan rincian :

ID Deposite     : #$post_rid
Metode Deposite : $post_name
Sebesar         : ".currency($getSaldoDepo)."

Silahkan dicek,

Hormat Kami
*TINPED*
";
$WASENDER->SendMessage($pesan, $data_user['phone']);



$data = [
    'api_key' => 'f8cd657982e74d876289a1f1a425c9b5justin',
    'sender'  => '6283164695340',
    'number'  => $data_user['phone'],
    'message' => $pesan2
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

            if ($in == true) {
                if (filter_var($post_note, FILTER_VALIDATE_URL)) {
                    header('location:' . $post_note);
                } else {
                    redirect(0, base_url('deposit/invoice/' . $post_rid));
                }
            } else {
                ShennXit(['type' => false, 'message' => 'Server kami bermasalah, silakan coba lagi nanti.']);
            }
        } else {
            ShennXit(['type' => false, 'message' => 'Deposit gagal dilakukan']);
        }
    }
}

// else if (date('H') >= '00') { 
//         ShennXit(['type' => false,'message' => 'Setoran macet terputus! Balik lagi jam 01.00']);
//     }