<?php 
require '../connect.php';
require _DIR_('library/session/user');

$get_s = isset($_GET['s']) ? strtolower(filter($_GET['s'])) : '';
if($get_s == 'pulsa-internasional') $title = 'Pulsa Internasional';
else if($get_s == 'token-pln') $title = 'Token Listrik (PLN)';
else if($get_s == 'saldo-emoney') $title = 'Saldo E-Money';
else if($get_s == 'voucher-game') $title = 'TopUp Game';
else if($get_s == 'streaming-tv') $title = 'Streaming & TV';
else if($get_s == 'paket-lainnya') $title = 'Paket & Kategori Lainnya';
else exit(redirect(0,base_url()));

require _DIR_('library/shennboku.app/order-prepaid');
require _DIR_('library/layout/header.user');
?>
<div class="row">
    <div class="col-12 col-md-10">
            <a href="/" style="color:#1E1E1E !important;">
                <b><i class="fas fa-chevron-circle-left"></i></b> Kembali ke Halaman Utama
            </a>
        </div>
    </div>
    <br>
<div class="row justify-content-between">
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"><?= $title ?></h4>
                <hr>
                <form method="POST">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="category" id="category">
                            <option value="0">- Pilih salah satu -</option>
                            <?php
                            $search = $call->query("SELECT * FROM category WHERE type = '$get_s' AND `order` = 'prepaid' ORDER BY name ASC");
                            while($row = $search->fetch_assoc()) {
                                if($call->query("SELECT * FROM srv_ppob WHERE brand = '".$row['code']."' AND type = '$get_s' AND status = 'available'")->num_rows > 0)
                                    print '<option value="'.$row['code'].'">'.$row['name'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target / ID Game</label>
                        <input type="text" class="form-control" id="data" name="data" placeholder="ID Game / No HP / No Pelanggan">
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label>ID Zone</label>-->
                    <!--    <input type="text" class="form-control" id="data_zone" name="data_zone" placeholder="ID Zone">-->
                    <!--</div>-->
                    <label>Pilih Layanan</label>
                    <div class="row" id="service">
                        <div class="col-12">
                            <div class="alert alert-danger bg-danger text-white border-0" role="alert">Pilih salah satu kategori.</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Information</h4>
            </div>
            <div class="card-body">
                <b>Langkah-langkah membuat pesanan baru:</b>
                <ul>
                    <li>Pilih salah satu Kategori.</li>
                    <li>Pilih salah satu Layanan yang ingin dipesan.</li>
                    <li>Masukkan Target pesanan sesuai ketentuan yang diberikan layanan tersebut.</li>
                    <li>Untuk TopUp Game isi dengan ID Game 🎮</li>
                    <li>Untuk Token Listrik isi dengan No Meter / ID Pelanggan ⚡️</li>
                    <li>Untuk Streaming TV isi dengan Nomor Pelanggan TV 📺</li>
                </ul>
                <b>Ketentuan membuat pesanan baru:</b>
                <ul>
                    <li>Silahkan membuat pesanan sesuai langkah-langkah diatas.</li>
                    <li>Jika ingin membuat pesanan dengan Target yang sama dengan pesanan yang sudah pernah dipesan sebelumnya, mohon menunggu sampai pesanan sebelumnya selesai diproses.</li>
                    <li>Setelah pesanan berhasil anda buat maka setuju dengan <a href="<?= base_url('page/terms-of-service') ?>">Ketentuan Layanan.</a></li>
                    <li>Hati-hati dalam melakukan pesanan, karena kesalahan pengguna tidak ada pengembalian.</li>
                    <li>Jika terjadi kesalahan / mendapatkan pesan gagal yang kurang jelas, silahkan hubungi Admin untuk informasi lebih lanjut.</li>
                </ul>
            </div>
        </div>
    </div>
    
</div>
<? require _DIR_('library/layout/modal'); require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
$(document).ready(function() {
    // $("#data_zone").keyup(function() {
    //     var category = $("#category").val(), target = $("#data_zone").val();
    //     ShennAJAX(category,target);
    // });
    $("#category").change(function() {
        var category = $("#category").val(), target = $("#data_zone").val();
        if(target != '') ShennAJAX(category,target);
    });
    function ShennAJAX(category,target) {
        $.ajax({
            type: 'POST',
            data: 'category=' + category + '&shenn=' + target + '&type=<?= $get_s ?>&csrf_token=<?= $csrf_string ?>',
            url: '<?= ajaxlib('service-prepaid') ?>',
            dataType: 'html',
            success: function(msg) {
                $("#service").html(msg);
            }
        });
    }
});
function prepaid(endpoint) {
    var target = $("#data").val();
    modal('Konfirmasi Pesanan', endpoint + target, 'lg');
}
</script>