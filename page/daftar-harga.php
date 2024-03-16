<?php 
require '../connect.php';
require _DIR_('library/session/session');
require _DIR_('library/layout/header.user');
?>

<!-- Loading start -->
<div class="preloader">
    <div class="loading"> <img src="<?= base_url('assets/images/loading.gif')?>" width="243"> </div>
</div>
            
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="feather icon-tag"></i>
                        Daftar Layanan
                    </h4>
                </div>
                <div class="card-body card-dashboard">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab-fill" data-toggle="tab" href="#pulsa" role="tab" aria-controls="pulsa" aria-selected="false">Pulsa</a>
                        </li>
                         <? if(conf('xtra-fitur',2) == 'true') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab-fill" data-toggle="tab" href="#sosmeds1" role="tab" aria-controls="sosmed" aria-selected="false">Sosmed</a>
                        </li>
                        <? } if(conf('xtra-fitur',2) == 'true') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab-fill" data-toggle="tab" href="#games" role="tab" aria-controls="games" aria-selected="false">Games</a>
                        </li>
                        <? } ?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="pulsa">
                            <form role="form" method="POST">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <select class="form-control" id="provpulsa" name="provpulsa">
                                            <option value="0" selected disabled>- Pilih Salah Satu -</option>
                                            <? if(conf('xtra-fitur',1) == 'true') { ?>
                                            <option value="pascabayar">Pascabayar</option>
                                            <? } ?>
                                            <option value="pulsa-reguler">Pulsa Reguler</option>
                                            <option value="pulsa-transfer">Pulsa Transfer</option>
                                            <option value="pulsa-internasional">Pulsa Internasional</option>
                                            <option value="paket-internet">Paket Internet</option>
                                            <option value="paket-telepon">Paket Telepon dan SMS</option>
                                            <option value="token-pln">Token Listrik (PLN)</option>
                                            <option value="saldo-emoney">Saldo E-Money</option>
                                            <option value="voucher-game">Voucher Game</option>
                                            <option value="streaming-tv">Streaming & TV</option>
                                            <option value="paket-lainnya">Kategori Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <select class="form-control" id="categorypulsa" name="categorypulsa">
                                            <option value="0" selected disabled>- Pilih Salah Satu -</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped zero-configuration mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">ID</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Name</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle;width:30%">Note</th>
                                                <th class="text-center" colspan="2" style="vertical-align:middle">Price</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Status</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Basic</th>
                                                <th class="text-center">Premium</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="pricelist2">
                                            <tr>
                                                <td colspan="5" class="text-center">Please select a category.</td>
                                                <td class="text-center text-danger"><i class="far fa-times-circle"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                           <? if(conf('xtra-fitur',2) == 'true') { ?>
                        <div class="tab-pane" id="sosmeds1">
                            <form role="form" method="POST">
                                <div class="row" style="justify-content: center;">
                                    <div class="form-group col-12">
                                        <select class="form-control sosmed-select" id="categorysosmed" name="categorysosmed" style="width: 100%">
                                            <option value="0" selected disabled>- Pilih Salah satu -</option>
                                            <?php
                                            $search = $call->query("SELECT code,name FROM category WHERE `order` = 'social' ORDER BY name ASC");
                                            if($search->num_rows > 0) {
                                                while($row = $search->fetch_assoc()) {
                                                    print '<option value="'.$row['code'].'">'.$row['name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped zero-configuration mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">ID</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Name</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Min</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Max</th>
                                                <th class="text-center" colspan="3" style="vertical-align:middle">Price/K</th>
                                              <th class="text-center" rowspan="2" style="vertical-align:middle">Deskripsi</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Status</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Basic</th>
                                                <th class="text-center">Premium</th>
                                                <th class="text-center">H2H</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pricelist1">
                                            <tr>
                                                 <td colspan="7" class="text-center">Silakan pilih kategori.</td>
                                                <td class="text-center text-danger"><i class="far fa-times-circle"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>

                        <? } if(conf('xtra-fitur',2) == 'true') { ?>
                        <div class="tab-pane" id="games">
                            <form role="form" method="POST">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <select class="form-control sosmed-select" id="categorygames" name="categorygames"  style="width: 100%">
                                            <option value="0" selected disabled>- Select One -</option>
                                            <?php
                                            $search = $call->query("SELECT code,name FROM category WHERE `order` = 'game' ORDER BY name ASC");
                                            if($search->num_rows > 0) {
                                                while($row = $search->fetch_assoc()) {
                                                    print '<option value="'.$row['code'].'">'.$row['name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped zero-configuration mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">ID</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Name</th>
                                                <th class="text-center" colspan="2" style="vertical-align:middle">Price/K</th>
                                                <th class="text-center" rowspan="2" style="vertical-align:middle">Status</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Basic</th>
                                                <th class="text-center">Premium</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pricelist3">
                                            <tr>
                                                <td colspan="4" class="text-center">Please select a category.</td>
                                                <td class="text-center text-danger"><i class="far fa-times-circle"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<? require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
// start select2 
            $(document).ready(function () {
                $(".sosmed-select").select2({
                    theme: 'bootstrap4',
                    placeholder: "Cari",
                    width: 'resolve'
                });
    
             
            });
// end select2

$(document).ready(function() {
    $("#categorysosmed").change(function() {
        var sosmed = $("#categorysosmed").val();
        $.ajax({
            url: '<?= ajaxlib('price-list') ?>',
            data: 'category=' + sosmed + '&type=socmed&csrf_token=<?= $csrf_string ?>',
            type: 'POST',
            dataType: 'html',
            success: function(msg) {
                $("#pricelist1").html(msg);
            } 
        });
    });

    
    $("#provpulsa").change(function() {
        var typepulsa = $("#provpulsa").val();
        $.ajax({
            url: '<?= ajaxlib('category-pulsa') ?>',
            data: 'type=' + typepulsa + '&csrf_token=<?= $csrf_string ?>',
            type: 'POST',
            dataType: 'html',
            success: function(msg) {
                $("#categorypulsa").html(msg);
            }
        });
    });
    $("#categorypulsa").change(function() {
        var pulsa = $("#provpulsa").val();
        var brand = $("#categorypulsa").val();
        $.ajax({
            url: '<?= ajaxlib('price-list') ?>',
            data: 'category=' + pulsa + '&brand=' + brand + '&type=ppob&csrf_token=<?= $csrf_string ?>',
            type: 'POST',
            dataType: 'html',
            success: function(msg) {
                $("#pricelist2").html(msg);
            }
        });
    });
    $("#categorygames").change(function() {
        var games = $("#categorygames").val();
        $.ajax({
            url: '<?= ajaxlib('price-list') ?>',
            data: 'category=' + games + '&type=games&csrf_token=<?= $csrf_string ?>',
            type: 'POST',
            dataType: 'html',
            success: function(msg) {
                $("#pricelist3").html(msg);
            } 
        });
    });
});
</script>