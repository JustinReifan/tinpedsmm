<?php
$STOP_REDIRECT = true;
require '../connect.php';
require _DIR_('library/function/RotasiWhatsapp');
require _DIR_('library/session/user');
require _DIR_('library/shennboku.app/account-profile');
require _DIR_('library/layout/header.user');
$see_logs = $call->query("SELECT date FROM logs WHERE user = '$sess_username' AND `type` = 'login' ORDER BY id DESC LIMIT 1");

$total_deposit_paid = $call->query("SELECT SUM(amount) as Totals FROM deposit WHERE status = 'paid' AND user = '" . $data_user['username'] . "'")->fetch_assoc();
$jumlah_deposit_paid = $call->query("SELECT amount FROM deposit WHERE status = 'paid' AND user = '" . $data_user['username'] . "'")->num_rows;
$total_success_game = $call->query("SELECT id FROM trx_game WHERE status = 'success'  AND user = '" . $data_user['username'] . "'")->num_rows;
$total_success_ppob = $call->query("SELECT id FROM trx_ppob WHERE status = 'success'  AND user = '" . $data_user['username'] . "'")->num_rows;
$total_success_socmed = $call->query("SELECT id FROM trx_socmed WHERE status IN ('partial','success')  AND user = '" . $data_user['username'] . "'")->num_rows;

$success_game = $call->query("SELECT SUM(price) as trxGames FROM trx_game WHERE status = 'success'  AND user = '" . $data_user['username'] . "'")->fetch_assoc();
$success_ppob = $call->query("SELECT SUM(price) as trxPPOB FROM trx_ppob WHERE status = 'success'  AND user = '" . $data_user['username'] . "'")->fetch_assoc();
$success_socmed = $call->query("SELECT SUM(price) as trxSocmed FROM trx_socmed WHERE status IN ('partial','success') AND user = '" . $data_user['username'] . "'")->fetch_assoc();


$error_game = $call->query("SELECT id FROM trx_game WHERE status = 'error'  AND user = '" . $data_user['username'] . "'")->num_rows;
$error_ppob = $call->query("SELECT id FROM trx_ppob WHERE status = 'error'  AND user = '" . $data_user['username'] . "'")->num_rows;
$error_socmed = $call->query("SELECT id FROM trx_socmed WHERE status = 'error' AND user = '" . $data_user['username'] . "'")->num_rows;



$total_price_game = $call->query("SELECT SUM(price) AS x FROM trx_game WHERE status = 'success'  AND user = '" . $data_user['username'] . "'")->fetch_assoc()['x'];
$total_price_ppob = $call->query("SELECT SUM(price) AS x FROM trx_ppob WHERE status = 'success'  AND user = '" . $data_user['username'] . "'")->fetch_assoc()['x'];
$total_price_socmed = $call->query("SELECT SUM(price) AS x FROM trx_socmed WHERE status IN ('partial','success')  AND user = '" . $data_user['username'] . "'")->fetch_assoc()['x'];


$trx_berhasil  = $success_game["trxGames"] + $success_ppob["trxPPOB"] + $success_socmed["trxSocmed"];




$trx_row_gagal =  $error_game + $error_ppob + $error_socmed;
?>
<section id="page-account-settings">
    <div class="row">
        <div class="col-12" id="sess-result"></div>
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item">
                    <a class="nav-link d-flex py-75 active" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="true">
                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                        Detail
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="false">
                        <i class="feather icon-info mr-50 font-medium-3"></i>
                        Ganti Name & Toko
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                        Ganti Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-secure" data-toggle="pill" href="#account-vertical-secure" aria-expanded="false">
                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                        Ganti PIN keamanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-exchange" data-toggle="pill" href="#account-vertical-exchange" aria-expanded="false">
                        <i class="feather icon-repeat mr-50 font-medium-3"></i>
                        Tukar Poin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-api" data-toggle="pill" href="#account-vertical-api" aria-expanded="false">
                        <i class="feather icon-code mr-50 font-medium-3"></i>
                        Pengaturan API
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-info" aria-labelledby="account-pill-info" aria-expanded="true">
                                <div class="d-flex justify-content-start align-items-center mb-1">
                                    <div class="potoprofil mr-1">
                                        <img src="<?= $avatar ?>" style="border-radius:5%" height="45" width="45">
                                    </div>
                                    <div class="user-page-info">
                                        <p class="mb-0"><?= $data_user['name'] ?></p>
                                        <span class="font-small-2"><?= format_date('en', $data_user['date']) ?></span>
                                    </div>
                                    <div class="ml-auto user-like text-danger"><i class="fa fa-heart"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Saldo:</h6>
                                                <p class="">Rp <?= currency($data_user['balance']) ?>,-</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Email:</h6>
                                                <p class="" style="cursor:pointer;" <?= onclick_modal('Change Email', base_url('account/change-email'), 'md') ?>>
                                                    <?= substr($data_user['email'], 0, -12); ?>...
                                                    <i class="feather icon-<?= ($equalUserMail == true) ? 'check-circle text-success' : 'alert-circle text-danger' ?>"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">No HP:</h6>
                                                <p class="" style="cursor:pointer;" <?= onclick_modal('Change Phone', base_url('account/change-phone'), 'md') ?>>
                                                    +<?= substr($data_user['phone'], 0, -6); ?>...
                                                    <i class="feather icon-<?= ($equalUserPhone == true) ? 'check-circle text-success' : 'alert-circle text-danger' ?>"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Referral:</h6>
                                                <p class=""><?= $data_user['referral'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Poin:</h6>
                                                <p class="">Rp <?= currency($data_user['point']) ?>,-</p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Level:</h6>
                                                <p class=""><?= $data_user['level'] ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Downline:</h6>
                                                <p class=""><?= currency($call->query("SELECT id FROM users WHERE uplink = '" . $data_user['referral'] . "'")->num_rows) . ' User' ?></p>
                                            </div>
                                        </div>
                                        <div class="d-flex mt-1">
                                            <div>
                                                <h6 class="mb-0">Last Login:</h6>
                                                <p class=""><?= ($see_logs->num_rows == 1) ? format_date('en', $see_logs->fetch_assoc()['date']) : 'unknown' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="alert bg-gradient-info text-white text-center mt-2">Akumulasi Seluruh Transaksi</h5>
                                <div class="row">
                                    <div class="card-body statistics-body">
                                        <div class="row">
                                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                                <div class="media">
                                                    <div class="avatar bg-rgba-primary mr-1">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-credit-card text-primary font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="media-body my-auto">
                                                        <h4 class="font-weight-bolder mb-0">Rp <?= currency($total_deposit_paid["Totals"]) ?> <small class="card-text font-small-3 mb-0">(<?= $jumlah_deposit_paid ?>)</small></h4>
                                                        <p class="card-text font-small-3 mb-0">Deposit dibayarkan</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                                <div class="media">
                                                    <div class="avatar bg-rgba-warning mr-1">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-package text-warning font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="media-body my-auto">
                                                        <h4 class="font-weight-bolder mb-0">Rp <?= currency($total_price_game + $total_price_ppob + $total_price_socmed) ?><small class="card-text font-small-3 mb-0"> (<?= $total_success_socmed + $total_success_game + $total_success_ppob + $trx_row_gagal ?>)</small></h4>
                                                        <p class="card-text font-small-3 mb-0">Total Belanja</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                                <div class="media">
                                                    <div class="avatar bg-rgba-success mr-1">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-shopping-cart text-success font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="media-body my-auto">

                                                        <h4 class="font-weight-bolder mb-0">Rp <?= currency($trx_berhasil) ?> <small class="card-text font-small-3 mb-0">(<?= $total_success_socmed + $total_success_ppob + $total_success_game?>)</small></h4>
                                                        <p class="card-text font-small-3 mb-0">Transaksi Sukses</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                                <div class="media">
                                                    <div class="avatar bg-rgba-danger mr-1">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="media-body my-auto">
                                                        <h4 class="font-weight-bolder mb-0"><?= $trx_row_gagal ?></h4>
                                                        <p class="card-text font-small-3 mb-0">Transaksi Gagal</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            <div class="tab-pane fade " id="account-vertical-general" role="tabpanel" aria-labelledby="account-pill-general" aria-expanded="false">
                                <div class="media">
                                    <a href="javascript: void(0);">
                                        <img src="<?= $avatar ?>" class="rounded mr-75" alt="profile image" height="64" width="64">
                                    </a>
                                    <div class="media-body mt-75">
                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" onclick="window.open('https://en.gravatar.com/emails/')">Change Avatar</label>
                                            <button class="btn btn-sm btn-outline-warning ml-50" disabled>Reset</button>
                                        </div>
                                        <p class="text-muted ml-75 mt-50">
                                            <small>This photo is taken from <a href="https://en.gravatar.com" target="_BLANK">Gravatar</a>.</small>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <form method="POST">
                                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-username">Username</label>
                                                    <input type="text" class="form-control" id="account-username" value="<?= $sess_username ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="account-name" placeholder="Name" name="profile_name" value="<?= $data_user['name'] ?>" required data-validation-required-message="This name field is required" minlength="5" maxlength="32">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="store-name">Nama Toko</label>
                                                    <input type="text" class="form-control" id="store-name" placeholder="Store Name" name="profile_sname" value="<?= $json_user['store']['name'] ?>" required data-validation-required-message="This store name field is required" minlength="5" maxlength="64">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" name="profile" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                            <button type="reset" class="btn btn-outline-warning">Batalkan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                <form method="POST">
                                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-old-password">Password Lama</label>
                                                    <input type="password" class="form-control" id="account-old-password" name="oldpass" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-new-password">Password Baru</label>
                                                    <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-retype-new-password">Ketik Ualang Password Baru</label>
                                                    <input type="password" name="conpassword" class="form-control" id="account-retype-new-password" required data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" name="changepass" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                            <button type="reset" class="btn btn-outline-warning">Batalkan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-vertical-secure" role="tabpanel" aria-labelledby="account-pill-secure" aria-expanded="false">
                                <form method="POST">
                                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-new-secure">PIN Baru</label>
                                                    <input type="password" inputmode="numeric" name="pin" id="account-new-secure" class="form-control" placeholder="New PIN" required data-validation-required-message="The PIN field is required" minlength="6" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-retype-new-secure">Ketik Ulang PIN Baru</label>
                                                    <input type="password" inputmode="numeric" name="conpin" class="form-control" id="account-retype-new-secure" required data-validation-match-match="pin" placeholder="New PIN" data-validation-required-message="The Confirm PIN field is required" minlength="6" maxlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-old-secure">Password</label>
                                                    <input type="password" class="form-control" id="account-old-secure" name="oldpin" required placeholder="Password" data-validation-required-message="This Password field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" name="changepin" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan Perubahan</button>
                                            <button type="reset" class="btn btn-outline-warning">Batalkan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="account-vertical-exchange" role="tabpanel" aria-labelledby="account-pill-exchange" aria-expanded="false">
                                <form method="POST">
                                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="exchange-amount">Jumlah Yang Mau Di Tukar</label>
                                                    <input type="text" name="amount" id="exchange-amount" class="form-control" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" placeholder="min Rp1000" required data-validation-required-message="This field is required" maxlength="9">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-password">Password</label>
                                                    <input type="password" class="form-control" id="account-password" name="password" required placeholder="Password" data-validation-required-message="This Password field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" name="exchange" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Tukarkan</button>
                                            <button type="reset" class="btn btn-outline-warning">Batalkan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade " id="account-vertical-api" role="tabpanel" aria-labelledby="account-pill-api" aria-expanded="false">
                                <form method="POST">
                                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <div class="input-group">
                                                    <input class="form-control" value="<?= $data_userapi['uid'] ?>" disabled>
                                                    <div class="input-group-append">
                                                        <button type="submit" name="rebuildapi_uid" class="btn btn-primary waves-effect waves-light">
                                                            <i class="fas fa-random"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>API Key</label>
                                                <div class="input-group">
                                                    <input class="form-control" value="<?= $data_userapi['ukey'] ?>" disabled>
                                                    <div class="input-group-append">
                                                        <button type="submit" name="rebuildapi_key" class="btn btn-primary waves-effect waves-light">
                                                            <i class="fas fa-random"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Sign md5(ID + API Key)</label>
                                                <div class="input-group">
                                                    <input class="form-control" value="<?= md5($data_userapi['uid'].$data_userapi['ukey']) ?>" disabled>
                                                    <div class="input-group-append">
                                                        <button type="submit" name="rebuildsign_key" class="btn btn-primary waves-effect waves-light">
                                                            <i class="fas fa-random"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="alert bg-gradient-primary" role="alert">
                                                <i class="fas fa-info-circle align-middle"></i>
                                                <span>Lebih dari 1 IP Statis?<br>Pisahkan setiap IP dengan koma (,) Contoh: 192.1.1.1,192.1.1.2</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Whitelist IP</label>
                                                    <input class="form-control" name="ipstat" value="<?= $data_userapi['whitelist'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="api-status">API Status</label>
                                                <select class="form-control" name="apistatus" id="api-status">
                                                    <option disabled>- Select One -</option>
                                                    <?= select_opt($data_userapi['status'], 'development', 'Development') ?>
                                                    <?= select_opt($data_userapi['status'], 'production', 'Production') ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" name="changeapi" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan Perubahan</button>
                                            <button type="reset" class="btn btn-outline-warning">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<? require _DIR_('library/layout/modal');
require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
    function ShennForm(form, link) {
        $.ajax({
            url: link,
            type: 'POST',
            dataType: 'html',
            data: $(form).serialize(),
            success: function(data) {
                $('#sess-result-modal').html(data);
                $(form).load(link.split("?", 1) + " " + form + " > *");
                $('#account-vertical-info').load(" #account-vertical-info > *");
            },
            error: function() {
                $('#sess-result-modal').html(error_result);
            },
            beforeSend: function() {
                $('#sess-result-modal').html();
                $(form).html('<center>please wait...</center>');
            }
        });
    }
</script>