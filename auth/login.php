<?php
require '../connect.php';
require _DIR_('library/session/auth');
require _DIR_('library/shennboku.app/auth-login');
require _DIR_('library/session/session');
require _DIR_('library/layout/header');


?>


<!--=========================================================-->  
<!--batas untuk di edit by babybot/nurhadi-->  
<!--=========================================================-->  
<div id="carouselExampleCaptions" class="carousel slide mb-0" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li><li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li> </ol>
<div class="carousel-inner" style="border-radius: 30px;" role="listbox">
<div class="carousel-item carousel-item-next carousel-item-left"><a href="/auth/login" class="image-popup"><img class="d-block img-fluid" src="/bannerhadi/had1.png"></a></div>
</div>
          </div>
            </div>
<!--=========================================================-->  
<!--batas untuk di edit by babybot/nurhadi-->  
<!--=========================================================-->  
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="">

                <!--Start card Login-->
                <div class="">
                    <section class=" row flexbox-container">
                        <div class="col-xl-12 col-12 d-flex justify-content-center">
                            <div class="card bg-authentication rounded-0 mb-0">
                                <div class="row m-0">
                                    
                                    <div class="col-lg-12 col-12 p-0">
                                        <div class="card rounded-0 mb-0 px-2">
                                            <div class="card-header pb-1">
                                                <div class="card-title">
                                                    <a href="<?= visited() ?>">
                                                        <h4 class="mb-0"><i class="feather icon-log-in"></i> Welcome To <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url() ?>">
                            <div class=""></div>👋
                            <h2 class="brand-text mb-0"><?= $_CONFIG['navbar']; ?></h2>
                        </a></li></h4>
                                                    </a>
                                                </div>
                                            </div>
                                            <!--<div id="spinner-div" class="pt-">-->
                                            <!--    <div class="spinner-border text-primary loading-btn" role="status">-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <p class="px-2">Selamat Datang Kembali, Silakan Login ke Akun Anda.</p>
    
                                            <? require _DIR_('library/session/result'); ?>
                                            <div class="card-content">
                                                <div class="card-body pt-1">
                                                    <form method="POST">
                                                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                            <input type="text" class="form-control" name="user" id="user-name" placeholder="Username/Email/Phone(62)" required>
                                                            <div class="form-control-position">
                                                                <i class="feather icon-user"></i>
                                                            </div>
                                                            <label for="user-name">Username/Email/Nomer(62)<font color="red">*</font></label>
                                                        </fieldset>

                                                        <fieldset class="form-label-group position-relative has-icon-left">
                                                            <input type="password" class="form-control" name="pass" id="user-password" placeholder="Password" required>
                                                            <div class="form-control-position">
                                                                <i class="feather icon-lock"></i>
                                                            </div>
                                                            <label for="user-password">Password Akun<font color="red">*</font></label>
                                                        </fieldset>
                                                        <div class="form-group">
                                                            <div class="g-recaptcha"data-sitekey="<?= $_CONFIG['reCAPTCHA']['site'] ?>"></div>
                                                        </div>
                                                        <div class="form-group d-flex justify-content-between align-items-center">
                                                            <div class="text-left">
                                                                <fieldset class="checkbox">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <input type="checkbox" name="remember" value="true" checked>
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                        <span class="">Ingat saya</span>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                            <div class="text-right"><a href="<?= base_url('auth/forgot') ?>" style="cursor: pointer !important;" class="card-link">Lupa Password?</a></div>
                                                        </div>
                                                        <a href="<?= base_url('auth/register') ?>" style="cursor: pointer !important;" class="btn btn-outline-primary float-left btn-inline"><i class="fas fa-user-plus"></i> Daftar</a>
                                                        <button name="login" type="submit" style="cursor: pointer !important;" class="btn btn-primary float-right btn-inline bt-spin"><i class="fas fa-sign-in-alt"></i> Masuk</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="login-footer">
                                                <div class="divider">
                                                    <div class="divider-text"></div>
                                                </div>
                                                <div class="footer-btn d-inline text-center">
                                                    <a href="<?= base_url('page/product') ?>" style="cursor: pointer !important;" class="btn btn-relief-info btn-block btn-inline waves-effect waves-light white font-weight-normal"><i class="fa fa-file-text white" aria-hidden="true"></i> Daftar Harga</a>
                                                </div>
                                                <div class="login-footer">
                                                    <div class="divider">
                                                        <div class="divider-text">CONTACT</div>
                                                    </div>
                                                    <div class="footer-btn d-inline text-center">
                                                        <a style="cursor: pointer !important;" href="https://instagram.com/<?= conf('webscmd', 2) ?>" target="<?= (!conf('webscmd', 2)) ? '' : '_blank' ?>" class="btn btn-instagram"><span class="fab fa-instagram white"></span></a>
                                                        <a style="cursor: pointer !important;" href="https://wa.me//6281932888380" target="https://wa.me//6281932888380 '' : '_blank' ?>" class="btn btn-facebook bg-success"><span class="fab fa-whatsapp white"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
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
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">1 </strong></span><span style="font-size: 15px"> - Pastikan Akunmu sudah terdaftar.</span></li>
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">2 </strong></span><span style="font-size: 15px"> - Jika belum terdaftar, klik Daftar untuk mendaftarkan akun yang baru. </span></li>
                        <li><span style="font-size: 15px"><strong style="font-weight: bold">3</strong></span><span style="font-size: 15px"> - Kontak CS kami jika anda kesulitan untuk login/register</span></li>
                       

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

                <!--End Card Login-->
            </div>
        </div>
</section>
<script>
    $(document).ready(function () {
    $(".bt-spin").click(function () {//The load button
        $('#spinner-div').show();//Load button clicked show spinner
        $.ajax({
            url: "https://member.rotasipedia.com/auth/login",
            type: 'GET',
            dataType: 'json',
            success: function (res) {
               //On success do something....
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
        });
    });
});
</script>
