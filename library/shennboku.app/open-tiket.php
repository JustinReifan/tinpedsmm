<?php 
if(!isset($call)) die("");
if (isset($_GET['id'])) {
$post_idtarget = filter($_GET['id']);
$cek_tiket = $call->query("SELECT * FROM tiket WHERE id = '$post_idtarget' AND user = '$sess_username'");
$data_tiket = $cek_tiket->fetch_assoc();

$cek_balasan = $call->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$post_idtarget' AND pengirim = 'Customer Service'");
if (mysqli_num_rows($cek_tiket) == 0) {
	$_SESSION['result'] = ['type' => false,'message' => 'Tiket tidak ditemukan.'];
    redirect('0',base_url('tiket'));
} else {
	$call->query("UPDATE tiket SET this_user = '1' WHERE id = '$post_idtarget'");
	if (isset($_POST['balas'])) {
		$pesan = $call->real_escape_string(trim(filter($_POST['pesan'])));
		if ($data_tiket['status'] == "Closed") {
			$_SESSION['result'] = ['type' => false,'message' => 'Tiket anda berstatus close silahkan bikin tiket baru.'];
            redirect('0',base_url('tiket'));
		} else if (!$pesan) {
		    $_SESSION['result'] = ['type' => false,'message' => 'Silahkan isi pesan anda.'];
            redirect('0',base_url('tiket'));
		} else if (strlen($pesan) > 500) {
			$_SESSION['result'] = ['type' => false,'message' => 'Pesan minimal adalah 500.'];
            redirect('0',base_url('tiket'));
		} else {
			$update_terakhir = "$date $time";
			$insert_tiket = $call->query("INSERT INTO pesan_tiket VALUES ('', '$post_idtarget', 'Member', '$sess_username', '$pesan',  '$date', '$time','$update_terakhir')");
			$update_tiket = $call->query("UPDATE tiket SET update_terakhir = '$update_terakhir', status = 'Waiting', this_user = '0' WHERE id = '$post_idtarget'");
			if ($insert_tiket == TRUE) {
                $_SESSION['result'] = ['type' => true,'message' => 'Pesan berhasil balas.'];
                redirect('0',base_url('tiket'));
			} else {
			    $_SESSION['result'] = ['type' => false,'message' => 'Pesan gagal dibalas.'];
                redirect('0',base_url('tiket'));
			}
		}
	}
}
}