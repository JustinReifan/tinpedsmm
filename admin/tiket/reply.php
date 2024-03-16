<?php
   require '../../connect.php';
   require _DIR_('library/session/admin');
   if (!isset($_GET['id'])) {
   	exit("Anda Tidak Memiliki Akses!");
   } 
   $GetIDTiket = filter($_GET['id']);
   $CallDBTiket = $call->query("SELECT * FROM tiket WHERE id = '$GetIDTiket'");
   $ThisData = $CallDBTiket->fetch_assoc();
   if (mysqli_num_rows($CallDBTiket) == 0) {
   	$_SESSION['result'] = ['type' => false,'message' => 'Tiket tidak ditemukan.'];
       redirect('0',base_url('admin/tiket/index'));
   } else {
   	$call->query("UPDATE tiket SET this_admin = '1' WHERE id = '$GetIDTiket'");
   	if (isset($_POST['balas'])) {
   		$pesan = filter($_POST['pesan']);
   		if ($ThisData['status'] == "Closed") {
   			$_SESSION['result'] = ['type' => false,'message' => 'Tiket anda berstatus close silahkan bikin tiket baru.'];
               redirect('0',base_url('admin/tiket/index'));
   		} else if (!$pesan) {
   			$_SESSION['result'] = ['type' => false,'message' => 'Silahkan isi pesan anda.'];
               redirect('0',base_url('admin/tiket/index'));
   		} else if (strlen($pesan) > 500) {
   			$_SESSION['result'] = ['type' => false,'message' => 'Pesan minimal adalah 500.'];
               redirect('0',base_url('admin/tiket/index'));
   		} else {
   			$update_terakhir = "$date $time";
   			$insert_tiket = $call->query("INSERT INTO pesan_tiket VALUES ('', '$GetIDTiket', 'Admin', '".$ThisData['user']."', '$pesan',  '$date', '$time','$update_terakhir')");
   			$update_tiket = $call->query("UPDATE tiket SET update_terakhir = '$update_terakhir', this_user = '0', status = 'Responded' WHERE id = '$GetIDTiket'");
   			if ($insert_tiket == TRUE) {
   				$_SESSION['result'] = ['type' => true,'message' => 'Pesan berhasil balas.'];
                   redirect('0',base_url('admin/tiket/index'));
   			} else {
   				$_SESSION['result'] = ['type' => false,'message' => 'Pesan minimal adalah 500.'];
                   redirect('0',base_url('admin/tiket/index'));
   			}
   		}
   	}
   }
   require _DIR_('library/layout/header.admin');
   ?>
<div class="row">
   <div class="offset-md-2 col-md-8">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title m-t-0 m-b-30"><i class="fa fa-envelope"></i> <?php echo $ThisData['subjek']; ?></h4>
            <div style="max-height: 400px; overflow: auto;">
               <div class="alert alert-success alert-white text-right">
                  <b><?php echo $ThisData['user']; ?></b><br /><?php echo nl2br($ThisData['pesan']); ?><br /><i style="font-size: 10px;"><?php echo $ThisData['date']; ?>, <?php echo $ThisData['time']; ?></i>
               </div>
               <?php
                  $CekPesannya = $call->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$GetIDTiket'");
                  while ($IniPesannya = $CekPesannya->fetch_assoc()) {
                  	if ($IniPesannya['pengirim'] == "Admin") {
                  		$alert = "success";
                  		$text = "";
                  		$pengirim = "Customer Service";
                  	} else {
                  		$alert = "info";
                  		$text = "text-right";
                  		$pengirim = $IniPesannya['user'];
                  	}
                  	?>
               <div class="alert alert-<?php echo $alert; ?> <?php echo $text; ?>">
                  <b><?php echo $pengirim; ?></b><br /><?php echo nl2br($IniPesannya['pesan']); ?><br /><i style="font-size: 10px;"><?php echo $IniPesannya['date']; ?>, <?php echo $IniPesannya['time']; ?></i>
               </div>
               <?php
                  }
                  ?>
            </div>
            <form class="form-horizontal" role="form" method="POST">
               <div class="form-group">
                  <div class="col-md-12">
                     <textarea name="pesan" class="form-control" placeholder="Pesan" rows="3"></textarea>
                  </div>
               </div>
               <div class="card-footer text-muted">
                  <div class="form-group text-right mb-0">
                     <a href="<?= base_url("admin/tiket/index"); ?>" class="btn btn-danger waves-effect">
                     <i  class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                     </a>
                     <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" name="balas"><i  class="mdi mdi-send-check-outline"></i> Kirim</button>
                  </div>
               </div>
            </form>
            <div class="clearfix"></div>
         </div>
      </div>
   </div>
</div>
<? require _DIR_('library/layout/modal'); require _DIR_('library/layout/footer.user'); ?>