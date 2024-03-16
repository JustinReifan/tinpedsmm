<?php
require '../connect.php';
require _DIR_('library/session/session');
require _DIR_('library/session/auth');
require _DIR_('library/shennboku.app/auth-register');
require _DIR_('library/layout/header');
?>

<section id="basic-datatable h-100vh">
    <div class="row">
        <div class="col-12">
            <div class="">
                <!--Start card Register-->
                <div class="">
                    <section class=" row flexbox-container">
                        <div class="col-xl-12 col-12 d-flex justify-content-center">
                            <div class="card rounded mb-0">
                                <div class="row m-0">
                                    <div class="col-lg-12 col-12 p-0">
                                        <div class="card rounded mb-0 p-2">
                                            <div class="card-header pt-50 pb-1">
                                                <div class="card-title">
                                                    <a href="<?= base_url() ?>">
                                                        <h4 class="mb-0"><i class="fas fa-user-cog"></i> Member Registrasi</h4>
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
                                                            <button type="submit" name="confirm" class="btn btn-primary float-right btn-inline mb-50">Verification</button>
                                                        <? } else { ?>

                                                            <div class=" position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fas fa-envelope" style="top: 24px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputEmail">Email <font color="red">*</font></label>
                                                                    <input type="email" name="mail" id="inputEmail" maxlength="128" class="form-control" placeholder="Email (Aktif!)" required>
                                                                </div>
                                                                <font style="position: relative; font-size: 8px; top: -22px !important;" color="red">Masukan Email yang benar untuk menerima kode OTP di Email! [Cek bagian spam]</font>
                                                            </div>

                                                            <div class=" position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fas fa-user" style="top: 24px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputfullName">Full Name <font color="red">*</font></label>
                                                                    <input type="text" name="name" id="inputfullName" onkeyup="this.value=this.value.replace(/[^A-Za-z ]/g,'')" maxlength="128" class="form-control" placeholder="Nama Lengkap" required>

                                                                </div>
                                                            </div>

                                                            <div class=" position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fas fa-user-shield" style="top: 24px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputUsername">Username <font color="red">*</font></label>
                                                                    <input type="text" name="user" id="inputUsername" onkeyup="this.value=this.value.replace(/[^A-Za-z0-9]/g,'')" minlength="5" maxlength="18" class="form-control" placeholder="Username" required>
                                                                </div>
                                                            </div>
                                                        
                                                           
                                                               
                                                            <div class=" position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fab fa-whatsapp-square" style="top: 24px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPhone">Number Whatsapp<font color="red">*</font></label>
                                                                    <input type="text" name="phone" id="inputPhone" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" minlength="11" maxlength="14" class="form-control" placeholder="No Whatsapp (Aktif!)" required>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class=" position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fas fa-shield-alt" style="top: 24px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-group ">
                                                                        <label for="inputPhone">PIN Keamanan <font color="red">*</font></label>
                                                                        <div class="input-group">
                                                                            <input type="password" name="pin"  minlength="6" maxlength="6" inputmode="numeric" id="inputtwo-factor" class="form-control" placeholder="PIN/2FA (6 digit)" data-toggle="password" required>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fas fa-key" style="top: 21px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPhone">Password <font color="red">*</font></label>
                                                                    <div class="input-group">
                                                                        <input type="password" name="pas1" id="password" id="inputPassword" class="form-control" placeholder="Password (8 karakter)" data-toggle="password" required>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fas fa-key" style="top: 21px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPhone">Konfirmasi Password <font color="red">*</font></label>
                                                                    <div class="input-group">
                                                                        <input type="password" name="pas2" id="password2" id="inputConfPassword" class="form-control" placeholder="Konfirmasi Password" data-toggle="password" required>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="position-relative has-icon-left">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-gift" style="top: 24px;"></i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputReferall">Referal Code</label>
                                                                    <input type="text" name="code" id="code" id="inputReferall" class="form-control" placeholder="Referal Code (Kosongkan jika tidak ada)">

                                                                </div>
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
                                                            
                                                            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary float-left btn-inline mb-50"><i class="fas fa-sign-in-alt"></i> Masuk</a>
                                                            <button type="submit" name="sendOTP" class="btn btn-primary float-right btn-inline mb-50"><i class="fas fa-user-check"></i> Register</button>
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
                  </div>
                 <div class="row" style="margin-top:5px;">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-body">
                    <p class="text-center"><span style="font-size: 20px"><span class="text-info"><span style="text-align: CENTER"><strong class="text-info" style="font-weight: bold">PERHATIAN  <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url() ?>">
                            <div class=""></div>
                            <h2 class="brand-text mb-0"><?= $_CONFIG['navbar']; ?></h2>
                        </a></li>
                    <ul class="text-dark">
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">1 </strong></span><span style="font-size: 15px"> - Kosongkan refferal code jika tidak ada.</span></li>
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">2 </strong></span><span style="font-size: 15px"> - Pastikan isi data yang sesuai, Isi email & no whatsapp aktif untuk mendapatkan kode verifikasi.</span></li>
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">3</strong></span><span style="font-size: 15px"> - Klik masuk/login jika sudah mendaftar untuk masuk ke website dengan akun yang sudah terbuat.</span></li>
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">4</strong></span><span style="font-size: 15px"> - Isi kode verifikasi dari email yang terkirim ke email anda yang sudah didaftarkan barusan</span></li>
                       

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!DOCTYPE html>
<html>
<head>
<a href="https://api.whatsapp.com/send?phone=6281932888380">
<img src="https://hantamo.com/free/whatsapp.svg" class="wabutton" alt="Whatsapp-Button" />
</a>
<style>
.wabutton{
width:60px;
height:60px;
position:fixed;
bottom:80px;
right:20px;
z-index:100;
}
</style>
                <!--End Card Register-->
            </div>
        </div>
</section>
<? require _DIR_('library/layout/footer.auth'); ?>