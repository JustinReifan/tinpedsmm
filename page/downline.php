<?php

require '../connect.php';
require _DIR_('library/session/session');
require _DIR_('library/shennboku.app/account-profile');
require _DIR_('library/layout/header.user');


?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="m-t-0 text-uppercase header-title"><i class="fa fa-gift mr-1 text-warning"></i> Program Referral</h4>
				<hr>

				<div class="d-flex flex-row">
					<div class="form-group">
						<label class="col-lg-10 control-label"><i class="mdi mdi-wallet-giftcard info"></i> Kode Referral Kamu</label>
						<div class="col-lg-12">
							<div class="input-group">
								<input type="text" class="form-control" value="<?= $data_user['referral'] ?>" id="target-<?= $data_user['referral'] ?>" readonly="">
								<div class="input-group-append">
									<button type="button" class="btn btn-sm btn-info text-white fw-bold copy waves-effect waves-light" data-toggle="tooltip" title="Copy Target" onclick="copy_to_clipboard('target-<?= $data_user['referral'] ?>')" data-original-title="Copy Target">
										<i class="far fa-copy"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="alert alert-info bg-info text-white border-0" role="alert">
					Bagikan Link Refferal Anda <a href="whatsapp://send?text=Ayo Bergabung Menjadi Agen Digital sekarang di tinped,daftar sekarang disini <?= 'https://tinped.com/' . 'auth/register' ?> Masukkan Kode Referral *<?= $data_user['referral'] ?>*" target="_blank">ke Whatsapp</a>
				</div>

				<hr>

				<div class="card-body">
					<p style="font-size:110%;"><b>Langkah - langkah Program Referral :</b></p>
					<ul>
						<li style="font-size:13px">Beritahu dan ajak Teman, Keluarga, Sanak Saudara, Orang spesial atau siapapun untuk ikut bergabung di <?php echo $data['short_title']; ?> melalui kode Referral kamu saat mendaftarkan Akun.</li>
						<li style="font-size:13px">Setelah orang yang kamu ajak mendaftar melalui Kode Referral Kamu dan Melakukan Transaksi di <?php echo $data['short_title']; ?>, Maka kamu akan mendapatkan bonus Rp 25,- dari setiap Transaksinya.</li>
						<li style="font-size:13px">Contoh kamu berhasil mengajak Teman dengan memasukan kode Referral kamu saat mendaftar Akun, Kemudian teman kamu telah melakukan Transaksi di <?php echo $data['short_title']; ?>, Maka kamu akan mendapatkan bonus Rp 25,- per Transaksinya Gratis Otomatis langsung masuk ke saldo akun Kamu.</li>
						<li style="font-size:13px">Tanpa syarat, terbuka untuk semua member <?php echo $data['short_title']; ?>. Yuk Mulai kumpulkan bonusnya dari Sekarang untuk komisi bulanan kamu!</li>
						<li style="font-size:13px">Status Program Referral <?php echo $data['short_title']; ?> Saat Ini <span class="badge badge-primary"><?php echo $data_referral['status']; ?></span></li>
						<li style="font-size:13px">Jika butuh bantuan silahkan hubungi kontak Kami.</li>
					</ul>

					<br>
					<p style="font-size:110%;"><b>Contoh Ilustrasi Perhitungan Bonus Transaksi</b></p>
					<div class="table-responsive">
						<table class="demo-table">
							<tr>
								<th>Jumlah Referal Kamu</th>
								<th>Bonus</th>
								<th>Trx/Referal/Hari</th>
								<th>Bonus/hari</th>
								<th>Bonus/bulan(x30hari)</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Rp 25,-</td>
									<td>60 trx/hari</td>
									<td>Rp 1.500,-</td>
									<td>Rp 45.000,-</td>
								</tr>
								<tr>
									<td>10</td>
									<td>Rp 25,-</td>
									<td>60 trx/hari</td>
									<td>Rp 15.000,-</td>
									<td>Rp 450.000,-</td>
								</tr>
								<tr>
									<td>100</td>
									<td>Rp 25,-</td>
									<td>60 trx/hari</td>
									<td>Rp 150.000,-</td>
									<td>Rp 4.500.000,-</td>
								</tr>
								<tr>
									<td>1.000</td>
									<td>Rp 25,-</td>
									<td>60 trx/hari</td>
									<td>Rp 1.500.000,-</td>
									<td>Rp 45.000.000,-</td>
								</tr>
								<tr>
									<td>10.000</td>
									<td>Rp 25,-</td>
									<td>60 trx/hari</td>
									<td>Rp 15.000.000,-</td>
									<td>Rp 450.000.000,-</td>
								</tr>
							</tbody>
						</table>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>

<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">My Downline</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered datatable" id="datatable" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Username</th>
									<th>Information</th>
									<th>Registered</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="5" class="text-center">Loading data from server...</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<? require _DIR_('library/layout/footer.user'); ?>
<?= datatable(['url' => ajaxlib('table/users?__s=1'), 'sort' => 0, 'type' => 'desc']) ?>