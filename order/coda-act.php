<?php 
require '../connect.php';
require _DIR_('library/session/user');

$get_s = isset($_GET['s']) ? str_replace('-',' ',filter($_GET['s'])) : '';
$search_cat = $call->query("SELECT * FROM category WHERE name = '$get_s' AND `order` = 'game'");
if($search_cat->num_rows == 0) exit(redirect(0,base_url('order/game')));
$data_cat = $search_cat->fetch_assoc();
$operator = $data_cat['name'];

$list_userid = ['Zepetto','PB Zepetto','Light of Thel','Lords Mobile','Dragon Raja','Garena Shell Murah','PB Zepetto','Call of Duty Mobile','PUBGM MOBILE','PUBGM New State','HAGO','Light of Thel','Dragon Raja','Lords Mobile','League of Legends Wild Rift','World of Dragon Nest','Dragon Raja','Higgs Domino','Garena Shell Murah','RagnaroK X Next Generation','Voucher Valorant','Speed Drifters','Super Sus',
'Voucher PB Zepetto','Tom and Jerry Chase','Voucher Megaxus','Voucher PUBG','Voucher Alfamart','Voucher Indomart','GO PAY','DANA','OVO','GRAB','Shopeepay','LinkAja','MAXIN','TIX ID','WIFI ID','HOTEL MURAH','Voucher Unipin'
,'HAGO','LOST SAGA','AU2 MOBILE','Rules of Survey Mobile','King of King','Bullet Angel','Manga Toon','Mango Live','Chaos Crisis','Scroll of Onmyoji','Tales of Jades','Domino QiuQiu'
,'Capsa Susun','Ludo Club','Love Nikki','Live After Credits','Ride Out Heroes','Call of Duty Mobile','POINT BLANK'];

if(conf('xtra-fitur',2) <> 'true') exit(redirect(0,base_url()));
require _DIR_('library/shennboku.app/order-games');
require _DIR_('library/layout/header.user');
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.7.95/css/materialdesignicons.css" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<style>
input.checked[type="radio"]{
    visibility:hidden;
    margin-left:-5px;
    margin-right:2px;
    background-color: #7367F0 !important;
}
    
input[type='radio']:checked:after {
    width: 15px;
    height: 15px;
    border-radius: 15px;
    top: -2px;
    left: -1px;
    position: relative;
    border-color: #4839EB !important;
    background-color: #7367F0 !important;
    content: '';
    display: inline-block;
    visibility: hidden;
    border: 2px solid white;
    margin-left:-5px;
    margin-right:2px;
}

.notice-purple { border-color: #694D9F;background: #694D9F;color: #fff; }
.notice-info-alt { border-color: #B4E1E4;background: #81c7e1;color: #fff; }
.notice-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
.notice-warning-alt { border-color: #F3F3EB;background: #E9CEAC;color: #fff; }
.notice-success-alt { border-color: #19B99A;background: #20A286;color: #fff; }
.glyphicon { margin-right:10px; }
.notice a {color: gold;}

</style>
<style>
.container-notice { box-sizing: border-box } .container-notice .notice { margin-bottom: 10px } .container-notice .notice:last-child { margin-bottom: 0 } .notice { width: 100%;margin-bottom: 15px; padding: 15px; position: relative; border-left: 8px solid #bababa; background: #ea5455; color: #a1a1a1; border-radius: 4px; display: -ms-flexbox; display: flex; -ms-flex-pack: center; justify-content: center; -ms-flex-align: center; align-items: center; text-align: left; font-size: 16px } .notice .notice--close, .notice .notice--icon { height: 100%; display: -ms-flexbox; display: flex; -ms-flex-pack: center; justify-content: center; -ms-flex-align: center; align-items: center; font-size: 20px } .notice .notice--close_absolute, .notice .notice--icon_absolute { position: absolute; top: 10px; right: 10px; -ms-flex-align: start; align-items: flex-start; height: auto } .notice .notice--icon { margin-right: 10px } .notice .notice--close { margin-left: 10px; opacity: .7; transition: .5s; cursor: pointer } .notice .notice--close:hover { opacity: 1 } .notice .notice--content { width: 100%; line-height: 1.5 } .notice .notice--buttons { width: 100%; margin-top: 10px } .notice_sm { padding: 10px; font-size: 14px } .notice_sm .notice--close, .notice_sm .notice--icon { font-size: 16px } .notice_lg { font-size: 26px } .notice_lg .notice--close, .notice_lg .notice--icon { font-size: 26px } .notice .hr { height: 1px; width: 100%; border: none; background: #ddd; margin: 10px 0 } .notice_success { border-color: #2ed573; background: #c3f3d7; color: #23ad5c } .notice_success .hr { background: #23ad5c } .notice_danger { border-color: #ff4757; background: #ffe0e3; color: #ff4757 } .notice_primary { border-color: #675cdb; background: #7367F0; color: #675cdb } .notice_danger .hr { background: #ff4757 } .notice_warning { border-color: #ffa502; background: #ffdb9b; color: #ce8500 } .notice_warning .hr { background: #ce8500 } .notice_info { border-color: #71c9ff; background: #d7f0ff; color: #3eb6ff } .notice_info .hr { background: #3eb6ff } .notice_dark { border-color: #333; background: #4d4d4d; color: #ccc } .notice_dark .hr { background: #1a1a1a } @keyframes shownotice { from { opacity: 0; transform: translateY(20px) } to { opacity: 1 } } .notice { transition: .5s ease-in-out; visibility: visible; opacity: 1; height: auto; overflow: hidden; animation-name: shownotice; animation-duration: .5s; animation-fill-mode: both } .notice.notice_none { display: none } .fixed-notices { box-sizing: border-box; position: fixed; z-index: 9999999; width: calc(100% - 20px); max-width: calc(400px - 20px) } .fixed-notices_bottom { bottom: 10px } .fixed-notices_top { top: 10px } .fixed-notices_right { right: 10px } .fixed-notices_left { left: 10px } .fixed-notices .notice { box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1); margin-bottom: 10px } .fixed-notices .notice:last-child { margin-bottom: 0 }
</style>

<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
            <a href="../game" style="color:#1E1E1E !important;">
                <b><i class="fas fa-chevron-circle-left"></i></b> Kembali ke Halaman Utama
            </a>
        </div>
    </div>
    <br>
<div class="modal fade" id="exampleModal-7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-7" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel-7"><b>KETENTUAN NETFLIX</b></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<li>Mohon untuk tidak mengubah apapun baik email, password, profile, payment, dll.</li>
<li>Jangan login lebih dari 1 device dalam 1 profil.</li>
<li>Jika ingin login ke device lain, harap logout dahulu device sebelumnya.</li>
<li>Jangan pernah masuk ke profile lain.</li>
<li>Jangan menggunakan VPN saat nonton.</li>
<li>Jangan sering login-logout karena bisa terjadi incorrect password.</li>
<li>Garansi full selama durasi.</li>
<li>Melanggar rules = garansi hangus + denda</li>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
</div>
</div>
</div>
</div>

<? if(in_array($operator, ['Netflix Premium'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-check-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>Perhatikan:</b> Kolom ke-2 Request Profile + PIN 4 Digit</small>
    </div>
</div>
</div>
</div>

<? } ?>

<? if(in_array($operator, ['PUBGM GLOBAL','PUBGM INDO A','PUBGM INDO B'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Hati-hati dalam melakukan pemesanan! Pesanan di proses secara Instant, selalu cek Riwayat Pesanan Anda</small>
    </div>
</div>
</div>
</div>

<? } ?>

<? if(in_array($operator, ['Mobile Legends A','Mobile Legends B','Free Fire','Free Fire Max','Free Fire Promo' ])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<? } ?>
<? if(in_array($operator, ['Mobile Legends Membership'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-check-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>INFO:</b> Starlight Member Semi Fast Open pukul 09:00 - 23:00 WIB</small>
    </div>
</div>
</div>
</div>

<? } ?>
<? if(in_array($operator, ['Canva Pro','Disney Hotstar' ])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<? } ?>

<? if(in_array($operator, ['Mobile Legends Joki Rank','Mobile Legends Vilog'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Login Akun Moonton, VK, TikTok (Matikan verifikasi 2 langkah)</small>
    </div>
</div>
</div>
</div>


<? } ?>


<? if(in_array($operator, ['Apex Legends Mobile'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice-danger" role="notice" style="color:#d71a1c !important;font-size:12px">
<i class="fas fa-angle-double-right"></i> 
<button type="button" class="close" data-dismiss="notice" aria-hidden="true">×</button> <b>PENTING</b> Baca Informasi Paling Bawah!
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice-primary" role="notice" style="color:#4C4993 !important;font-size:12px">
<i class="fas fa-angle-double-right"></i> Maximal 20 karater ID Apex Legends
</div>
</div>
</div>
<? } ?>

<? if(in_array($operator, ['Mobile Legends Gift','Genshin Impact','Genshin Impact Vilog','Tower of Fantasy','Marvel Super War','Lita','Valorant','Honkai Impact 3','Arena of Valor','LifeAfter','Steam Wallet Code','League of Legends','Hyper Front','Apple Gift Card','Spotify Premium','Vidio Premier','WeTV Premium','Youtube Premium','iQIYI Premium'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="notice notice_danger">
    <div class="notice--icon">
        <i class="feather icon-x-circle"></i>
    </div>
    <div class="notice--content">
            <small><b>PENTING:</b> Pastikan baca informasi terlebih dahulu!</small>
    </div>
</div>
</div>
</div>
<? } ?>

<style>
.strip-primary {
        background-color: #4839eb;
        position: absolute;
        width: 60px;
        height: 2px;
        border-radius: 10px;
        margin: 2px;
    }
    .logo-atas {
        height: 30px;
    }
    .logo-order {
        width: 100%;
        float: left;
        /* margin-right: 8px;
        margin-bottom: auto; */
    }
    .logo-order2 {
        width: 100%;
        float: left;
        /* margin-right: 8px;
        margin-bottom: auto; */
    }
    .logo-order3 {
        width: 100%;
        float: left;
        /* margin-right: 8px;
        margin-bottom: auto; */
    }

    .logo-bawah {
        height: 60px;
        float: left;
        margin-right: 8px;
        margin-bottom: auto;
    }
</style>

<form method="POST" id="myForm">
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $csrf_string ?>">
    


<!----===========[ ROW GAME ]===========---->

    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                   <h4 class="header-title">
                        <i class="mdi mdi-numeric-1-box-multiple-outline primary"></i>
                        <b>Data Tujuan</b>
                    </h4>
                    <div class="row">
                        <? if(in_array($operator, ['Netflix Premium'])) { ?>
                        <div class="form-group col-md-10">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required>
                        </div>
                        <div class="form-group col-md-2">
                        <input type="text" class="form-control" name="target2" id="target2" placeholder="Request Profile + PIN" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        
                        <? if(in_array($operator, ['Spotify Premium'])) { ?>
                        <div class="form-group col-md-12">
                        <!--<input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required> -->
                        <textarea class="form-control" placeholder="- Email :
- Profile :                        
- Password : (khusus perpanjang)" name="target" id="target" rows="3" style="height: 81px;"></textarea>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda. Untuk menemukan Nama Profile Spotify klik icon ⚙️ (pojok kanan atas) lalu tertera Nama Profile (bukan username)
                        <br /><b>Note :</b> Apabila order produk perpanjang wajib mengisi password.</small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['WeTV Premium'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Vidio Premier'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Youtube Premium'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Apple Gift Card'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Nomer Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan nomor telepon saat transaksi. Kode Voucher cek detail Riwayat Pesanan, validasi 100%
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Telegram Premium'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Nomer Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Untuk menemukan Nomor Telegram Anda, masuk ke akun Anda di aplikasi. Klik tombol pengaturan dan Anda dapat menemukan Nomor Telegram Anda di bawah gambar profil Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Canva Pro'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['iQIYI Premium'])) { ?>
                        <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="target" id="target" placeholder="Email Tujuan" required>
                        </div>
                        <div class="form-group col-12">
                        <font><small>Masukan alamat email aktif Anda. Akun atau link invite akan di kirim melalui alamat email Anda.
                        </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Honkai Impact 3'])) { ?>
                        <div class="form-group col-md-12">
                          <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan User ID Anda, buka aplikasi <b>Honkai Impact 3</b>, klik pada informasi level yang terletak di kiri atas layar, temukan User ID Anda disana. Silakan masukan User ID Anda disini.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Steam Wallet Code'])) { ?>
                        <div class="form-group col-md-12">
                          <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan Nomer Telepon" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Masukan nomor telepon saat transaksi, kode voucher cek di detail riwayat pesanan, validasi 100% valid!.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Disney Hotstar'])) { ?>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="target" id="target" placeholder="" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Masukan nomor whatsapp Anda. Nomor dan otp disney akan di kirim melalui whatsapp Admin.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Apex Legends Mobile'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan ID Apex Legends Mobile. Klik profil user di pojok kiri atas. Pilih menu profil di sebelah kanan atas dan temukan ID-mu di atas foto profil.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['League of Legends'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan Riot ID Anda, buka halaman profil akun dan salin Riot ID+Tag menggunakan tombol yang tersedia disamping Riot ID. (Contoh: <b>Enternity#123</b>)
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Sausage Man'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk mengetahui User ID Anda, Silakan Klik menu profile dibagian kiri atas pada menu utama game. Dan user ID akan terlihat dibagian bawah kanan Karakter Game Anda. Silakan masukkan User ID Anda untuk menyelesaikan transaksi. Contoh ID: <b>Enternity</b>
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Lita'])) { ?>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan Account ID Anda, Klik <b>Profile</b> akun Anda di pojok bawah kanan. Anda akan menemukan ID dibawah nama akun Anda.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Omega Legends'])) { ?>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan IGG Anda, buka halaman Pengaturan yang ada di pojok kiri bawah game, pilih Akun, ID IGG dapat Anda lihat tercantum disana. Silakan masukan ID IGG Anda di sini.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Valorant'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="User ID Tujuan" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan Riot ID Anda, buka halaman profil akun dan salin Riot ID+Tag menggunakan tombol yang tersedia disamping Riot ID. (Contoh: <b>Enternity#123</b>)
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Hyper Front'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <select name="target2" id="target2" class="form-control" required>
                                <option value="">Pilih Server</option>
                                <option value="SEA">SEA</option>
                            </select>
                        </div>

                        <div class="form-group col-12">
                       <font><small>Untuk menemukan ID Pengguna Anda, masuk ke akun Anda di aplikasi. Klik tombol pengaturan dan Anda dapat menemukan ID Pengguna Anda di bawah gambar profil Anda.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Arena of Valor'])) { ?>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" name="target" id="target" placeholder="User ID Tujuan" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan User ID Anda, Ketuk ikon pengaturan, scroll ke bawah, temukan bagian "Umum", lalu Klik "Player ID". Contoh: "<b>888347346994333</b>".
                       </small></font> </div>
                        <? } ?>
                        
                       <? if(in_array($operator, ['Call of Duty Mobile'])) { ?>
                           <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Marvel Super War'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan ID Anda, buka aplikasi Marvel Super War, klik pada ikon avatar yang terletak di pojok kiri atas layar lalu klik pada tombol <b>Kode QR</b>, ID dapat Anda temukan disana. Silakan masukan ID Anda di sini.
                       </small></font> </div>
                        <? } ?>
                        
                         <? if(in_array($operator, ['One Punch Man' ])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required >
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="(Server ID)" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Cara memeriksa info pemain: Masuk ke game, klik "Mall" di area Kota Utama, lalu ketuk tombol "Top up". Di jendela "Top up" kamu dapat menemukan SID dan UID di sudut kiri bawah.
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Free Fire','Free Fire Max','Free Fire Promo'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Massukan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan ID Anda, ketuk pada ikon karakter. User ID tercantum di bawah nama karakter Anda. Contoh: ( <b>5363266446</b> )
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['PUBGM GLOBAL','PUBGM INDO A','PUBGM INDO B'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Massukan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan user id anda, klik foto profil yang terletak di pojok kanan atas, di sudut kiri akan terlihat informasi ID. Contoh: ( <b>5363266446</b> )
                       </small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Mobile Legends A','Mobile Legends B' ])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required >
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="(Zona ID)" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk mengetahui User ID Anda, Silakan Klik menu profile dibagian kiri atas pada menu utama game. Dan user ID akan terlihat dibagian bawah Nama Karakter Game Anda. Silakan masukkan User ID Anda untuk menyelesaikan transaksi. Contoh : <b>12345678 (1234)</b>.

                       </small></font> </div>
                        <? } ?>
                        <? if(in_array($operator, ['Mobile Legends Vilog'])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="Masukkan Password" required>
                        </div>
                        <div class="form-group col-md-4">
                        <select class="form-select form-control" id="additional_data" name="additional_data" required>
                        <option> Pilih salah satu</option>
                        <option value="Moonton"> Moonton</option>
                        <option value="TikTok"> TikTok</option>
                        <option value="VK"> VK</option>
                        </select>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Masukan Email dan Password Akun Anda (<b>Matikan verifikasi 2 langkah</b></b>) perhatikan besar dan kecilnya huruf. Setelah pesanan berhasil, wajib untuk mengganti <b>Password Akun Anda</b>.</small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Mobile Legends Joki Rank'])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="Masukkan Password" required>
                        </div>
                        <div class="form-group col-md-4">
                        <select class="form-select form-control" id="additional_data" name="additional_data" required>
                        <option> Pilih salah satu</option>
                        <option value="Moonton"> Moonton</option>
                        <option value="TikTok"> TikTok</option>
                        <option value="VK"> VK</option>
                        </select>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Masukan Email dan Password Akun Anda (<b>Matikan verifikasi 2 langkah</b></b>) perhatikan besar dan kecilnya huruf. Setelah pesanan berhasil, wajib untuk mengganti <b>Password Akun Anda</b>.</small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Mobile Legends Joki Code'])) { ?>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan Code Referral" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="Masukkan Link Screenshot" required>
                        </div>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan Code Referral Anda. ketuk pada icon Friend Referral terletak pada kiri atas dekat Profile. <b>Contoh: "LLW42XX"</b></small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['eFootball 2023 Vilog'])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan Email (Nickname)" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="Masukkan Password" required>
                        </div>
                        <div class="form-group col-md-4">
                        <select class="form-select form-control" id="additional_data" name="additional_data" required>
                        <option value="0" selected disabled>- Pilih Salah Satu -</option>
                        <option value="Konami ID"> Konami ID</option>
                        <option value="Google"> Google</option>
                        </select>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Masukan Email dan Password Akun Anda (<b>Matikan verifikasi 2 langkah</b>) perhatikan besar dan kecilnya huruf. Setelah pesanan berhasil, wajib untuk mengganti <b>Password Akun Anda</b>.</small></font> </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Mobile Legends Membership'])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="(....) Zona" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk mengetahui User ID Anda, Silakan Klik menu profile dibagian kiri atas pada menu utama game. Dan user ID akan terlihat dibagian bawah Nama Karakter Game Anda. Silakan masukkan User ID Anda untuk menyelesaikan transaksi. Contoh : <b>12345678</b> (<b>1234</b>). Detail informasi bisa cek di halaman ini paling bawah.</small></font> </div>
                        <? } ?>
                        <? if(in_array($operator, ['Mobile Legends Gift'])) { ?>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="target" id="target" placeholder="User ID + Zona ID" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="Nama Skin / Item" required>
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk mengetahui User ID Anda, Silakan Klik menu profile dibagian kiri atas pada menu utama game. Dan user ID akan terlihat dibagian bawah Nama Karakter Game Anda. Silakan masukkan User ID Anda untuk menyelesaikan transaksi. Contoh : <b>12345678</b> (<b>1234</b>). Detail informasi bisa cek di halaman ini paling bawah.</small></font> </div>
                        <? } ?>

                        
                        <? if(in_array($operator, ['Genshin Impact'])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required>
                        </div>
                        <div class="form-group col-md-4">
                        <select name="target2" id="target2" class="form-control" required>
                        <option value="">Pilih Server</option>
                        <option value="America">America</option>
                        <option value="Asia">Asia</option>
                        <option value="Europe">Europe</option>
                        <option value="TW_HK_MO">TW_HK_MO</option>
                        </select>
                        </div><div class="form-group col-md-4">
                        <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" readonly>
                        </div>
                        <? } ?>
                        
                        <? if(in_array($operator, ['Genshin Impact Vilog'])) { ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="Masukkan Password" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                        <select class="form-select form-control" id="additional_data" name="additional_data" required>
                        <option value="0" selected disabled>- Pilih Salah Satu -</option>
                        <option value="Hoyoverse"> Hoyoverse</option>
                        <option value="Facebook"> Facebook</option>
                        <option value="Twitter"> Twitter</option>
                        </select>
                        </div>
                         <div class="form-group col-12">
                       <font><small>Masukan email dan password akun Anda (<b>Matikan verifikasi 2 langkah</b>) perhatikan besar dan kecilnya huruf. Setelah pesanan berhasil, wajib untuk mengganti password Akun Anda.</small></font> </div>
                        
                        <? } ?>

                        
                        <? if(in_array($operator, $list_userid)) { ?>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" name="target" id="target" placeholder="" required="">
                        </div>
                        <div class="form-group col-12">
                       <font><small>* Masukan Tujuan - ( <b>ID / Email Tujuan</b> )
                       </small></font> </div>
                    
                        <? } else if(substr($operator,0,13) == 'Mobile Legends') { ?>
                        
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan user ID" required>
                            
                        </div>
                        
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="target2" id="target2" placeholder="(....) Zona" required>
                        </div>
                        

                        
                        <? } else if(in_array($operator, ['Ragnarok M Eternal Love','LifeAfter'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan user ID" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <select name="target2" id="target2" class="form-control" required>
                                <option value="">Choose Server</option>
                                <? if(substr($operator,0,8) == 'Ragnarok') { ?>
                                <option value="Eternal Love">Eternal Love</option>
                                <option value="Midnight Party">Midnight Party</option>
                                <? } else if($operator == 'LifeAfter') { ?>
                                <option value="MiskaTown">MiskaTown</option>
                                <option value="SandCastle">SandCastle</option>
                                <option value="MouthSwamp">MouthSwamp</option>
                                <option value="RedwoodTown">RedwoodTown</option>
                                <option value="Obelisk">Obelisk</option>
                                <option value="FallForest">FallForest</option>
                                <option value="MountSnow">MountSnow</option>
                                <option value="NancyCity">NancyCity</option>
                                <option value="CharlesTown">CharlesTown</option>
                                <option value="SnowHighlands">SnowHighlands</option>
                                <option value="Santopany">Santopany</option>
                                <option value="LevinCity">LevinCity</option>
                                <? } ?>
                            </select>
                        
                        </div>
                        <div class="form-group col-12">
                       <font><small>Untuk menemukan Account ID Anda, buka aplikasi LifeAfter, lalu klik pengaturan yang terletak di kanan atas layar game dan Account ID akan terlihat. Silakan masukan Account ID Anda disini.
</small></font> </div>
                        

                        <? } else if(in_array($operator, ['Tower of Fantasy'])) { ?>
                        <div class="form-group col-md-7">
                            <input type="text" class="form-control" name="target" id="target" placeholder="Masukkan User ID" required="">
                        </div>
                        <div class="form-group col-md-4">
    <select name="target2" id="target2" class="form-control" required>
        <option value="">Choose Server</option>
        <option value="Southeast Asia-Osillron">Southeast Asia-Osillron</option>
        <option value="Southeast Asia-Mistilteinn">Southeast Asia-Mistilteinn</option>
        <option value="Southeast Asia-Illyrians">Southeast Asia-Illyrians</option>
        <option value="Southeast Asia-Florione">Southeast Asia-Florione</option>
        <option value="Southeast Asia-Animus">Southeast Asia-Animus</option>
        <option value="Southeast Asia-Gumi Gumi">Southeast Asia-Gumi Gumi</option>
        <option value="Southeast Asia-Oryza">Southeast Asia-Oryza</option>
        <option value="Southeast Asia-Saeri">Southeast Asia-Saeri</option>
        <option value="Southeast Asia-Phantasia">Southeast Asia-Phantasia</option>
        <option value="Southeast Asia-Mechafield">Southeast Asia-Mechafield</option>
        <option value="Southeast Asia-Ethereal Dream">Southeast Asia-Ethereal Dream</option>
        <option value="Southeast Asia-Odyssey">Southeast Asia-Odyssey</option>
        <option value="Southeast Asia-Aestral-Noa">Southeast Asia-Aestral-Noa</option>
        <option value="Southeast Asia-Chandra">Southeast Asia-Chandra</option>
        <option value="Southeast Asia-Aeria">Southeast Asia-Aeria</option>
        <option value="Southeast Asia-Scarlet">Southeast Asia-Scarlet</option>
        <option value="Southeast Asia-Fantasia">Southeast Asia-Fantasia</option>
        <option value="Southeast Asia-Stardust">Southeast Asia-Stardust</option>
        <option value="Southeast Asia-Arcania">Southeast Asia-Arcania</option>
        <option value="Southeast Asia-Valhalla">Southeast Asia-Valhalla</option>
        <option value="North America-Lunalite">North America-Lunalite</option>
        <option value="North America-Sol-III">North America-Sol-III</option>
        <option value="North America-Lighthouse">North America-Lighthouse</option>
        <option value="North America-Silver Bridge">North America-Silver Bridge</option>
        <option value="North America-The Glades">North America-The Glades</option>
        <option value="North America-Nightfall">North America-Nightfall</option>
        <option value="North America-Frontier">North America-Frontier</option>
        <option value="North America-Libera">North America-Libera</option>
        <option value="North America-Solaris">North America-Solaris</option>
        <option value="North America-Freedom-Oasis">North America-Freedom-Oasis</option>
        <option value="North America-The Worlds Between">North America-The Worlds Between</option>
        <option value="North America-Radiant">North America-Radiant</option>
        <option value="North America-Tempest">North America-Tempest</option>
        <option value="North America-New Era">North America-New Era</option>
        <option value="North America-Observer">North America-Observer</option>
        <option value="North America-Starlight">North America-Starlight</option>
        <option value="North America-Myriad">North America-Myriad</option>
        <option value="North America-Oumuamua">North America-Oumuamua</option>
        <option value="North America-Eternium Phantasy">North America-Eternium Phantasy</option>
        <option value="North America-Azure Plane">North America-Azure Plane</option>
        <option value="North America-Nirvana">North America-Nirvana</option>
        <option value="Europe-Magia Przygoda Aida">Europe-Magia Przygoda Aida</option>
        <option value="Europe-Transport Hub">Europe-Transport Hub</option>
        <option value="Europe-The Lumina">Europe-The Lumina</option>
        <option value="Europe-Lycoris">Europe-Lycoris</option>
        <option value="Europe-Ether">Europe-Ether</option>
        <option value="Europe-Olivine">Europe-Olivine</option>
        <option value="Europe-Iter">Europe-Iter</option>
        <option value="Europe-Aimanium">Europe-Aimanium</option>
        <option value="Europe-Alintheus">Europe-Alintheus</option>
        <option value="Europe-Andoes">Europe-Andoes</option>
        <option value="Europe-Anomora">Europe-Anomora</option>
        <option value="Europe-Astora">Europe-Astora</option>
        <option value="Europe-Valstamm">Europe-Valstamm</option>
        <option value="Europe-Blumous">Europe-Blumous</option>
        <option value="Europe-Celestialrise">Europe-Celestialrise</option>
        <option value="Europe-Cosmos">Europe-Cosmos</option>
        <option value="Europe-Dyrnwyn">Europe-Dyrnwyn</option>
        <option value="Europe-Elypium">Europe-Elypium</option>
        <option value="Europe-Excalibur">Europe-Excalibur</option>
        <option value="Europe-Espoir IV">Europe-Espoir IV</option>
        <option value="Europe-Estrela">Europe-Estrela</option>
        <option value="Europe-Ex Nihilor">Europe-Ex Nihilor</option>
        <option value="Europe-Futuria">Europe-Futuria</option>
        <option value="Europe-Hephaestus">Europe-Hephaestus</option>
        <option value="Europe-Midgard">Europe-Midgard</option>
        <option value="Europe-Kuura">Europe-Kuura</option>
        <option value="Europe-Lyramiel">Europe-Lyramiel</option>
        <option value="Europe-Magenta">Europe-Magenta</option>
        <option value="Europe-Omnium Prime">Europe-Omnium Prime</option>
        <option value="Europe-Turmus">Europe-Turmus</option>
        <option value="South America-Corvus">South America-Corvus</option>
        <option value="South America-Calodesma Seven">South America-Calodesma Seven</option>
        <option value="South America-Columba">South America-Columba</option>
        <option value="South America-Tiamat">South America-Tiamat</option>
        <option value="South America-Orion">South America-Orion</option>
        <option value="South America-Luna Azul">South America-Luna Azul</option>
        <option value="South America-Hope">South America-Hope</option>
        <option value="South America-Tanzanite">South America-Tanzanite</option>
        <option value="South America-Antlia">South America-Antlia</option>
        <option value="South America-Pegasus">South America-Pegasus</option>
        <option value="South America-Phoenix">South America-Phoenix</option>
        <option value="South America-Centaurus">South America-Centaurus</option>
        <option value="South America-Cepheu">South America-Cepheu</option>
        <option value="South America-Cygnus">South America-Cygnus</option>
        <option value="South America-Grus">South America-Grus</option>
        <option value="South America-Hydra">South America-Hydra</option>
        <option value="South America-Lyra">South America-Lyra</option>
        <option value="South America-Ophiuchus">South America-Ophiuchus</option>
        <option value="Asia-Pacific-Cocoaiteruyo">Asia-Pacific-Cocoaiteruyo</option>
        <option value="Asia-Pacific-Food Fighter">Asia-Pacific-Food Fighter</option>
        <option value="Asia-Pacific-Gomap">Asia-Pacific-Gomap</option>
        <option value="Asia-Pacific-Yggdrasil">Asia-Pacific-Yggdrasil</option>
        <option value="Asia-Pacific-Daybreak">Asia-Pacific-Daybreak</option>
        <option value="Asia-Pacific-Adventure">Asia-Pacific-Adventure</option>
        <option value="Asia-Pacific-Eden">Asia-Pacific-Eden</option>
        <option value="Asia-Pacific-Fate">Asia-Pacific-Fate</option>
        <option value="Asia-Pacific-Nova">Asia-Pacific-Nova</option>
        <option value="Asia-Pacific-Ruby">Asia-Pacific-Ruby</option>
        <option value="Asia-Pacific-Babel">Asia-Pacific-Babel</option>
        <option value="Asia-Pacific-Pluto">Asia-Pacific-Pluto</option>
        <option value="Asia-Pacific-Sushi">Asia-Pacific-Sushi</option>
        <option value="Asia-Pacific-Venus">Asia-Pacific-Venus</option>
        <option value="Asia-Pacific-Galaxy">Asia-Pacific-Galaxy</option>
        <option value="Asia-Pacific-Memory">Asia-Pacific-Memory</option>
        <option value="Asia-Pacific-Oxygen">Asia-Pacific-Oxygen</option>
        <option value="Asia-Pacific-Sakura">Asia-Pacific-Sakura</option>
        <option value="Asia-Pacific-Seeker">Asia-Pacific-Seeker</option>
        <option value="Asia-Pacific-Shinya">Asia-Pacific-Shinya</option>
        <option value="Asia-Pacific-Stella">Asia-Pacific-Stella</option>
        <option value="Asia-Pacific-Uranus">Asia-Pacific-Uranus</option>
        <option value="Asia-Pacific-Utopia">Asia-Pacific-Utopia</option>
        <option value="Asia-Pacific-Jupiter">Asia-Pacific-Jupiter</option>
        <option value="Asia-Pacific-Sweetie">Asia-Pacific-Sweetie</option>
        <option value="Asia-Pacific-Atlantis">Asia-Pacific-Atlantis</option>
        <option value="Asia-Pacific-Takoyaki">Asia-Pacific-Takoyaki</option>
        <option value="Asia-Pacific-Mars">Asia-Pacific-Mars</option>
    </select>
</div>
                             <div class="form-group col-12">
                       <font><small>Untuk menemukan ID Anda, Klik gambar karakter Anda dan pilih Other Info. Anda akan menemukan ID Anda di layar tersebut. Silakan masukkan ID Anda di sini. Contoh: 1234567890.
</small></font> </div>
                        <? } ?>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Nickname" hidden="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        <i class="mdi mdi-numeric-2-box-multiple-outline primary"></i>
                        <strong class="">Pilih Server</strong>
                    </h4>
                    <div class="row">
                        <?php
                        $search = $call->query("SELECT * FROM srv_game WHERE game = '$operator' AND status = 'available' ORDER BY server ASC"); $l=[];
                        while($row = $search->fetch_assoc()) {
                            if(!in_array($row['server'],$l)){
                                $l[]=$row['server'];
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                            <label class="btn btn-outline-primary col-md-auto w-100 mb-1 rounded waves-effect waves-light">
                                <input class="checked" type="radio" name="server" id="server" value="<?= $row['server'] ?>">
                                Server-<?= $row['server'] ?>
                            </label>
                        </div>
                        <? } } ?>
                    </div>
                   
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        <i class="mdi mdi-numeric-3-box-multiple-outline primary"></i>
                        <strong class="">Pilih Layanan</strong>
                    </h4>
                    <div class="row" id="service"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        <i class="mdi mdi-numeric-4-box-multiple-outline primary"></i>
                        <strong class="">Total Harga</strong>
                    </h4>
                    <div class="row">
                        <input type="hidden" name="jumlah" class="form-control" id="jumlah" value="1" readonly>
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Rp 0" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">
                        <i class="mdi mdi-numeric-5-box-multiple-outline primary"></i>
                        <b>PIN A2F</b>
                    </h4>
                    <div class="row">
                        <div class="form-group col-12 col-md-8">
                            <div class="input-group">
                                <input type="password" inputmode="numeric" class="form-control" id="password" name="pin" data-toggle="password" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" maxlength="6" minlength="6" placeholder="Authorization (A2F)" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <button type="submit" id="actionbutton" name="order" class="btn btn-danger btn-block" disabled><i class="fas fa-cart-arrow-down"></i>&nbsp;Order Now</button>
                            <div id="timerdiv" style="display:none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</form>
<? if(in_array($operator, ['Free Fire','Free Fire Max'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Free Fire Promo'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1-10 Menit - 180 Max Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Tower of Fantasy'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 5 - 10 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>

<? if(in_array($operator, ['Netflix Premium'])) { ?>
<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-small">
                    <b style="font-weight:800" class="badge badge-default">
                        <i class="fa fa-bullhorn"></i> INFO </b>
                </h6>- Contoh Input Pesanan <br>
                <i class="fas fa-angle-double-right"></i> Kolom 1: <a class="__cf_email__" data-cfemail="82f4ebf2e3fbefe7ecf6c2e5efe3ebeeace1edef">( Email&#160; Tujuan )</a>
                <br>
                <i class="fas fa-angle-double-right"></i> Kolom 2: <a class="__cf_email__" data-cfemail="82f4ebf2e3fbefe7ecf6c2e5efe3ebeeace1edef">( Request Profile + PIN )</a>
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <a href="#" data-toggle="modal" data-target="#exampleModal-7"> KETENTUAN NETFLIX (READ)</a>
                </b>

                <hr>
                <i class="fas fa-angle-double-right"></i> Garansi 1 bulan, estimasi proses 1-6 jam, maximal 24 jam
            </div>
        </div>
    </div>
</div>
<? } ?>

<? if(in_array($operator, ['Youtube Premium'])) { ?>
<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-small">
                    <b style="font-weight:800" class="badge badge-default">
                        <i class="fa fa-bullhorn"></i> INFO </b>
                </h6>
                <i class="fas fa-angle-double-right"></i> Estimasi Proses 10 - 59 Menit </div>
            </div>
        </div>
    </div>
<? } ?>

<? if(in_array($operator, ['PUBGM GLOBAL','PUBGM INDO A','PUBGM INDO B'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1 - 5 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Apex Legends Mobile','LifeAfter','Steam Wallet Code'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>

<? if(in_array($operator, ['Arena of Valor','Lita'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Valorant','League of Legends','Hyper Front','Marvel Super War'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1-10 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Honkai Impact 3'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 5-15 Menit Sukses Terkirim</span>&nbsp;)
</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Mobile Legends A','Mobile Legends B'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Open 24 Jam (&nbsp;<span style="color : #7367F0">Estimasi 1 Menit Sukses Terkirim</span>&nbsp;)

</div>
</div>
</div> 
<? } ?>

<? if(in_array($operator, ['Mobile Legends Joki Rank'])) { ?>
<div class="row">
<div class="col-12 col-md-10 offset-md-1">
<div class="card">
<div class="card-body">
<h6 class="font-weight-small"><b style="font-weight:800" class="badge badge-default"><i class="fa fa-bullhorn"></i> INFO</b></h6>
<i class="fas fa-angle-double-right"></i> Estimasi (&nbsp;<span style="color : #7367F0">Menyesuaikan dengan target joki rank</span>&nbsp;)
<hr>
<ul>
                        <li>Masukan Username + Password => <b>Contoh: suport@enternity.com (1234)</b>
                        </li>
                        <li>Target Login => <b>Contoh: Moonton</b>
                        </li>
                        <li>Pilih Server</li>
                        <li>Klik Beli Sekarang</li> Note: Detail informasi order akan di kirim melalui <a href="https://enternity.id/order/history/game-feature">Riwayat Pesanan</a>
                        <br>
                    </ul>

</div>
</div>
</div>
</div> 
<? } ?>
<? if(in_array($operator, ['Mobile Legends Gift'])) { ?>
<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-small">
                    <b style="font-weight:800" class="badge badge-default">
                        <i class="fa fa-bullhorn"></i> INFO </b>
                </h6>
                <font>
                    <i class="fas fa-angle-double-right"></i>
                    </i>
                    <b> PENTING!</b>
                    <br>
                    <ul>
                        <li>Setelah order Anda akan di minta untuk follow akun kami (cek riwayat pesanan)</li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#exampleModal-2"><p>Ketentuan dan Pesyaratan Gift Skin/Item (<b>Klik Disini</b>)</p>
                            </a>
                        </li>
                    </ul>
                </font>
            </div>
        </div>
    </div>
</div>
<? } ?>
<? if(in_array($operator, ['Mobile Legends Vilog'])) { ?>
<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-small">
                    <b style="font-weight:800" class="badge badge-default">
                        <i class="fa fa-bullhorn"></i> INFO </b>
                </h6>
                <i class="fas fa-angle-double-right"></i>
                <b>Jaminan Pembayaran 100% Legal (tidak main ilegal seperti Refunds Payment.dll)</b>
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <b>Selain bertanda [FAST] kami wajib memainkan sekitar 2-5 Match Classic (hero non WR)</b>
                <a href="#" data-toggle="modal" data-target="#exampleModal-3">
                    <b>Benefit Crystal of Aurora</b>
                </a>
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <b>Pesanan di proses sesuai antrian dan pesanan tidak dapat di Cancel / Batalkan!</b>
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <a href="#" data-toggle="modal" data-target="#exampleModal-5"> Ketentuan Via Login</a>
                <hr>
                <i class="fas fa-angle-double-right"></i><a href="#" data-toggle="modal" data-target="#exampleModal-10"> Pertanyaan Umum</a>
                </b>

            </div>
        </div>
    </div>
</div>
<? } ?>

<? if(in_array($operator, ['Canva Pro'])) { ?>
<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-small">
                    <b style="font-weight:800" class="badge badge-default">
                        <i class="fa fa-bullhorn"></i> INFO </b>
                </h6>
                <i class="fas fa-angle-double-right"></i> Masukan alamat email canva kamu, kami akan lakukan invite untuk berlangganan menjadi Pro
                <hr>
                <i class="fas fa-angle-double-right"></i> Estimasi proses 5-10 menit
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <a href="#" data-toggle="modal" data-target="#exampleModal-9"> Solusi Tidak Dapat Bergabung ke Pro (klik)</a>
                </b>
            </div>
        </div>
    </div>
</div> 
<? } ?>

<? if(in_array($operator, ['Apple Gift Card'])) { ?>
<div class="row">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-small">
                    <b style="font-weight:800" class="badge badge-default">
                        <i class="fa fa-bullhorn"></i> INFO </b>
                </h6>
                <i class="fas fa-angle-double-right"></i> Kode Voucher cek detail <a href="https://enternity.id/order/history/game-feature">Riwayat Pesanan</a>
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <a href="#" data-toggle="modal" data-target="#exampleModal-11"> TUTORIAL REDEEM MUSIC & TV</a>
                <hr>
                <i class="fas fa-angle-double-right"></i>
                <a href="#" data-toggle="modal" data-target="#exampleModal-12"> TUTORIAL REDEEM ICLOUD+</a>
                </b>
            </div>
        </div>
    </div>
</div> 
<? } ?>


<!--================== Modal ==================-->
<div class="modal fade" id="exampleModal-11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-11" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-7"><b>TUTORIAL</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>REDEEM MUSIC & TV</h5>
        <span>
        1. Buka App Apple Music (berlaku untuk TV).<br>
        2. Ketuk Tombol Menu.<br>
        3. Lalu Ketuk Akun.<br>
        4. Ketuk Tukarkan Kartu atau Kode Hadiah.<br>
        5. Masukkan kode 16 digit.<br>
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal-12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-12" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-7"><b>TUTORIAL</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h5>REDEEM ICLOUD+</h5>
        <span>
        - Sebelum Redeem<br>
        1. Buka setting<br>
        2. Masuk ke profile icloud (logo profile)<br>
        3. Pilih "Payment & Shipping"<br>
        4. Kalau masih kosong, tambahkan "Payment Methods" bisa pilih gopay / dana / visa. Pilih satu bebas<br>
        5. Selesai, silahkan ikuti step redeem<br>
        <br>
        - Cara Redeem<br>
        1. Buka Appstore<br>
        2. Klik kanan atas, gambar profile apple<br>
        3. Pilih "Redeem Gift Card or Code"<br>
        4. Masukan kode diatas, klik redeem selesai.<br>
        <br>
        Setelah premium jangan lupa cancel subcriptionnya ya, PENTING! kalau ngga cancel nanti setelah 4 bulan apple bakal motong saldo kalian<br>
        <br>
        - Cara Cancel Subcription<br>
        1. Buka setting<br>
        2. Masuk ke profile icloud (logo profile)<br>
        3. Pilih "iCloud"<br>
        4. Pilih "Manage Storage"<br>
        5. Pilih "Change Storage Plan"<br>
        6. Pilih "Downgrade Options"<br>
        7. Pilih yang "Free" lalu ok<br>
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal-9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-9" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel-7"><b>SOLUSI BUG CANVA PRO</b></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<li>Hapus dahulu aplikasi canva nya</li>
<li>Terima undangan canva pro cek di email</li>
<li>Selanjutnya akan di arahkan ke browser dan otomatis gabung ke PRO</li>
<li>Selesai cek ke Menu -> Jika terdapat Tim maka sudah menjadi PRO</li>
<li>Terakhir instal kembali aplikasi canva nya</li>
<hr>
<small>FYI : Aplikasi Canva mengalami BUG di beberapa pengguna saat bergabung ke PRO tidak berhasil, solusinya lakukan cara di atas 100% berhasil</small>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
</div>
</div>
</div>
</div>

<div class="modal fade" id="exampleModal-10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-10" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel-10"><b>Pertanyaan Umum</b></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
Q : <b>Apakah produk terjamin legal?</b><br>
A : Tentu saja pembayaran 100% legal (tidak main refund pembayaran).<hr>
Q : <b>Apakah proses terjamin aman?</b><br>
A : Tentu saja akun 100% akan aman oleh tim proses internal kami.<hr>
Q : <b>Apakah mendapatkan invoice pembelian?</b><br>
A : Kami akan memberikan di riwayat pesanan Anda.<hr>
Q : <b>Berapa lama proses pesanan?</b><br>
A : Anda dapat lihat Informasi Server pada menu ini.<hr>
Q : <b>Platform apa saja untuk proses pesanan?</b><br>
A : Proses melalui login Moonton, VK, atau Tiktok (nonaktifkan verifikasi).<hr>
Q : <b>Apakah membutuhkan kode verifikasi?</b><br>
A : Tidak, pastikan Anda sudah mematikan verifikasi 2 langkah.<hr>
Q : <b>Jika akun perlu dimainkan apakah dijamin menang?</b><br>
A : Tidak menjamin, namun akan kami usahakan sebisa kami.<hr>
Q : <b>Kenapa antrian pesanan saya melebihi waktu estimasi?</b><br>
A : Lamanya pesanan karena padatnya antrian, harap perhatikan batas waktu Maximal.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
</div>
</div>
</div>
</div>



<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel-2"><b>Ketentuan Gift Skin/Item</b></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<li>Setiap melakukan pemesanan pastikan memasukan <b>User ID + Zone ID</b> serta <b>Nama Skin/Item</b> dengan benar.</li>

<li>Setelah order, Anda akan di minta untuk melakukan Follow akun yang akan mengirim Skin/Item.</li>
<li>Detail pesanan cek melalui Riwayat Pesanan setelah 5-10 menit pesanan dibuat.</li>
<li>Pengiriman Skin/Item <b>Delay 7-8 hari</b> harus berteman dulu dgn akun kami <i>(ketentuan dari moonton)</i>.</li>
<li>Setelah sudah berteman <b>7-8 hari</b> dengan Akun kami, maka untuk pengiriman skin berikutnya tidak <b>Delay</b>.</li>
<li>ID Game pengirim skin akan di kirim melalui Riwayat Pesanan ketika kamu sudah order.</li>
<li>Untuk yang diskon 30% pastikan ketika ada update skin-skin baru, kalian sudah open pre order sebelum 7 hari masa promo skin tersebut berakhir.</li>
<li>Berikut nama Item yang pengiriman nya tidak delay: <br><b>- Create Squad | - Paradise Island | - Angel Ark</b></li>
<br>
<i><p><b>Catatan</b>: Setelah membuat pesanan tidak ada refund (pengembalian dana) ketika anda Unfollow atau mengubah Nickname atau ada kesalahan nama Skin/Item/ID Game.<hr>Bagi yang sudah pernah order dan sudah berteman dengan akun kami maka pengiriman skin No Delay (jika ID Gift kami sama)</p></i>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
</div>
</div>
</div>
</div>

<div class="modal fade" id="exampleModal-5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-5">
                    <b>[ KETENTUAN VIA LOGIN ]</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <li>Saat pesanan telah sukses, pastikan Anda melakukan logout all device dan mengubah password secara langsung.</li>
                <hr>
                <li>Setelah pesanan sukses, kami tidak menyimpan data pesanan yang bersifat privasi (password ataupun kode).</li>
                <hr>
                <li>Kepada reseller, di wajibkan untuk tidak menyimpan data privasi customer berupa (password ataupun kode) dan memberikan informasi untuk mengubah data secara langsung.</li>
                <hr>
                <li>Kami menjamin keamanan akun di proses oleh tim yang profesional internal kami.</li>
                <hr>
                <li>Kami tidak bertanggung jawab apabila ada kasus Hacking Account.</li>
                <hr>
                <small>Ketentuan ini mutlak tidak diganggu gugat (tidak menerima adanya kasus drama hacking account dan sebagainya) karena kami menjamin akun akan aman 100% oleh pihak kami.</small>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    
<div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-3">
                    <b>[ BENEFIT CRYSTAL OF AURORA ]</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <li>Claim pertama 50 + 35 COA</li>
                <li>Claim 35 COA setiap hari</li>
                <li>Total 1100 COA/Bulan</li>
                <li>Harga Murah & Hemat</li>
                <li>Jaminan legal 100%</li>
                <li>Diproses oleh tim Internal <b>Enternity Store</b></li>
                <li>Dapat di perpanjang setiap Bulan</li>
                <li>Dapat digunakan untuk spin Skin Collector, Legend, Zodiac</li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<? require _DIR_('library/layout/footer.user'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $("#actionbutton").click(function() {
        $("#actionbutton").hide();
        $("#timerdiv").show(); 
        var timer = 10;     
        function counting(){
            var rto = setTimeout(counting,1000);
            $('#timerdiv').html( '<button type="button" class="btn btn-danger btn-block" disabled> <i class="fas fa-spinner fa-spin"></i>&nbsp;Processing </button>' );
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
     
    $('input[name="target"],input[name="target2"],select[name="target2"]').change(function(){
        var safalian = ['Apex Legends Mobile','Canva Pro','Disney Hotstar','Dragon Raja','Garena Shell Murah','UC PUBGM','Genshin Impact','Dragon Raja','PlayStation Network (PSN)','Garena Shell Murah','League of Legends','Light of Thel','Lords Mobile'];
        var shennZone = ['Free Fire','Netflix Premium','Mobile Legends','Mobile Legends Joki Rank','Mobile Legends Vilog','Mobile Legends A','Mobile Legends B','Mobile Legends Membership','LifeAfter','Marvel Super War','Ragnarok M Eternal Love'];
        var unzone = ['WeTV Premium'];
        var target = $("#target").val();
        var target2 = $("#target2").val();
        var operator = '<?= $operator ?>';
        
        if(safalian.includes(operator) == false) {
            if(shennZone.includes(operator) == true && target != '' && target2 != '') {
                var postdata = 'category=' + operator + '&target=' + target + '&target2=' + target2;
                validasi(postdata);
            } else if(shennZone.includes(operator) == false && target != '') {
                var postdata = 'category=' + operator + '&target=' + target;
                validasi(postdata);
            }
        }
    });

    function validasi(postdata){
        $.ajax({
            url: '<?= base_url('order/ajax/check') ?>',
            data: postdata,
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function() {
                Swal.fire({title:"Please waiting..",showConfirmButton:false,allowOutsideClick:false});
                Swal.showLoading()
            },
            success: function(shenn) {
                if(shenn.result == false){
                    Swal.fire('Ups','Data Invalid!' + shenn.message,'error');
                    document.getElementById("myForm").reset();
                }else{
                    Swal.fire('Successfully',"Data Berhasil Ditemukan!",'success');
                    Swal.hideLoading()
                    document.getElementById("displayname").value = decodeURI(shenn.data);
                }
    		}
    	});
    };
	
    $('input[name="server"]').change(function() {
        var server = $('input[name=server]:checked', '#myForm').val();
        var target = $("#target").val();
        
        if(!target) {
            Swal.fire('Ups...','Silahkan masukkan data terlebih dahulu.','error');
            document.getElementById("myForm").reset();
            server = 0;
        }
        
        $.ajax({
            url: '<?=base_url('order/ajax/service')?>',
            data: 'category=<?= $operator ?>&server=' + server,
            type: 'POST',
            dataType: 'html',
            beforeSend: function() {
                $("#service").html("<br><div class=\"col-12\"><center>Please wait..<center></div>");
            },
            success: function(msg) {
                $("#service").html(msg);
                $('#actionbutton').prop('disabled',false);
                reset();
            }
        });
    });

    $('input[name="jumlah"]').keyup(function() {
        var server =$('input[name=server]:checked', '#myForm').val();
        var jumlah = $("#jumlah").val();
        var layanan =  $('input[name=layanan]:checked', '#myForm').val();

        if(!server){
            Swal.fire('Ups...','Silahkan pilih layanan terlebih dahulu.','error');
            reset();
        }
        
        $.ajax({
            url: '<?=base_url('order/ajax/price')?>',
            data: 'server=' + server + '&jumlah=' + jumlah + '&layanan=' + layanan + '&category=<?= $operator ?>',
            type: 'POST',
            dataType: 'html',
            beforeSend: function() {
                $("#harga").val("Checking..");
                $('#actionbutton').prop('disabled',false);
            },
            success: function(msg) {
                $("#harga").val(msg);

            }
    	});
    });
});

function reset() {
    document.getElementById("jumlah").value = '';
    document.getElementById("harga").value = '';
    $('#card-note').addClass('d-none');
    $('#note').html('');
}
// Get all elements with class="close"
var closebtns = document.getElementsByClassName("close");
var i;

// Loop through the elements, and hide the parent, when clicked on
for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function() {
    this.parentElement.style.display = 'none';
  });
}
</script>