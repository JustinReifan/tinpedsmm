<?php
   require '../connect.php';
   require _DIR_('library/session/user');
   require _DIR_('library/shennboku.app/tiket');
   require _DIR_('library/layout/header.user');
   
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
   <div class="col-12">
      <div class="alert alert-info" role="alert" style="color:#4C4993 !important;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close"><b>×</b></a>
         <p><b>TATA CARA PENGISIAN JUDUL</b><br />
            1. <b>ORDER</b> : Masalah mengenai dengan pemesanan.<br />
            2. <b>DEPOSIT</b> : Masalah mengenai dengan deposito.<br />
            3. <b>LAYANAN</b> : Masalah mengenai dengan Layanan.<br />
            4. <b>SPEED UP</b> : Masalah mengenai dengan Masalah Speed Up Orderan.<br />
            5. <b>REFILL</b> : Masalah mengenai dengan Refill Menual.<br />
            6. <b>LAINNYA</b> : Masalah mengenai dengan hal lainnya.<br />
            7. Sertakan ID pemesanan/deposit saat melalukan komplain
         </p>
      </div>
      <div class="card overflow-hidden">
         <div class="card-header">
            <h4 class="card-title">
               <i class="fas fa-inbox"></i>
               Tiket Bantuan
            </h4>
         </div>
         <div class="card-body card-dashboard">
            <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="ShennList-tab" data-toggle="tab" href="#ShennList" aria-controls="ShennList" role="tab" aria-selected="true"><i class="fas fa-list"></i> List</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="ShennAdd-tab" data-toggle="tab" href="#ShennAdd" aria-controls="ShennAdd" role="tab" aria-selected="false"><i class="fas fa-location-arrow"></i> Buat Tiket</a>
               </li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="ShennList" aria-labelledby="ShennList-tab" role="tabpanel">
                  <center>
                     <h4 class="header-title mb-3">
                        <b>RIWAYAT TIKET</b>
                  </center>
                  <div class="row " style="overflow-y: auto;">
                  <div class="col-12  d-flex justify-content-between">
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("tiket/index?status=Pending"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket black bg-primary font-weight-bold">Tiket Belum Dibuka</a>
                  </div>
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("tiket/index?status=Waiting"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket  bg-warning black font-weight-bold">Menunggu Balasan</a>
                  </div>
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("tiket/index?status=Responded"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket bg-success black font-weight-bold">Balasan CS</a>
                  </div>
                  <div class="col-6 col-md-3">
                  <a href ="<?= base_url("tiket/index?status=Closed"); ?>" class="btn btn-relief-info btn-block mb-1 waves-effect waves-light notif-tiket bg-danger black font-weight-bold">Tiket Ditutup</a>
                  </div>
                  </div>
                  </div>
                  </h4>
                  <hr>
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered zero-configuration tables1" id="datatable" width="100%">
                        <thead>
                           <tr>
                              <th>ID Tiket</th>
                              <th>Subjek</th>
                              <th>Pesan Anda</th>
                              <th>Update Terakhir</th>
                              <th>Status</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              // start paging config
                              if (isset($_GET['search']) OR isset($_GET['status'])) {
                                  $cari = filter($_GET['search']);
                                  $cari_status = filter($_GET['status']);
                                  $cek_tiket = "SELECT * FROM tiket WHERE subjek LIKE '%$cari%' AND status LIKE '%$cari_status%' AND user = '$sess_username' ORDER BY id DESC"; // edit
                              } else {
                                  $cek_tiket = "SELECT * FROM tiket WHERE user = '$sess_username' ORDER BY id DESC"; // edit
                              }
                              if (isset($_GET['search'])) {
                                  $cari_urut = filter($_GET['tampil']);
                                  $records_per_page = $cari_urut; // edit
                              } else {
                                  $records_per_page = 30; // edit
                              }
                              
                              $starting_position = 0;
                              if (isset($_GET["halaman"])) {
                                  $starting_position = (filter($_GET["halaman"]) - 1) * $records_per_page;
                              }
                              $new_query = $cek_tiket . " LIMIT $starting_position, $records_per_page";
                              $new_query = $call->query($new_query);
                              // end paging config
                              while ($data_tiket = $new_query->fetch_assoc()) {
                                  if ($data_tiket['status'] == "Pending") {
                                      $label = "warning";
                                      $kata = "Tiket Belum Dibuka";
                                      $btn = "";
                                  } else if ($data_tiket['status'] == "Closed") {
                                      $label = "danger";
                                      $kata = "Tiket Ditutup";
                                      $btn = "disabled";
                                  } else if ($data_tiket['status'] == "Waiting") {
                                      $label = "info";
                                      $kata = "Menunggu Balasan";
                                      $btn = "";
                                  } else if ($data_tiket['status'] == "Responded") {
                                      $label = "success";
                                      $kata = "Balasan CS";
                                      $btn = "";
                                  }
                              
                              ?>
                           <tr>
                              <th scope="row"><b><a href="<?= base_url("tiket/open?id=".$data_tiket['id'].""); ?>"><?php echo $data_tiket['id']; ?></a></b></th>
                              <td class="font-weight-bold"><?php echo $data_tiket['subjek']; ?></td>
                              <td><?php echo $data_tiket['pesan']; ?></td>
                              <td><?php echo $data_tiket['update_terakhir']; ?></td>
                              <td><a href="<?= base_url("tiket/open?id=".$data_tiket['id'].""); ?>" class="btn btn-xs btn-<?php echo $label; ?>"><?php echo $kata; ?></a></td>
                              <td align="right">
                                 <a href="<?= base_url("tiket/open?id=".$data_tiket['id'].""); ?>" class="btn btn-sm btn-primary <?php echo $btn; ?>"><i class="fa fa-reply"></i> Balas</a>
                                 <a href="javascript:;" onclick="users('<?= base_url("tiket/tutup?id=".$data_tiket['id'].""); ?>')" class="btn btn-sm btn-warning <?php echo $btn; ?>"><i class="mdi mdi-progress-close"></i>Tutup</a>
                              </td>
                           </tr>
                           <?php
                              }
                              ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane" id="ShennAdd" aria-labelledby="ShennAdd-tab" role="tabpanel">
                  <form class="form-default" role="form" method="POST">
                     <table class="table table-striped table-bordered table-hover m-0">
                        <thead>
                           <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                           <div class="form-group">
                              <label class="col-md-2 control-label">Subjek</label>
                              <div class="col-md-12">
                                 <select class="form-control" type="text" name="subjek" id="subjek">
                                    <option value="DEPOSIT">DEPOSIT</option>
                                    <option value="ORDER">ORDER</option>
                                    <option value="SPEED UP">SPEED UP</option>
                                    <option value="REFILL">REFILL</option>
                                    <option value="CANCEL">CANCEL</option>
                                    <option value="LAINNYA">LAINNYA</option>
                                 </select>
                              </div>
                           </div>
                           <div id="input"></div>
                           <div class="form-group">
                              <label class="col-md-2 control-label">Pesan</label>
                              <div class="col-md-12">
                                 <textarea class="form-control" name="pesan" rows="8" placeholder="Isi Keluhan Anda"></textarea>
                              </div>
                           </div>
                        </thead>
                        <div class="col-md-12">
                           <button type="submit" class="btn btn-block btn-primary waves-effect w-md waves-light" name="kirim"><i class="mdi mdi-send"></i> Kirim</button>
                        </div>
                     </table>
                  </form>
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
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<? require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
   $(document).ready(function() {
       $("#subjek").change(function() {
           var subjek = $("#subjek").val();
           $.ajax({
               url: '<?= ajaxlib('input-tiket') ?>',
               data: 'subjek=' + subjek,
               type: 'POST',
               dataType: 'html',
               success: function(msg) {
                   $("#input").html(msg);
               }
           });
       });
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
    
       // DataTables initialisation
       var table = $('.tables1').DataTable();
    
       // Refilter the table
       $('01-03-2019, 01-03-2025').on('change', function () {
           table.draw();
       });
   });
       
</script>