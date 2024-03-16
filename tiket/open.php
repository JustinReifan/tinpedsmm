<?php
require '../connect.php';
require _DIR_('library/session/user');
require _DIR_('library/shennboku.app/open-tiket');
require _DIR_('library/layout/header.user');
?>
<? require _DIR_('library/session/result'); ?>
<!-- end row -->
<div class="row">
	<div class="offset-md-2 col-md-8">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title mb-3"><i class="mdi mdi-email-open text-primary"></i> <?php echo $data_tiket['subjek']; ?></h4>
					<div class="text-right">
						<b><?php echo $data_tiket['user']; ?></b><br /><?php echo nl2br($data_tiket['pesan']); ?><br /><i style="font-size: 10px;"><?php echo $data_tiket['date']; ?>, <?php echo $data_tiket['time']; ?></i>
						<hr>
					</div>
					<?php
					$cek_pesan = $call->query("SELECT * FROM pesan_tiket WHERE id_tiket = '$post_idtarget'");
					while ($data_pesan = $cek_pesan->fetch_assoc()) {
						if ($data_pesan['pengirim'] == "Admin") {
							$alert = "success";
							$text = "";
							$pengirim = "Customer Service";
						} else {
							$alert = "info";
							$text = "text-right";
							$pengirim = $data_pesan['user'];
						}
						?>

						<div class="<?php echo $text; ?>">
							<b><?php echo $pengirim; ?></b><br /><?php echo nl2br($data_pesan['pesan']); ?><br /><i style="font-size: 10px;"><?php echo $data_pesan['date']; ?>, <?php echo $data_tiket['time']; ?></i>
							<hr>
						</div>

						<?php
					}
					?>

				<form class="form-horizontal" role="form" method="POST">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
					<div class="form-group">
						<div class="col-md-12">
							<textarea name="pesan" class="form-control" placeholder="Message" rows="3"></textarea>
						</div>
					</div>

					<div class="card-footer text-muted">
						<a href="<?= base_url("tiket"); ?>" class="btn btn-danger"><i  class="mdi mdi-arrow-left-bold"></i> Kembali</a>
						<button type="submit" class="pull-right btn btn-success" name="balas"><i  class="fa fa-send"></i>	Balas</button>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>