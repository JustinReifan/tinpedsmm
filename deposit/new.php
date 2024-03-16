<?php 
require '../connect.php';
require _DIR_('library/session/user');
require _DIR_('library/function/RotasiWhatsapp');
require _DIR_('library/shennboku.app/deposit-new');
require _DIR_('library/layout/header.user');
?>

<!-- Loading start -->
<div class="preloader">
    <div class="loading"> <img src="<?= base_url('assets/images/loading.gif')?>" width="243"> </div>
</div>
<section id="dashboard-analytics">
<div class="row">
<div class="col-12">
    <div class="alert alert-primary" role="alert">
        <marquee direction="left" scrollamount="10" style="color:#4C4993;">
        <i class="fas fa-angle-double-right"></i> Deposit bertanda manual, silahkan lakukan transfer manual ke rekening tujuan sesuai nominal total pada invoice.</a>
        </marquee>
     </div>
</div>
</div>
    <div class="row">
    <div class="col-12">
        <div class="alert alert-primary" role="alert" style="color:#4C4993;"><a href="#" class="close" data-dismiss="alert" aria-label="close"><b>×</b></a>
            <i class="fas fa-angle-double-right"></i> Untuk deposit otomatis di TINPED, saldo akan bertambah pada menit yang sama ketika sukses melakukan pembayaran.<br>
            <i class="fas fa-angle-double-right"></i> Untuk deposit manual di TINPED, silahkan konfirmasi ke WhatsApp Admin setelah melakukan transfer <a href="https://wa.me/6281932888380?text=%20Halo%20Admin%20Deposit%20saya%20belum%20di%20konfirmasi%20ID%20Deposit:%20(...)" target="_blank"><b>DISINI</b> (KLIK)</a>. 
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
            <div class="card-body">
                <h4 class="header-title">TOP-UP</h4>
                <hr>
                <form method="POST">
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="payment" value="bank" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon">Bank</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="payment" value="emoney" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon">E-Money</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="payment" value="pulsa" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon">Pulsa</span>
                            </label>
                        </div>
                    </div>
					<div class="form-group">
						<label class="placeholder">Method</label>
						<select name="method" id="method" class="form-control" required>
						    <option selected disabled> - Select One -</option>
						</select>
					</div>
					<div class="form-group d-none" id="phone">
						<label class="placeholder">Phone Number</label>
						<input type="number" name="phone" class="form-control">
						<small class="text-danger">Harap masukan nomor telepon pengirim pulsa.</small>
					</div>
					<div class="form-group">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label class="placeholder">Jumlah TopUp Saldo</label>
                                <input type="number" name="quantity" id="quantity" pattern="[0-9]" onkeyup="get_total(this.value).value;" class="form-control" required>
                                <small id="note" class="text-danger"></small>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="placeholder">Fee</label>
                                <input type="text" id="total_fee" class="form-control" disabled>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="placeholder">Rate/Saldo</label>
                                <input type="text" id="total_rate" class="form-control" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="placeholder">Saldo</label>
                                <input type="text" id="total" class="form-control" disabled>
                            </div>                            
						</div>
					</div>
					<div class="form-group text-right">
                        <button type="submit" name="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                        <button type="submit" name="confirm" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>
				</form>
			</div>
		</div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Information</h4>
                    <hr>
                    <b>Langkah-langkah deposit :</b>
                    <ul>
                        <li>Pilih jenis pembayaran yang Anda inginkan, sementara tersedia 2 opsi: <b>Transfer Bank</b>, & <b>E-Money</b>.</li>
                        <li>Pilih metode pembayaran yang Anda inginkan.</li>
                        <li>Masukkan jumlah deposit.</li>
                        <li>Untuk pembayaran <b>Transfer Pulsa</b>, Sementara sedang tidak tersedia.</li>
                        <li>Klik submit untuk permintaan deposit.</li>
                    </ul>
                     <b>Deposite Otomatis :</b>
                     <ul>
                         <li>Deposit otomatis, ketika anda telah selesai melakukan pembayaran, saldo akan bertambah pada detik itu juga secara real time.</li>
                         <li>Untuk deposite otomatis dikenakan biaya tambahan ketika akan melakukan pembayaran.</li>
                     </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<? require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('input[type=radio][name=payment]').change(function() {
        var payment = this.value;
        if(payment == 'pulsa') $('#phone').removeClass('d-none');
        else $('#phone').addClass('d-none');
        $.ajax({
            url: '<?= ajaxlib('deposit-system') ?>',
            data: 'type=' + payment + '&csrf_token=<?= $csrf_string ?>',
            type: 'POST',
            dataType: 'html',
            beforeSend: function() { $("#method").html(ajax_message.loading.select); },
            success: function(msg) {
                $("#method").html(msg);
            },
            error: function() { $("#method").html(ajax_message.error.select); }
        });
    });
});
function get_total(quantity) {
    var method = $("#method").val();
    $.ajax({
        url: '<?= ajaxlib('deposit-rate') ?>',
        data: 'quantity=' + quantity + '&method=' + method + '&csrf_token=<?= $csrf_string ?>',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            $("#total").val(data.msg.get);
            $("#total_fee").val(data.msg.fee);
            $("#total_rate").val(data.msg.rate);
            $("#note").html(data.msg.note);
        }
    });
}
</script>