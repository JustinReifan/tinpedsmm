<?php
require '../connect.php';
require _DIR_('library/session/session');
require _DIR_('library/session/auth');
require _DIR_('library/shennboku.app/auth-register');
require _DIR_('library/layout/header');
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="">
                <!--Start card Register-->
                <div class="card-body">
                    <section class="row flexbox-container">
                        <div class="col-xl-12 col-12 d-flex justify-content-center">
                            <div class="card  rounded-0 mb-0">
                                <div class="row m-0">
                                    <div class="col-lg-12 col-12 p-0">
                                        <div class="card rounded-0 mb-0 p-2">
                                            <div class="card-header pt-50 pb-1">
                                                <div class="card-title">
                                                    <a href="<?= base_url() ?>">
                                                        <h4 class="mb-0"><i class="feather icon-user-plus"></i> Member Registrasi</h4>
                                                    </a>
                                                </div>
                                            </div>
                                            <p class="px-2">Isi Formulir di Bawah ini Untuk Membuat Akun Baru.</p>
                                            <? require _DIR_('library/session/result'); ?>
                                            <div class="card-content">
                                                <div class="card-body pt-0">
                                                    <form method="POST">
                                                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                                        <? if (isset($_SESSION['temp'])) { ?>
                                                            <? if ($_SESSION['temp']['whatsapp'] != false) { ?>
                                                                <div class="form-label-group">
                                                                    <input type="number" name="otpwa" id="otpwa" class="form-control" placeholder="Verification code sent to your whatsapp." required>
                                                                    <label for="otpwa">Phone Verification <font color="red">*</font></label>
                                                                </div>
                                                            <? } ?>
                                                            <div class="form-label-group">
                                                                <input type="text" name="otpgm" id="otpgm" class="form-control" placeholder="Verification code sent to your email address." required>
                                                                <label for="otpgm">Email Verification <font color="red">*</font></label>
                                                            </div>
                                                            <button type="submit" name="cancel" class="btn btn-outline-danger float-left btn-inline mb-50">Cancel</button>
                                                            <button type="submit" name="confirm" class="btn btn-primary float-right btn-inline mb-50">Register</button>
                                                        <? } else { ?>
                                                            <div class="form-label-group">
                                                                <input type="email" name="mail" id="inputEmail" maxlength="128" class="form-control" placeholder="Email (Aktif!)" required>
                                                                <label for="inputEmail">Email <font color="red">*</font></label>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <input type="text" name="name" id="inputfullName" onkeyup="this.value=this.value.replace(/[^A-Za-z ]/g,'')" maxlength="128" class="form-control" placeholder="Nama Lengkap" required>
                                                                <label for="inputfullName">Full Name <font color="red">*</font></label>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <input type="text" name="user" id="inputUsername" onkeyup="this.value=this.value.replace(/[^A-Za-z0-9]/g,'')" minlength="5" maxlength="18" class="form-control" placeholder="Username" required>
                                                                <label for="inputUsername">Username <font color="red">*</font></label>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <input type="text" name="phone" id="inputPhone" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" minlength="11" maxlength="14" class="form-control" placeholder="No Whatsapp (Aktif!)" required>
                                                                <label for="inputPhone">Whatsapp Number <font color="red">*</font></label>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <div class="input-group">
                                                                    <input type="password" name="pin" inputmode="numeric" id="inputtwo-factor" class="form-control" placeholder="PIN/2FA (6 digit)" data-toggle="password" required>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <div class="input-group">
                                                                    <input type="password" name="pas1" id="password" id="inputPassword" class="form-control" placeholder="Password (8 karakter)" data-toggle="password" required>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <div class="input-group">
                                                                    <input type="password" name="pas2" id="password2" id="inputConfPassword" class="form-control" placeholder="Konfirmasi Password" data-toggle="password" required>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <input type="text" name="code" id="code" id="inputReferall" class="form-control" placeholder="Referal Code (Optional)">
                                                                <label for="inputReferall">*Referal Code</label>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <label>Recaptcha <font color="red">*</font></label>
                                                                <div class="g-recaptcha" data-sitekey="<?= $_CONFIG['reCAPTCHA']['site'] ?>"></div>
                                                            </div>
                                                            <div class="form-label-group">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="accepttos" id="AcceptTOS" value="true">
                                                                    <label class="custom-control-label text-dark" for="AcceptTOS">Setuju dengan <a href="<?= base_url('page/terms-of-service.php') ?>" target="BLANK" class="text-primary">Syarat ketentuan</a></label>
                                                                </div>
                                                            </div>
                                                            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary float-left btn-inline mb-50">Masuk</a>
                                                            <button type="submit" name="sendOTP" class="btn btn-primary float-right btn-inline mb-50">Verifikasi</button>
                                                        <? } ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!--End Card Register-->
            </div>
        </div>
</section>
<? require _DIR_('library/layout/footer.auth'); ?>