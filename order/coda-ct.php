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
        if($cat == 'Dragon Raja') $img = 'https://enternity.id/new-icon/dragon.jpg';
        if($cat == 'Chess Rush') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/chessrush_tile.jpg';
        if($cat == 'Free Fire') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/freefire_tile.jpg';
        if($cat == 'Free Fire Promo') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/freefire_tile.jpg';
        if($cat == 'Free Fire Vilog') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/freefire_tile.jpg';
        if($cat == 'HAGO') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/hago_tile.jpg';
        if($cat == 'Legends of Runeterra') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lor_tile.jpg';
        if($cat == 'League of Legends Wild Rift') $img = 'https://enternity.id/new-icon/wildrift.jpg';
        if($cat == 'LifeAfter') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lifeafter_tile.jpeg';
        if($cat == 'Mobile Legends Slow') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/mlbb_tile.jpg';
        if(substr($cat,0,5) == 'PUBGM') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_rps_tile.jpg';
        if($cat == 'UC PUBGM') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_rps_tile.jpg';
        if($cat == 'PB Zepetto') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg';
        if($cat == 'Ragnarok M Eternal Love') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/ragnarok_tile.jpg';
        if($cat == 'Speed Drifters') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/speed_drifter_tile.jpg';
        if($cat == 'Valorant') $img = 'https://enternity.id/new-icon/valorant.jpg';
        if($cat == 'Voucher Valorant') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/valorant_tile.jpg';
        if($cat == 'World of Dragon Nest') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/The_World_Of_Dragon_Nest.jpg';
        if($cat == 'Light of Thel') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/LightofThel_tile.png';
        if($cat == 'Lords Mobile') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lords_mobile_tile.png';
        if($cat == 'Higgs Domino') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/higgs_domino_tile.jpg';
        if($cat == 'League of Legends') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/lolwildrift_tile.png';
        if($cat == 'League of Legends Wild Rift') $img = 'https://enternity.id/new-icon/wildrift.jpg';
        if($cat == 'Omega Legends') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/omegalegends_tile.png';
        if($cat == 'One Punch Man') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/onepunchman_tile.png';
        if($cat == 'RagnaroK X Next Generation') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/ragnarok_x_tile.jpg';
        if($cat == 'Ragnarok X Razer Link') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/ragnarok_x_tile.jpg';
        if($cat == 'PO Garena Shell') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg';
        if($cat == 'Garena Shell Promo') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg';
        if($cat == 'Voucher PointBlank') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/PointBlank_ID_tile.jpg';
        if($cat == 'Genshin Impact') $img = 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/genshin_tile.png';
        if($cat == 'Mobile Legends Gift') $img = 'https://enternity.id/new-icon/mlbb-new.png';
        if($cat == 'Mobile Legends Promo') $img = 'https://enternity.id/new-icon/ml-promo-icon.jpg';
        if($cat == 'Apex Legends Mobile') $img = 'https://enternity.id/new-icon/natal/icon-apex-legends.jpg';
        if($cat == 'Canva Pro') $img = 'https://th-live-05.slatic.net/p/eb6e9b42a3ee41f31451c7bc6d29e86e.jpg_720x720q80.jpg_.png';
        if($cat == 'Disney Hotstar') $img = 'https://enternity.id/new-icon/natal/disney-hotstar-icon.jpg';
        if($cat == 'Free Fire Max') $img = 'https://enternity.id/new-icon/natal/free-fire-new.jpg';
        if($cat == 'iQIYI Premium') $img = 'https://static-s.aa-cdn.net/img/gp/20600011895764/qcnLIY2j3sD631py3vbhbe4KAoUfoNGIiag52awMmiBB1qpJtqCxOIcYPgARW_bfQ58=s300?v=1';
        if($cat == 'Marvel Super War') $img = 'https://enternity.id/new-icon/natal/marvel-super-war-icon.png';
        if($cat == 'Mobile Legends') $img = 'https://enternity.id/new-icon/natal/mlbb.jpg';
        if($cat == 'Mobile Legends A') $img = 'https://enternity.id/new-icon/natal/Menu_MLBB_A.jpg';
        if($cat == 'Mobile Legends B') $img = 'https://enternity.id/new-icon/natal/Menu_MLBB_B.jpg';
        if($cat == 'Mobile Legends Global') $img = 'https://enternity.id/new-icon/ml.jpg';
        if($cat == 'Mobile Legends Vilog') $img = 'https://enternity.id/new-icon/natal/ml-vilog-iconn.jpg';
        if($cat == 'Youtube Premium') $img = 'https://enternity.id/new-icon/natal/youtube-new.jpg';
        if($cat == 'WeTV Premium') $img = 'https://cf.shopee.co.id/file/bcc57869475b868a686844e4fb82e4ee';
        if($cat == 'Vidio Premier') $img = 'https://enternity.id/new-icon/natal/vidio-premier.jpg';
        if($cat == 'Super Sus') $img = 'https://enternity.id/new-icon/natal/super-sus-icon.png';
        if($cat == 'Tom and Jerry Chase') $img = 'https://enternity.id/new-icon/natal/tom-and-jerry-chase.jpg';
        if($cat == 'Steam Wallet Code') $img = 'https://enternity.id/new-icon/1642190011_tile.jpg';
        if($cat == 'Spotify Premium') $img = 'https://enternity.id/new-icon/natal/spotify.jpg';
        if($cat == 'Sausage Man') $img = 'https://enternity.id/new-icon/natal/sausage-man-new.jpg';
        if($cat == 'PUBG GLOBAL') $img = 'https://enternity.id/new-icon/natal/pubgm-g-icon.jpg';
        if($cat == 'PUBGM MOBILE') $img = 'https://enternity.id/new-icon/pubgm.jpg';
        if($cat == 'PUBGM INDO A') $img = 'https://enternity.id/new-icon/natal/pubgm-a-icon.jpg';
        if($cat == 'PUBGM INDO B') $img = 'https://enternity.id/new-icon/natal/pubgm-b-icon.jpg';
        if($cat == 'PUBGM New State') $img = 'https://enternity.id/new-icon/natal/pubgm-new-state.jpg';
        if($cat == 'Mobile Legends Membership') $img = 'https://enternity.id/new-icon/natal/starlight-new.jpg';
        if($cat == 'Netflix Premium') $img = 'https://enternity.id/new-icon/natal/netflix.jpg';
        if($cat == 'Voucher Megaxus') $img = 'https://enternity.id/new-icon/1642189426.png';
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
    .category-container{max-width:760px;margin:2px auto 0}.category__product-row{display:block;max-width:100%;padding:0 5px 15px}.category__title{font-family:Lato-Bold,sans-serif;padding-left:10px;padding-bottom:10px;color:#636363font-size:12px;}*{box-sizing:border-box}@media only screen and (min-width:768px){.category__product-container{width:20%;padding:12px;}}@media only screen and (max-width:768px){.category__product-container{width:25%;padding:12px;width:33.333333%}}.category__product-container{display:inline-block;text-align:center;text-decoration:none;cursor:pointer;padding:5px;vertical-align:top}.category__product-image{display:block;border-radius:10px;margin:auto;max-width:100%}.category__product-title{color:#000;padding-top:7px;max-width:128px;margin:auto}
</style>
<style>
.cg-4 {
        min-height: 203px;
    }

    .cg-4-title {
        font-family: Poppins, arial;
        padding: 2px;
        font-size: 12px;
        color:#000;
    }
    
.box {
  position: relative;
}
.ribbon {
  position: absolute;
  right: -1px; top: -1px;
  z-index: 1;
  overflow: hidden;
  width: 75px; height: 75px;
  text-align: right;
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #fff;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  width: 100px;
  display: block;
  background: linear-gradient(#6900ff 0%, #7b37ff 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; right: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #8e17ff;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #8e17ff;
  border-bottom: 3px solid transparent;
}

section h2 {
	color: #ffffff;
	font-size: 8rem;
	text-align: center;
	text-transform: uppercase;
}

section .set {
	height: 100%;
	left: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	width: 100%;
}

section .set.set2 {
	filter: blur(2px);
	transform: rotateY(180deg) scale(1.5);
}

section .set.set3 {
	filter: blur(4px);
	transform: rotateY(180deg) scale(0.8);
}

section .set div {
	animation-name: animate;
	animation-timing-function: linear;
	animation-iteration-count: infinite;
	display: block;
	opacity: 0;
	position: absolute;
	top: -10%;
	transform: rotateZ(0) translateX(20px);
}

section .set div:nth-child(1) {
	animation-delay: 20s;
	animation-duration: 15s;
	left: 20%;
}

section .set div:nth-child(2) {
	animation-delay: 20s;
	animation-duration: 20s;
	left: 50%;
}

section .set div:nth-child(3) {
	animation-duration: 30s;
	left: 70%;
}

section .set div:nth-child(4) {
	animation-delay: 20s;
	animation-duration: 15s;
	left: 0;
}

section .set div:nth-child(5) {
	animation-delay: 20s;
	animation-duration: 18s;
	left: 85%;
}

section .set div:nth-child(6) {
	animation-duration: 12s;
	left: 0;
}

section .set div:nth-child(7) {
	animation-duration: 14s;
	left: 15%;
}

section .set div:nth-child(8) {
	animation-duration: 15s;
	left: 60%;
}

@keyframes animate {	
	10% {
		opacity: 1;
	}
	
	20% {
		transform: rotateZ(45deg) translateX(-20px);
	}
	
	40% {
		transform: rotateZ(90deg) translateX(-20px);
	}
	
	60% {
		transform: rotateZ(180deg) translateX(20px);
	}
	
	80% {
		transform: rotateZ(180deg) translateX(-20px);
	}
	
	100% {
		top: 110%;
		transform: rotateZ(225deg) translateX(-20px);
	}
}

@media screen and (max-width: 990px) {
	section h2 {
		font-size: 9rem;
	}
}

@media screen and (max-width: 768px) {
	section h2 {
		font-size: 6rem;
	}
	
	section .set div img {
		width: 28px;
		heigth: 28px;
	}
}

@media screen and (max-width: 550px) {
	section h2 {
		font-size: 4rem;
	}
	
	section .set div img {
		width: 28px;
		heigth: 28px;
	}
}
.clip-path {
        display: flex;
        padding: 0;
        margin-top: -32px;
        width: 100%;
        height: 35px;
        background-color: #fff;
        clip-path: polygon(0 90%, 7% 60%, 16% 90%, 23% 70%, 33% 90%, 38% 88%, 43% 80%, 45% 50%, 51% 50%, 57% 70%, 67% 70%, 77% 50%, 86% 90%, 89% 90%, 93% 50%, 97% 50%, 100% calc(100% + 1px), 0 calc(100% + 1px));
        -webkit-clip-path: polygon(0 90%, 7% 60%, 16% 90%, 23% 70%, 33% 90%, 38% 88%, 43% 80%, 45% 50%, 51% 50%, 57% 70%, 67% 70%, 77% 50%, 86% 90%, 89% 90%, 93% 50%, 97% 50%, 100% calc(100% + 1px), 0 calc(100% + 1px));
    }
    @media only screen and (max-width: 600px) {
        body {
            overflow-x: hidden;
            padding: 2px;
            margin: 4px;
        }

        .cg-4 {
            min-height: 165px;
        }

        .cg-4-title {
            padding: 2px;
            font-size: 11px;
            color:#000;
            font-family: Poppins, Arial;
        }

        .daftar-games {
            width: 30%;
            margin: 4px;
        }

        .title-game {
            font-size: 10.5px;
        }

        .row-slide {
            margin: -35px -31px 0 -31px;
        }

        .carousel-inner {
            border-radius: 0;
        }
    }
</style>
<!--<script src="https://cdn.rawgit.com/bungfrangki/efeksalju/2a7805c7/efek-salju-2.js" type="text/javascript"></script> -->
<script src="https://cdn.rawgit.com/bungfrangki/efeksalju/2a7805c7/efek-salju.js" type="text/javascript"></script>
<!--<script src="https://enternity.id/class/js/daun-berguguran.js" type="text/javascript"></script>-->

<section>

	<div class="set">
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
	</div>
	
	<div class="set set2">
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/christmas-ornament.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow-2.png" alt="Leaf" title="Leaf">
		</div>
	</div>
	
	<div class="set set3">
		<div>
			<img src="https://enternity.id/img/icon/snow-2.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/candy-cane.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/candy-cane.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="hhttps://enternity.id/img/icon/candy-cane.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
		
		<div>
			<img src="https://enternity.id/img/icon/snow.png" alt="Leaf" title="Leaf">
		</div>
	</div>
</section>

<!-- Nav pills -->

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

    <div class="images">
      <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/hyper-front'" class="box category__product-container js-link-click" data-name="hyper">
            <div class="ribbon"><span>PROMO 10%</span></div>
            <img data-src="https://enternity.id/new-icon/natal/hyper-front.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/hyper-front.png" data-loaded="true"><div class="clip-path"></div>
            <small class="cg-4-title text-sm">Hyper Front</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/mobile-legends-joki-rank'" class=" category__product-container js-link-click" data-name="mobile">
            <img data-src="https://enternity.id/new-icon/natal/mlbb-joki-rank.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/mlbb-joki-rank.png" data-loaded="true"><div class="clip-path"></div>
            <small class="cg-4-title text-sm">Joki Rank</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/tower-of-fantasy'" class=" category__product-container js-link-click" data-name="tower">
            <img data-src="https://enternity.id/new-icon/natal/tower-of-fantasy-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/tower-of-fantasy-icon.png" data-loaded="true"><div class="clip-path"></div>
            <small class="cg-4-title text-sm">Tower of Fantasy</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/lita'" class=" category__product-container js-link-click">
            <img data-src="https://enternity.id/new-icon/natal/game/lita-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/lita-icon.png" data-loaded="true"><div class="clip-path"></div>
            <small class="cg-4-title text-sm">LITA</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/apex-legends-mobile'" class=" category__product-container js-link-click">
            <div class="ribbon"><span>PROMO 20%</span></div><img data-src="https://enternity.id/new-icon/natal/icon-apex-legends.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/icon-apex-legends.png" data-loaded="true"><div class="clip-path"></div>
            <small class="cg-4-title text-sm">Apex Legends Mobile</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/honkai-impact-3'" class=" category__product-container js-link-click">
                <img data-src="https://enternity.id/new-icon/natal/honkai-impact-3.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/honkai-impact-3.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Honkai Impact 3</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/marvel-super-war'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/marvel-super-war-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/marvel-super-war-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Marvel Super War</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/super-sus'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/super-sus-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/super-sus-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Super Sus</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/valorant'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/valorant-new.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/valorant-new.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Valorant</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/arena-of-valor'" class=" category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/aov_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/aov_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Arena Of Valor</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/efootball-2023-vilog'" class="dard category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/9undLj4YJQinRpd1u50Dv33H.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/9undLj4YJQinRpd1u50Dv33H.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">eFootball 2023 Vilog</small></a>
                
        </div>
    </div>
</div>
</div>
 <hr />
 <br />
     <h4><b class="badge badge-light-info">Game - Populer</b></h4>
    </center>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/dragon-raja'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/dragon-raja.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/dragon-raja.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Dragon Raja</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/free-fire'" class="box category__product-container js-link-click"><div class="ribbon"><span>PROMO 10%</span></div><img data-src="https://enternity.id/new-icon/natal/free-fire.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/free-fire.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Free Firee</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/free-fire-max'" class="box category__product-container js-link-click"><div class="ribbon"><span>PROMO 10%</span></div><img data-src="https://enternity.id/new-icon/natal/ff.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/ff.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Free Fire Max</small></a><!--<a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/free-fire-promo'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/free-firee-promo.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/free-firee-promo.png" data-loaded="true"><div class="category__product-title">Free Fire Promo</div></a>--><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/genshin-impact'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/genshin_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/genshin_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Genshin Impact</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/league-of-legends'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/lolwildrift_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/lolwildrift_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">League of Legends</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/lifeafter'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/lifeafter_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/lifeafter_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">LifeAfter</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/light-of-thel'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/LightofThel_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/LightofThel_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Light of Thel</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/lords-mobile'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/lords_mobile_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/lords_mobile_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Lords Mobile</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/omega-legends'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/omegalegends_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/omegalegends_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Omega Legends</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/one-punch-man'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/one-punch-man.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/one-punch-man.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">One Punch Man</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/pubgm-global'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/pubgm-g-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/pubgm-g-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">PUBGM GLOBAL</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/pubgm-indo-a'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/pubgm-a-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/pubgm-a-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">PUBGM INDO A</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/pubgm-indo-b'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/pubgm-b-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/pubgm-b-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">PUBGM INDO B</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/ragnarok-m-eternal-love'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/ragnarok_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/ragnarok_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Ragnarok M Eternal Love</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/ragnarok-x-next-generation'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/ragnarox-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/ragnarox-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Ragnarok X Next Generation</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/sausage-man'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/sausage-man-new.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/sausage-man-new.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Sausage Man</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/tom-and-jerry-chase'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/tom-and-jerry-chase.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/tom-and-jerry-chase.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Tom and Jerry Chase</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/zepetto'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/zepeto_tile.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/zepeto_tile.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Zepeto</small></a>    </div>
</div>
<hr />
<br />
    <h4><b class="badge badge-light-info">Mobile Legends</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/mobile-legends-vilog'" class="category__product-container js-link-click" data-name="mobile"><img data-src="https://enternity.id/new-icon/natal/ml-vilog-iconn.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/ml-vilog-iconn.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Mobile Legends Vilog</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/mobile-legends-gift'" class="category__product-container js-link-click" data-name="mobile"><img data-src="https://enternity.id/new-icon/natal/mlbb-new.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/mlbb-new.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Mobile Legends Gift</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/mobile-legends-a'" class="box category__product-container js-link-click" data-name="mobile"><div class="ribbon"><span>PROMO 50%</span></div><img data-src="https://enternity.id/new-icon/natal/mobile-legends-a.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/mobile-legends-a.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Mobile Legends A</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/mobile-legends-b'" class="box category__product-container js-link-click" data-name="mobile"><div class="ribbon"><span>PROMO 50%</span></div><img data-src="https://enternity.id/new-icon/natal/mobile-legends-b.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/mobile-legends-b.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Mobile Legends B</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/mobile-legends-membership'" class="category__product-container js-link-click" data-name="mobile"><img data-src="https://enternity.id/new-icon/natal/starlight-new.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/starlight-new.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Mobile Legends Starlight</small></a>    </div>
  </div>

<br />

</div>
    <!-- Tab panes -->
    <div id="menu2" class="container tab-pane fade"><br>

    <h4><b class="badge badge-light-info">Produk - Lainnya</b></h4>
<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        <a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/telegram-premium'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/icon-telegram-prem.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/icon-telegram-prem.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Telegram Premium</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/apple-gift-card'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/apple-gift-card.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/apple-gift-card.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Apple Gift Card</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/canva-pro'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/eb6e9b42a3ee41f31451c7bc6d29e86e.jpg_720x720q80.jpg_.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/eb6e9b42a3ee41f31451c7bc6d29e86e.jpg_720x720q80.jpg_.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Canva Pro</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/disney-hotstar'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/disney-hotstar-icon.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/disney-hotstar-icon.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Disney Hotstar</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/iqiyi-premium'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/qcnLIY2j3sD631py3vbhbe4KAoUfoNGIiag52awMmiBB1qpJtqCxOIcYPgARW_bfQ58=s300.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/qcnLIY2j3sD631py3vbhbe4KAoUfoNGIiag52awMmiBB1qpJtqCxOIcYPgARW_bfQ58=s300.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">iQIYI Premium</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/netflix-premium'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/netflix.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/netflix.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Netflix Premium</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/spotify-premium'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/spotify.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/spotify.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Spotify Premium</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/vidio-premier'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/vidio-premier.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/vidio-premier.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Vidio Premier</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/wetv-premium'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/bcc57869475b868a686844e4fb82e4ee.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/bcc57869475b868a686844e4fb82e4ee.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">WeTV Premium</small></a><a href="javascript:;" onclick="javascript:location.href='https://enternity.id/order/game/youtube-premium'" class="category__product-container js-link-click"><img data-src="https://enternity.id/new-icon/natal/youtube-new.png" alt="" class="category__product-image lozad" src="https://enternity.id/new-icon/natal/youtube-new.png" data-loaded="true"><div class="clip-path"></div><small class="cg-4-title text-sm">Youtube Premium</small></a>    </div>
  </div>

</div></div></div></div>

 
<!--<div class="category-container">
    <div class="category__product-row">
        <div class="category__title"></div>
        //<?php
        //$search = $call->query("SELECT * FROM category WHERE `order` = 'game' ORDER BY name ASC");
        //while($row = $search->fetch_assoc()) { $x[] = $row['name']; }
        //if(isset($x)) if(is_array($x)) print gameMenu($x);
        //?>
    </div>
</div> -->

<script>
const search = document.querySelector(".search-form input"),
      images = document.querySelectorAll(".category__product-container");

search.addEventListener("keyup", e =>{
    if(e.key == "Enter"){
        let searcValue = search.value,
            value = searcValue.toLowerCase();
            images.forEach(image =>{
                if(value === image.dataset.name){ //matching value with getting attribute of images
                    return image.style.display = "block";
                }
                image.style.display = "none";
            });
    }
});

search.addEventListener("keyup", () =>{
    if(search.value != "") return;

    images.forEach(image =>{
        image.style.display = "";
    })
})
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<? require _DIR_('library/layout/footer.user'); ?>