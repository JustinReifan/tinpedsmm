
<?php
require '../connect.php';
require _DIR_('library/session/user');
if (conf('xtra-fitur', 3) <> 'true') exit(redirect(0, base_url()));
require _DIR_('library/shennboku.app/order-sosmed');
require _DIR_('library/layout/header.user');

$prov = $call->query("SELECT * FROM provider")->fetch_assoc();
?>
<!-- Loading start -->
<div class="preloader">
    <div class="loading"> <img src="<?= base_url('assets/images/loading.gif')?>" width="243"> </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="alert alert-primary" role="alert" style="color:#4C4993 !important;">
            <i class="fas fa-angle-double-right"></i> <b>PERHATIKAN!</b> Pastikan ketika Anda melakukan order Sosial Media, akun target jangan di Private! kesalahan pengguna tidak ada Refund.
            <hr>
            <i class="fas fa-angle-double-right"></i> <b>REKOMENDASI</b> layanan bertanda Refill (Garansi) dan ada harga ada kualitas!
            <hr>
            <i class="fas fa-angle-double-right"></i> <b class="text-danger">PERINGATAN!</b> Kami tidak menjual sosmed untuk akun <b>OPEN BO/PENIPUAN/GRUP PORN</b>. Jika melanggar dosa tanggung sendiri
        </div>
    </div>
</div>
<div class="row d-flex">
    <div class="col-12">
            <a href="../index" style="color:#1E1E1E;">
                <b><i class="fas fa-chevron-circle-left"></i></b> Kembali ke Halaman Utama
            </a>
    </div>
   
</div>
<br>




<div class="row">
    <div class="col-12 col-md-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <h4 class="mb-0">Social Media</h4>
                <a href="<?= base_url('page/daftar_harga') ?>">
                    <p class="font-medium-5 mb-0"><i class="feather icon-help-circle text-muted cursor-pointer"></i></p>
                </a>
            </div>
            <hr>
            
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#general" id="btn-general" role="tab">
                                <i class="fas fa-cart-plus mr-50 font-medium-3"></i>
                               Socmed
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#searchid" id="btn-searchid" role="tab">
                                <i class="fas fa-search mr-50 font-medium-3"></i>
                                Cari ID
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="general" role="tabpanel">
                            <div class="form-group">
                                <i class="mdi mdi-numeric-1-box-multiple-outline primary"></i>
                                <label>Kategori</label>
                            <select class="form-control sosmed-select2" name="category" id="category">
                            <option value="0" selected disabled>- Pilih Satu -</option>
                            <?php
                            $search = $call->query("SELECT * FROM category WHERE `order` = 'social' ORDER BY name ASC");
                            if($search->num_rows > 0) {
                                while($row = $search->fetch_assoc()) {
                                    if($call->query("SELECT * FROM srv_socmed WHERE cid = '".$row['code']."' AND status = 'available' ORDER BY name ASC")->num_rows > 0)
                                        print '<option value="'.$row['code'].'">'.$row['name'].'</option>';
                                }
                            }
                            ?>
                        </select>
                            </div>
                        </div>

                        <div class="tab-pane" id="searchid" role="tabpanel">
                            <div class="form-group">
                                <label>ID Layanan</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="service-id" placeholder="Cari ID layanan">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary waves-effect waves-light" type="button" id="search-id"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-none" id="form-category-searchid">
                            <i class="mdi mdi-numeric-1-box-multiple-outline primary"></i>
                                <label>Kategori</label>
                                <input type="text" class="form-control" id="category-searchid" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="form-service">
                    <i class="mdi mdi-numeric-2-box-multiple-outline primary"></i>
                        <label>Layanan</label>
                        <select class="form-control sosmed-select2" name="service" id="service" style="max-height:36em !important;" >
                            <option value="0" selected disabled>- Pilih Kategori Dahulu -</option>
                        </select>
                    </div>
                    <div id="cSID"></div>
                    <div class="form-group">
                        <div class="alert text-white shadow-sm bg-social d-none" role="alert" style="height:auto !important;" id="note"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4 col-12">
                            <label class="form-label" id="label-price">Harga/1000</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="price" value="0" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label>Minimal Order</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="min-amount" value="0" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-12">
                            <label>Maksimal Order</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="max-amount" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <i class="mdi mdi-numeric-3-box-multiple-outline primary"></i>
                        <label>Target/Link</label><br>
                         <small class="text-danger">*Pastikan yang anda masukan benar! Kesalahan input bukan tanggung jawab kami contoh input <a href="https://tinped.com/page/contoh-input.php"><u>disini</u></a>.</small>
                        <input type="text" class="form-control" id="target" name="target" onkeyup="this.value=this.value.replace(/\s/g,'')" placeholder="Username Target / Link Target">
                    </div>
                    <div class="form-group d-none" id="formCustomComments">
                        <div class="form-group">
                            <label class="form-label">Komentar <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="inputCustomComments" rows="4" placeholder="*Pisahkan Tiap Baris komentar dengan enter."></textarea><span class="text-danger" id="inputCustomCommentsAlert"></span>
                        </div>
                    </div>
                    <div class="form-group d-none" id="formCustomLink">
                        <div class="form-group">
                            <label>Link/URL Post</label>
                            <input type="text" class="form-control" id="inputCustomLink" placeholder="Masukkan Link Postingan">
                        </div>
                    </div>
                    <div class="form-group d-none" id="formMentions">
                        <div class="form-group">
                            <label>Usernames <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="inputMentions" rows="4" placeholder="*Pisahkan Tiap Baris Username dengan enter."></textarea><span class="text-danger" id="inputMentionsAlert"></span>
                        </div>
                    </div>
                    <div class="form-group d-none" id="formMentionsCustomList">
                        <div class="form-group">
                            <label class="form-label">Usernames <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="inputMentionsCustomList" rows="4" placeholder="*Pisahkan Tiap Baris Username dengan enter."></textarea><span class="text-danger" id="inputMentionsCustomListAlert"></span>
                        </div>
                    </div>
                    <div class="form-group d-none" id="formMentionsHashtag">
                        <div class="form-group">
                            <label class="form-label">Hashtag <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputMentionsHashtag">
                        </div>
                    </div>
                    <div class="form-group d-none" id="formMentionsUserFollowers">
                        <div class="form-group">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputMentionsUserFollowers" name="username">
                        </div>
                    </div>
                    <div class="form-group d-none" id="formCustomCommentsPackage">
                        <div class="form-group">
                            <label class="form-label">Comments <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="inputCustomCommentsPackage" rows="4" placeholder="*Pisahkan Tiap Baris komentar dengan enter."></textarea>
                            <span class="text-danger" id="inputCustomCommentsPackageAlert"></span>
                        </div>
                    </div>
                    <div class="form-group d-none" id="formCommentLikes">
                        <div class="form-group">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputCommentLikes"><span class="text-danger">*Username dari pemilik komentar.</span>
                        </div>
                    </div>
                    <div class="form-group d-none" id="formPoll">
                        <div class="form-group">
                            <label class="form-label">Answer Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputPoll"><span class="text-danger">*Answer number of the poll.</span>
                        </div>
                    </div>
                    <div class="d-none" id="formCommentReplies">
                        <div class="form-group">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputCommentReplies1"><span class="text-danger">*Username dari pemilik komentar.</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Komentar <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="inputCommentReplies2" rows="4" placeholder="*Pisahkan Tiap Baris komentar dengan enter."></textarea><span class="text-danger" id="inputCommentReplies2Alert"></span>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" id="rate" value="0">
                        <div class="form-group col-md-6 col-12">
                            <i class="mdi mdi-numeric-4-box-multiple-outline primary"></i>
                            <label>Jumlah Order</label>
                            <input type="number" class="form-control" name="quantity" placeholder="Jumlah Order" id="quantity">
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Total Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> Rp </div>
                                </div>
                                <input type="text" class="form-control" id="total-price" value="0" readonly>
                            </div>
                            <small class="info text-mute">Saldo Anda : Rp <?= currency($data_user['balance']) ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Waktu Rata-Rata Selesai <a href="javascript:;" class="text-primary" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="<em>Waktu rata-rata</em> didasarkan pada 10 pesanan terakhir dengan status pesanan <em>Success</em>."><i class="fas fa-exclamation-circle"></i></a></label>
                        <input type="text" class="form-control" id="waktu" value="-" readonly="">
                    </div>
                    <div class="form-group">
                    <i class="mdi mdi-numeric-5-box-multiple-outline primary"></i>
                        <label>Pin Keamanan</label>
                        <div class="input-group">
                            <input type="password" inputmode="numeric" class="form-control" id="password" name="pin" data-toggle="password" maxlength="6" minlength="6" placeholder="6 Digit PIN Anda" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <button type="button" onclick="reset();" class="btn btn-danger btn-block btn-danger-socmed"> RESET </button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" id="actionbutton" name="order" class="btn btn-success btn-block btn-socmed" > BELI </button>
                            <div id="timerdiv"></div>
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
                    <li>Masukkan Jumlah Pesanan yang diinginkan.</li>
                    <li>Klik Pesan untuk membuat pesanan baru.</li>
                </ul>
                <b>Ketentuan membuat pesanan baru:</b>
                <ul>
                    <li>Silahkan membuat pesanan sesuai langkah-langkah diatas.</li>
                    <li>Jika ingin membuat pesanan dengan Target yang sama dengan pesanan yang sudah pernah dipesan sebelumnya, mohon menunggu sampai pesanan sebelumnya selesai diproses.</li>
                    <li>Setelah pesanan berhasil anda buat maka setuju dengan <a href="<?= base_url('page/terms-of-service') ?>">Ketentuan Layanan.</a></li>
                    <li>Hati-hati dalam melakukan pesanan, karena kesalahan pengguna tidak ada pengembalian.</li>
                    <li>Jika terjadi kesalahan / mendapatkan pesan gagal yang kurang jelas, silahkan hubungi Admin untuk informasi lebih lanjut.</li>
                </ul>
                <b class="text-danger">Penjelasan Layanan</b>
                <ul>
                    <li>Layanan No Refill - Tidak ada jaminan apapun untuk layanan No Refill meskipun drop / hilang hingga seluruhnya.</li>
                    <li>Layanan Refill - Silahkan hubungi Admin melalui chat untuk request Refill.</li>
                    <li>Layanan Non Drop - Tidak ada jaminan bahwa layanan akan permanen 100%. Hal ini tergantung pada update atau kebijakan setiap platform media sosial.</a></li>
                    <li>Layanan Lifetime Refill - Garansi Refill akan dihentikan pada saat layanan Non-Aktif / stop beroprasi.</li>
                    <li>Layanan Deskripsi - Seluruh deskripsi di nurulsmmpedia2.my.id bersifat estimasi (Speed, Start Time, Drop, Quality, Button dll).</li>
                </ul>
            </div>
        </div>
    </div>

</div>

<!--Translate-->


<? require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
// start select2 
            $(document).ready(function () {
                $(".sosmed-select2").select2({
                    theme: 'bootstrap4',
                    placeholder: "Cari"
                });
    
             
            });
// end select2
        
   

    var form_ajax = 'default';
    $(document).ready(function() {
        $('#btn-general').on('click', function() {
            reset();
            $('#form-service').removeClass('d-none');
            $('#service').prop('disabled', false);
            $('#service-id').val('');
            $('#category').val('0').trigger('change.select2');
            $('#service').html('<option value="0">- Pilih Kategori Dahulu -</option>');
        });
        
        
        $('#btn-searchid').on('click', function() {
            reset();
            $('#form-service').addClass('d-none');
        });
        
        $('#search-id').on('click', function() {
            var service = $('#service-id').val();
            $.ajax({
                type: "POST",
                data: 'srvid=' + service + '&csrf_token=<?= $csrf_string ?>',
                url: '<?= ajaxlib('socmed/order-search-service') ?>',
                dataType: "json",
                success: function(data) {
                    reset();
                    $('#form-category-searchid').removeClass('d-none');
                    $('#category-searchid').val(data.msg.category);
                    $('#service').html('<option value="' + data.msg.service_id + '">' + data.msg.service_name + '</option>');
                    $('#cSID').html('<input type="hidden" name="service" value="' + data.msg.service_id + '">');
                    $('#service').prop('disabled', true);
                    $('#form-service').removeClass('d-none');
                    $('#keterangan').removeClass('d-none');
                    $('#price').val(data.msg.price);
                    $('#rate').val(data.msg.rate);
                    $('#min-amount').val(data.msg.min);
                    $('#max-amount').val(data.msg.max);
                    $('#note').removeClass('d-none');
                    $('#note').html(data.msg.note);
                    $('#waktu').val(data.msg.waktu);
                    
                    if (data.msg.type == 'package') {
                        $('#quantity').attr('readonly', true);
                        $('#quantity').val(1);
                        $('#label-price').html('Harga/1');
                        $('#total-price').val(data.msg.pricepkg);
                    } else if (data.msg.type == 'Custom Comments') {
                        $('#formCustomComments').removeClass('d-none');
                        $('#inputCustomComments').attr('name', 'comments');
                        $('#quantity').attr('readonly', true);
                    } else if (data.msg.type == 'custom_link') {
                        $('#formCustomLink').removeClass('d-none');
                        $('#inputCustomLink').attr('name', 'custom_link');
                    } else if (data.msg.type == 'mentions') {
                        $('#formMentions').removeClass('d-none');
                        $('#inputMentions').attr('name', 'usernames');
                    } else if (data.msg.type == 'mentions_custom_list') {
                        $('#formMentionsCustomList').removeClass('d-none');
                        $('#inputMentionsCustomList').attr('name', 'usernames');
                        $('#quantity').attr('readonly', true);
                    } else if (data.msg.type == 'mentions_hashtag') {
                        $('#formMentionsHashtag').removeClass('d-none');
                        $('#inputMentionsHashtag').attr('name', 'hashtag');
                    } else if (data.msg.type == 'mentions_user_followers') {
                        $('#formMentionsUserFollowers').removeClass('d-none');
                        $('#inputMentionsUserFollowers').attr('name', 'username');
                    } else if (data.msg.type == 'comments') {
                        $('#formCustomCommentsPackage').removeClass('d-none');
                        $('#inputCustomCommentsPackage').attr('name', 'comments');
                        $('#quantity').attr('readonly', true);
                        $('#quantity').val(1);
                        $('#label-price').html('Harga/1');
                        $('#total-price').val(data.msg.pricepkg);
                    } else if (data.msg.type == 'username') {
                        $('#formCommentLikes').removeClass('d-none');
                        $('#inputCommentLikes').attr('name', 'username');
                    } else if (data.msg.type == 'poll') {
                        $('#formPoll').removeClass('d-none');
                        $('#inputPoll').attr('name', 'answer_number');
                    } else if (data.msg.type == 'comments') {
                        $('#formCommentReplies').removeClass('d-none');
                        $('#inputCommentReplies1').attr('name', 'username');
                        $('#inputCommentReplies2').attr('name', 'comments');
                        $('#quantity').attr('readonly', true);
                    }
                }
            }).done(function(e) {
                form_ajax = e.form;
                $('#quantity').keyup(function() {
                    var quantity = $('#quantity').val();
                    var rate = $("#rate").val();
                    var result = eval(quantity) * rate;
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(result);
                    $('#total-price').val(formatter);
                });
                
                $('#inputCustomComments').on('keyup', function() {
                    $('#inputCustomCommentsAlert').html('*Pisahkan Tiap Baris komentar dengan enter.');
                    var quantity = $("#inputCustomComments").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(quantity) * rates;
                    $('#quantity').val(quantity);
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(calc);
                    $('#total-price').val(formatter);
                });
                $('#inputMentionsCustomList').on('keyup', function() {
                    $('#inputMentionsCustomListAlert').html('*Pisahkan Tiap Baris Username dengan enter.');
                    var quantity = $("#inputMentionsCustomList").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(quantity) * rates;
                    $('#quantity').val(quantity);
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(calc);
                    $('#total-price').val(formatter);
                });
                $('#inputCustomCommentsPackage').keyup(function() {
                    $('#inputCustomCommentsPackageAlert').html('*Pisahkan Tiap Baris Username dengan enter.');
                });
                $('#inputCommentReplies2').on('keyup', function() {
                    $('#inputCommentReplies2Alert').html('*Pisahkan Tiap Baris Username dengan enter.');
                    var quantity = $("#inputCommentReplies2").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(quantity) * rates;
                    $('#quantity').val(quantity);
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(calc);
                    $('#total-price').val(formatter);
                });
            });
        });
        
        $("#category").change(function() {
            var category = $("#category").val();
            $.ajax({
                type: 'POST',
                data: 'category=' + category + '&csrf_token=<?= $csrf_string ?>',
                url: '<?= ajaxlib('service-socmed') ?>',
                dataType: 'html',
                success: function(msg) {
                    $("#service").html(msg);
                    reset();
                }
            });
        });

            

        
        $("#service").change(function() {
            var service = $("#service").val();
            $.ajax({
                type: 'POST',
                data: 'service=' + service + '&csrf_token=<?= $csrf_string ?>',
                url: '<?= ajaxlib('price-socmed') ?>',
                dataType: 'html',
                success: function(msg) {
                    $("#rate").val(msg);
                }
            });
            $.ajax({
                type: 'POST',
                data: 'id=' + service + '&csrf_token=<?= $csrf_string ?>',
                url: '<?= ajaxlib('note-socmed') ?>',
                dataType: 'json',
                beforeSend: function() {
                    $('#keterangan').addClass('d-none');
                    reset();
                },
                success: function(data) {
                    reset();
                    $('#keterangan').removeClass('d-none');
                    $('#price').val(data.msg.price);
                    $('#min-amount').val(data.msg.min);
                    $('#max-amount').val(data.msg.max);
                    $('#note').removeClass('d-none');
                    $('#note').html(data.msg.note);
                    $('#waktu').val(data.msg.waktu);
                    if (data.msg.type == 'package') {
                        $('#quantity').attr('readonly', true);
                        $('#quantity').val(1);
                        $('#label-price').html('Harga/1');
                        $('#total-price').val(data.msg.pricepkg);
                    } else if (data.msg.type == 'Custom Comments') {
                        $('#formCustomComments').removeClass('d-none');
                        $('#inputCustomComments').attr('name', 'comments');
                        $('#quantity').attr('readonly', true);
                    } else if (data.msg.type == 'custom_link') {
                        $('#formCustomLink').removeClass('d-none');
                        $('#inputCustomLink').attr('name', 'custom_link');
                    } else if (data.msg.type == 'usernames') {
                        $('#formMentions').removeClass('d-none');
                        $('#inputMentions').attr('name', 'usernames');
                    } else if (data.msg.type == 'usernames') {
                        $('#formMentionsCustomList').removeClass('d-none');
                        $('#inputMentionsCustomList').attr('name', 'usernames');
                        $('#quantity').attr('readonly', true);
                    } else if (data.msg.type == 'mentions_hashtag') {
                        $('#formMentionsHashtag').removeClass('d-none');
                        $('#inputMentionsHashtag').attr('name', 'hashtag');
                    } else if (data.msg.type == 'mentions_user_followers') {
                        $('#formMentionsUserFollowers').removeClass('d-none');
                        $('#inputMentionsUserFollowers').attr('name', 'username');
                    } else if (data.msg.type == 'comments') {
                        $('#formCustomCommentsPackage').removeClass('d-none');
                        $('#inputCustomCommentsPackage').attr('name', 'comments');
                        $('#quantity').attr('readonly', true);
                        $('#quantity').val(1);
                        $('#label-price').html('Harga/1');
                        $('#total-price').val(data.msg.pricepkg);
                    } else if (data.msg.type == 'comment_likes') {
                        $('#formCommentLikes').removeClass('d-none');
                        $('#inputCommentLikes').attr('name', 'username');
                    } else if (data.msg.type == 'poll') {
                        $('#formPoll').removeClass('d-none');
                        $('#inputPoll').attr('name', 'answer_number');
                    } else if (data.msg.type == 'comments') {
                        $('#formCommentReplies').removeClass('d-none');
                        $('#inputCommentReplies1').attr('name', 'username');
                        $('#inputCommentReplies2').attr('name', 'comments');
                        $('#quantity').attr('readonly', true);
                    }
                }
            }).done(function(e) {
                form_ajax = e.form;
                $('#quantity').keyup(function() {
                    var quantity = $('#quantity').val();
                    var rate = $("#rate").val();
                    var result = eval(quantity) * rate;
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(result);
                    $('#total-price').val(formatter);
                });
                $('#inputCustomComments').on('keyup', function() {
                    $('#inputCustomCommentsAlert').html('*Pisahkan Tiap Baris komentar dengan enter.');
                    var quantity = $("#inputCustomComments").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(quantity) * rates;
                    $('#quantity').val(quantity);
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(calc);
                    $('#total-price').val(formatter);
                });
                $('#inputMentionsCustomList').on('keyup', function() {
                    $('#inputMentionsCustomListAlert').html('*Pisahkan Tiap Baris Username dengan enter.');
                    var quantity = $("#inputMentionsCustomList").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(quantity) * rates;
                    $('#quantity').val(quantity);
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(calc);
                    $('#total-price').val(formatter);
                });
                $('#inputCustomCommentsPackage').keyup(function() {
                    $('#inputCustomCommentsPackageAlert').html('*Pisahkan Tiap Baris Username dengan enter.');
                });
                $('#inputCommentReplies2').on('keyup', function() {
                    $('#inputCommentReplies2Alert').html('*Pisahkan Tiap Baris Username dengan enter.');
                    var quantity = $("#inputCommentReplies2").val().split(/\r|\r\n|\n/).length;
                    var rates = $("#rate").val();
                    var calc = eval(quantity) * rates;
                    $('#quantity').val(quantity);
                    var formatter = new Intl.NumberFormat('id', {
                        maximumSignificantDigits: 5
                    }).format(calc);
                    $('#total-price').val(formatter);
                });
            });
        });

        $("#actionbutton").click(function() {
            $("#actionbutton").hide();
            $("#timerdiv").show();
            $('#timerdiv').html('<button type="button" class="btn btn-success btn-block btn-disabled btn-socmed" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing... </button>');
        });
    });

    function filterCategory(category) {
        $.ajax({
            type: "POST",
            data: 'category=' + category + '&csrf_token=<?= $csrf_string ?>',
            url: '<?= ajaxlib('filter-get-category') ?>',
            dataType: "html",
            success: function(data) {
                reset();
                $('#category').html(data);
                $('#service').html('<option value="0">- Pilih Kategori Dahulu -</option>');
            }
        });
    };
    function reset() {
        $('#form-category-searchid').addClass('d-none');
        $('#category-searchid').val('');
        $('#cSID').html('');
        $('#quantity').attr('readonly', false);
        $('#formCustomComments').addClass('d-none');
        $('#inputCustomComments').removeAttr('name');
        $('#inputCustomComments').val('');
        $('#inputCustomCommentsAlert').html('');
        $('#formCustomLink').addClass('d-none');
        $('#inputCustomLink').removeAttr('name');
        $('#inputCustomLink').val('');
        $('#formMentions').addClass('d-none');
        $('#inputMentions').removeAttr('name');
        $('#inputMentions').val('');
        $('#inputMentionsAlert').html('');
        $('#formMentionsCustomList').addClass('d-none');
        $('#inputMentionsCustomList').removeAttr('name');
        $('#inputMentionsCustomList').val('');
        $('#inputMentionsCustomListAlert').html('');
        $('#formMentionsUserFollowers').addClass('d-none');
        $('#inputMentionsUserFollowers').removeAttr('name');
        $('#inputMentionsUserFollowers').val('');
        $('#formMentionsHashtag').addClass('d-none');
        $('#inputMentionsHashtag').removeAttr('name');
        $('#inputMentionsHashtag').val('');
        $('#formCustomCommentsPackage').addClass('d-none');
        $('#inputCustomCommentsPackage').removeAttr('name');
        $('#inputCustomCommentsPackage').val('');
        $('#inputCustomCommentsPackageAlert').html('');
        $('#formCommentLikes').addClass('d-none');
        $('#inputCommentLikes').removeAttr('name');
        $('#inputCommentLikes').val('');
        $('#formPoll').addClass('d-none');
        $('#inputPoll').removeAttr('name');
        $('#inputPoll').val('');
        $('#formCommentReplies').addClass('d-none');
        $('#inputCommentReplies1').removeAttr('name');
        $('#inputCommentReplies1').val('');
        $('#inputCommentReplies2').removeAttr('name');
        $('#inputCommentReplies2').val('');
        $('#inputCommentReplies2Alert').html('');
        $('#keterangan').addClass('d-none');
        $('#average_time').val('-');
        $('#min-amount').val(0);
        $('#max-amount').val(0);
        $('#label-price').html('Harga/1000');
        $('#price').val(0);
        $('#waktu').val('');
        $('#quantity').val('');
        $('#target').val('');
        $('#total-price').val(0);
    }

</script>
