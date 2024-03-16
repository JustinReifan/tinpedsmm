<?php

require '../connect.php';
require _DIR_('library/session/auth');
require _DIR_('library/session/session');
require _DIR_('library/shennboku.app/auth-forgot');
require _DIR_('library/layout/header');
?>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="">
                <!--Start card Login-->
                <section class="flexbox-container">
                    <div class="col-xl-12 col-12 d-flex justify-content-center">
                        <div class="card rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-12 col-12 p-0">
                                    <div class="card rounded-0 mb-0 p-2">
                                        <div class="card-header pt-50 pb-1">
                                            <div class="card-title">
                                                <a href="<?= base_url() ?>">
                                                    <h4 class="mb-0"><i class="feather icon-unlock"></i> Pulihkan kata sandi Anda</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="px-2">Silakan masukkan alamat email Anda dan kami akan mengirimkan kode untuk terus mengubah kata sandi Anda.</p>
                                        <? require _DIR_('library/session/result'); ?>
                                        <div class="card-content">
                                            <div class="card-body pt-0 mt-1">
                                                <form method="POST" id="form-cp">
                                                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
                                                    <div class="form-label-group">
                                                        <input type="email" name="email" id="inputEmail" class="form-control" value="<?= @$_SESSION['changepass'] ?>" placeholder="Email Terdaftar" <?= isset($_SESSION['changepass']) ? 'readonly' : '' ?>>
                                                        <label for="inputEmail">Alamat Email</label>
                                                    </div>
                                                    <div class="form-label-group">
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <? if (isset($_SESSION['changepass'])) { ?>
                                                                    <button type="submit" name="cancel" class="btn btn-danger waves-effect waves-light">
                                                                        <i class="feather icon-x"></i>
                                                                    </button>
                                                                <? } ?>
                                                            </div>
                                                            <input type="text" name="otp" id="inputOTP" class="form-control" placeholder="Kode OTP" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" minlength="0" maxlength="6">
                                                            <div class="input-group-append">
                                                                <? if (isset($_SESSION['changepass'])) { ?>
                                                                    <button type="submit" name="resend" class="btn btn-primary waves-effect waves-light">
                                                                        Resend
                                                                    </button>
                                                                <? } else { ?>
                                                                    <button type="submit" name="sendautemail" class="btn btn-primary waves-effect waves-light">
                                                                        <i class="fas fa-paper-plane"></i> Kirim
                                                                    </button>
                                                                <? } ?>
                                                            </div>
                                                        </div>
                                                        <label for="inputOTP">Kode OTP</label>
                                                    </div>
                                                    <? if (isset($_SESSION['changepass'])) { ?>
                                                        <div class="form-label-group">
                                                            <div class="input-group">
                                                                <input type="password" name="password" id="inputPassword" data-toggle="password" class="form-control" placeholder="Password Baru">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            <label for="inputPassword">kata sandi baru</label>
                                                        </div>
                                                    <? } ?>
                                                    <div class="float-md-left d-block mb-1">
                                                        <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary btn-block px-75 waves-effect waves-light"><i class="fas fa-sign-in-alt"></i> Kembali Ke Login</a>
                                                    </div>
                                                    <? if (isset($_SESSION['changepass'])) { ?>
                                                        <div class="float-md-right d-block mb-1">
                                                            <button type="submit" name="confirm" class="btn btn-primary btn-block px-75 waves-effect waves-light"><i class="fas fa-unlock"></i> Pulihkan Kata Sandi</button>
                                                        </div>
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
                <!--End Card Login-->
            </div>
        </div>
</section>
<? require _DIR_('library/layout/footer.auth'); ?>