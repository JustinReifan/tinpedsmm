<?php 
require '../connect.php';
require _DIR_('library/session/user');
if(conf('xtra-fitur',4) <> 'true') exit(redirect(0,base_url()));
require _DIR_('library/layout/header.user');

$order_month = $call->query("SELECT SUM(trx_ppob.price) AS tamount, count(trx_ppob.id) AS tcount, trx_ppob.user, users.name FROM trx_ppob JOIN users ON trx_ppob.user = users.username WHERE MONTH(trx_ppob.date_cr) = '".date('m')."' AND YEAR(trx_ppob.date_cr) = '".date('Y')."' AND trx_ppob.status = 'success' GROUP BY trx_ppob.user ORDER BY tamount DESC LIMIT 15");
$order_day = $call->query("SELECT SUM(trx_ppob.price) AS tamount, count(trx_ppob.id) AS tcount, trx_ppob.user, users.name FROM trx_ppob JOIN users ON trx_ppob.user = users.username WHERE trx_ppob.date_cr LIKE '$date%' AND trx_ppob.status = 'success' GROUP BY trx_ppob.user ORDER BY tamount DESC LIMIT 20");
$order_pro = $call->query("SELECT SUM(trx_ppob.price) AS tamount, count(trx_ppob.id) AS tcount, trx_ppob.code, srv_ppob.name FROM trx_ppob JOIN srv_ppob ON trx_ppob.code = srv_ppob.code WHERE MONTH(trx_ppob.date_cr) = '".date('m')."' AND YEAR(trx_ppob.date_cr) = '".date('Y')."' AND trx_ppob.status = 'success' GROUP BY trx_ppob.code ORDER BY tamount DESC LIMIT 15");
?>
<div class="row">

    <div class="col-12 text-center mb-2 mt-3">
        <h3><i class="fas fa-award fa-fw"></i>LAYANAN TERATAS</h3>
        <p>Dibawah Ini Merupakan Top Layanan Dengan Total Pemesanan Tertinggi Bulan Ini.<br>Anda Dapat Menjadikan Daftar Dibawah Ini Sebagai Patokan Untuk Melakukan Pemesanan.</p>
    </div>
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">
                    <i class="feather icon-award mr-1"></i>TOP 10 Service
                </h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? $rank = 1; while($row = $order_pro->fetch_assoc()) { ?>
							<tr>
								<td class="text-center"><?= $rank ?></td>
								<td><?= $row['name'] ?></td>
								<td>Rp <?= currency($row['tamount']) ?> (<?= currency($row['tcount']) ?>)</td>
							</tr>
							<? $rank++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<? require _DIR_('library/layout/footer.user'); ?>