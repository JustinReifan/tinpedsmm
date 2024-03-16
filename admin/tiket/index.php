<?php
require '../../connect.php';
require _DIR_('library/session/admin');
require _DIR_('library/layout/header.admin');
if (isset($_POST['tutup'])) {
    $PostID = filter($_POST['id']);
    $CheckTiket = $call->query("SELECT * FROM tiket WHERE id = '$PostID'");
    if ($CheckTiket->num_rows == 0) {
        $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan gagal!', 'pesan' => 'Tiket Tidak Ditemukan');
    } else {
        $tutup = $call->query("UPDATE tiket SET status = 'Closed' WHERE id = '$PostID'");
        if ($tutup == TRUE) {
            $_SESSION['hasil'] = array(
                'alert' => 'success', 
                'judul' => 'Permintaan berhasil', 
                'pesan' => 'Tiket Berhasil Ditutup');
        } else {
            $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Permintaan gagal!', 'pesan' => 'Permintaan Gagal!!');
        }
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title m-t-0 m-b-30"><i class="dripicons-ticket"></i> 	Tiket</h4>
                <form>
                    <div class="row">
                <div class="table-responsive">
                    
                                      <center>
                     <h4 class="header-title mb-3">
                        <b>RIWAYAT TIKET</b>
                  </center>
                  <div class="row">
                  <div class="col-12  d-flex justify-content-between">
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("admin/tiket/index?status=Pending"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket black bg-primary font-weight-bold">Tiket Belum Dibuka</a>
                  </div>
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("admin/tiket/index?status=Waiting"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket  bg-warning black font-weight-bold">Menunggu Balasan</a>
                  </div>
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("admin/tiket/index?status=Responded"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket bg-success black font-weight-bold">Balasan CS</a>
                  </div>
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("admin/tiket/index?status=Closed"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket bg-danger black font-weight-bold">Tiket Ditutup</a>
                  </div>
                  </div>
                  </div>
                  </h4>
                  <hr>
                    <table class="table table-striped table-bordered nowrap m-0">
                        <thead>
                            <tr>
                                <th>Tiket ID</th>
                                <th>Tanggal/Waktu</th>
                                <th>Username</th>
                                <th>Update Terakhir</th>
                                <th>Subjek</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
// start paging config
$cari = filter($_GET['search']);
$cari_status = filter($_GET['status']);
if (isset($cari) AND isset($cari_status)) {
	if (!empty($cari) AND !empty($cari_status)) {
	   $cek_tiket = "SELECT * FROM tiket WHERE status LIKE '%$cari_status%' AND id LIKE '%$cari%' OR user LIKE '%$cari%' OR subjek LIKE'%$cari%' ORDER BY id DESC"; // edit
	} else if (empty($cari)) {
	   $cek_tiket = "SELECT * FROM tiket WHERE status LIKE '%$cari_status%' ORDER BY id DESC"; // edit 
	} else if (empty($cari_status)) {
	   $cek_tiket = "SELECT * FROM tiket WHERE id LIKE '%$cari%' OR user LIKE '%$cari%' OR subjek LIKE '%$cari%' ORDER BY id DESC"; // edit 
	} else {
	    $cek_tiket = "SELECT * FROM tiket ORDER BY id DESC"; // edit
	}
} else {
    $cek_tiket = "SELECT * FROM tiket ORDER BY id DESC"; // edit
}

if (isset($_GET['search'])) {
    $cari_urut = filter($_GET['tampil']);
$records_per_page = $cari_urut; // edit
} else {
$records_per_page = 200000; // edit
}

$starting_position = 0;
if(isset($_GET["halaman"])) {
    $starting_position = (filter($_GET["halaman"])-1) * $records_per_page;
}
$new_query = $cek_tiket." LIMIT $starting_position, $records_per_page";
$new_query = $call->query($new_query);
// end paging config
while ($data_tiket = $new_query->fetch_assoc()) {
    if ($data_tiket['status'] == "Pending") {
        $label = "warning";
    } else if ($data_tiket['status'] == "Closed") {
        $label = "danger";
    } else if ($data_tiket['status'] == "Waiting") {
        $label = "info";    
    } else if ($data_tiket['status'] == "Responded") {
        $label = "success";       
    }
    ?>
    <tr>
        <td><?php echo $data_tiket['id']; ?></td>
        <td><?php echo $data_tiket['date']; ?>, <?php echo $data_tiket['time']; ?></td>
        <td><?php echo $data_tiket['user']; ?></td>
        <td><?php echo $data_tiket['update_terakhir']; ?></td>
        <td><?php echo $data_tiket['subjek']; ?></td>
        <td><span class="badge badge-<?php echo $label; ?>"><?php echo $data_tiket['status']; ?></span></td>
        <td align="center">
            <a href="<?= base_url("admin/tiket/reply?id=".$data_tiket['id'].""); ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-arrow-right" title="Reply"></i></a>
            <a href="javascript:;" onclick="users('<?= base_url("admin/tiket/tutup?id=".$data_tiket['id'].""); ?>')" class="btn btn-sm btn-warning"><i class="mdi mdi-progress-close" title="Tutup"></i></a>
        </td>
    </tr>   
<?php } ?>
</tbody>
</table>
</div>
<br>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    function users(url) {
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function() {
                $('#modal-detail-body').html('Sedang memuat...');
            },
            success: function(result) {
                $('#modal-detail-body').html(result);
            },
            error: function() {
                $('#modal-detail-body').html('Terjadi kesalahan.');
            }
        });
        $('#modal-detail').modal();
    }
</script> 
<div class="row">
    <div class="col-md-12">     
        <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mt-0" id="myModalLabel"><i class="dripicons-ticket"></i> Tiket</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-detail-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>  
<? require _DIR_('library/layout/modal'); require _DIR_('library/layout/footer.user'); ?>