<?php
require '../connect.php';
require _DIR_('library/session/session');

$get_code = isset($_GET['code']) ? filter($_GET['code']) : '';
$get_data = isset($_GET['data']) ? filter($_GET['data']) : '';

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_SESSION['user'])) exit("No direct script access allowed!");
    if(!$get_code || !$get_data) exit('No direct script access allowed!');
    if($call->query("SELECT * FROM srv_ppob WHERE code = '$get_code' AND status = 'available'")->num_rows == false) exit('Service not found.');
    $row = $call->query("SELECT * FROM srv_ppob WHERE code = '$get_code' AND status = 'available'")->fetch_assoc();
    
    $brand = strtr(strtoupper($SimCard->operator($get_data)),[
        'THREE' => 'TRI',
        'SMARTFREN' => 'SMART'
    ]);
    $brand = ($brand == 'BY.U' && !in_array($post_type,['pulsa-reguler'])) ? 'TELKOMSEL' : $brand;
    if($brand == 'AXIS') $opImage = assets('images/cards/axis.png');
    if($brand == 'BY.U') $opImage = assets('images/cards/byu.svg');
    if($brand == 'INDOSAT') $opImage = assets('images/cards/indosat.png');
    if($brand == 'SMART') $opImage = assets('images/cards/smartfren.png');
    if($brand == 'TELKOMSEL') $opImage = assets('images/cards/telkomsel.png');
    if($brand == 'TRI') $opImage = assets('images/cards/three.png');
    if($brand == 'XL') $opImage = assets('images/cards/xl-axiata.png');
    
    $get_data = str_replace('SHENN','',$get_data);
    $price = (in_array($data_user['level'],['Premium','Admin'])) ? $row['price'] + $row['premium'] : $row['price'] + $row['basic'];
    $note = ($data_user['balance'] < $price) ?
        '<small class="text-danger">Saldo Anda tidak cukup untuk melakukan pembelian ini, sisa saldo Anda adalah Rp '.currency($data_user['balance']).'</small>' :
            '<small class="text-success">Sisa saldo Anda Rp '.currency($data_user['balance']).'</small>';
?>
<form method="POST">
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
    <input type="hidden" id="web_token" name="web_token" value="<?= base64_encode($get_code) ?>">
    <input type="hidden" id="tgt_token" name="tgt_token" value="<?= base64_encode($get_data) ?>">
    
    <h5>Nomor Tujuan</h5>
    <div class="form-group">
        <div class="form-control" style="height:auto !important;font-size:0.8rem;"><?= $get_data ?></div>
    </div>
    <hr>
    
    <h5>Detail Pembelian</h5>
    <div>
        <? if(isset($opImage)) { ?>
        <div class="item-img text-center d-none d-md-block">
            <img class="img-fluid" style="margin-top:5;" src="<?= $opImage ?>">
        </div>
        <? } ?>
        <div class="card-body">
            <div class="item-name" style="font-size:0.8rem;">
                <a href="app-ecommerce-details.html"><?= $row['name'] ?></a>
                <p class="item-company">By <span class="company-name"><?= ucwords(strtolower($brand)) ?></span></p>
            </div>
            <div>
                <p class="item-description" style="font-size:0.8rem; max-width:360px;  overflow: auto;">
                    <?= $row['note'] ?>
                </p>
            </div>
        </div>
    </div>
    <hr>
    
    <h5>Detail Pembayaran</h5>
    <div class="row">
        <div class="form-group col-md-6 col-12">
            <label>Harga</label>
            <div class="form-control" style="height:auto !important;font-size:0.8rem;"><?= 'Rp '.currency($price) ?></div>
        </div>
        <div class="form-group col-md-6 col-12">
            <label><?= $_CONFIG['navbar']; ?> Cash</label>
            <div class="form-control" style="height:auto !important;font-size:0.8rem;"><?= $note ?></div>
        </div>
    </div>
    
    <? if($data_user['balance'] >= $price) { ?>
     <label>Pin Keamanan</label>
    <div class="form-label-group">
        <div class="input-group">
            <input type="password" inputmode="numeric" class="form-control" id="password" name="pin" data-toggle="password" maxlength="6" minlength="6" placeholder="Masukan 6 PIN Kamu" required>
            <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-eye"></i></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-6">
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
        <div class="form-group col-6">
            <button type="submit" id="actionbutton" name="order" class="btn btn-primary btn-block"> SUBMIT </button>
            <div id="timerdiv" style="display:none;"></div>
        </div>
    </div>
    <? } else { ?>
    <hr>
    <div class="row">
        <div class="form-group col-12">
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
    </div>
    <? } ?>
</form>
<script src="<?= assets('js/show-password.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#actionbutton").click(function() {
            $("#actionbutton").hide();
            $("#timerdiv").show(); 
            var timer = 10;     
            function counting(){
                var rto = setTimeout(counting,1000);
                $('#timerdiv').html( '<button type="button" class="btn btn-primary btn-block btn-disabled"> Processing </button>' );
                timer--;
                if(timer < 0) {
                    clearTimeout(rto);
                    timer = 10;
                    $("#timerdiv").hide();             
                    $("#actionbutton").show();
                }
            }
            counting();
         });
    });
</script>
<?php
} else {
    exit("No direct script access allowed!");
}
?>