<?php
if(!isset($call)) die("");

if (isset($_POST['kirim'])) {
    $post_subjek = filter($_POST['subjek']);
    $post_pesan = filter($_POST['pesan']);
    $post_order_id = filter($_POST['orderid']);
    $post_permintaan = filter($_POST['permintaan']);
    $post_deposit_id = filter($_POST['depositid']);
    $post_payment = filter($_POST['payment']);


    if ($post_subjek == "REFILL") {
        $pesan = "ORDER ID : $post_order_id\n$post_pesan";
    } else if ($post_subjek == "SPEED UP") {
        $pesan = "ORDER ID : $post_order_id\n$post_pesan";
    } else if ($post_subjek == "CANCEL") {
        $pesan = "ORDER ID : $post_order_id\n$post_pesan";
   
    } else {
        $pesan = "$post_pesan";
    }


    $check_tiket = $call->query("SELECT * FROM tiket WHERE status = 'Pending' AND user = '$sess_username'");
    $data_tiket = $check_tiket->fetch_assoc();

    if (!$post_subjek || !$post_pesan) {
        ShennXit(['type' => false,'message' => 'Masih ada formulir kosong.']);
    } else if (strlen($post_subjek) > 300) {
        ShennXit(['type' => false,'message' => 'Maksimal Subjek adalah 300.']);
    } else if (strlen($post_pesan) > 1200) {
        ShennXit(['type' => false,'message' => 'Maksimal Pesan adalah 1200.']);
    }  else {
        $insert_tiket = $call->query("INSERT INTO tiket VALUES ('', '$sess_username', '$post_subjek', '$pesan', '$date', '$time', '$date $time', 'Pending','1','0')");
        if ($insert_tiket == TRUE) {
            $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Tiket Terkirim', 'pesan' => 'Mohon Menunggu. CS Akan Segera Membalas..');
            ShennXit(['type' => true,'message' => 'Mohon menunggu. Cs akan segera membalas tiket kamu.']);
        } else {
            ShennXit(['type' => false,'message' => 'Sistem error silahkan coba lagi nanti.']);
        }
    }
}