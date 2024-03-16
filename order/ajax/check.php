<?php 
require '../../connect.php';
require _DIR_('library/session/session');
require 'gnc.php';



function err($x,$y) {
    if($x == true) {
        return json_encode(['status' => true,'data' => $y]);
    } else {
        return json_encode(['status' => false,'message' => $y]);
    }
}

$prov = $call->query("SELECT * FROM provider WHERE code = 'VIP'")->fetch_assoc();

$md5_VIP = md5($prov['userid'].$prov['apikey']);
$apikey = $prov['apikey'];

//$GameNC = new GameNickChecker('Xe98Dff6','ZAadFDXufJo149q9BtujwVpB85ehcUswbozKkspOwSWOQWKOwXkjlDGiYoKOjWs4');
$GameNC = new GameNickChecker($apikey,$md5_VIP);
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_POST['target']) || !isset($_POST['category'])) exit(err(false,'No direct script access allowed!'));
    
    $c = isset($_POST['category']) ? filter($_POST['category']) : '';
    $id = isset($_POST['target']) ? filter($_POST['target']) : '';
    $id2 = isset($_POST['target2']) ? filter($_POST['target2']) : '';
    
    if($c == "PUBGM INDO A") $result = $GameNC->PubgMobile($id);
    else if($c == "PUBGM INDO B") $result = $GameNC->PubgMobile($id);
    else if($c == "PUBGM GLOBAL") $result = $GameNC->PubgMobile($id);
    else if($c == "Bigo Live") $result = $GameNC->BigoLive($id);
    else if($c == "8Ball") $result = $GameNC->eightBall($id);
    else if($c == "Super Sus") $result = $GameNC->SuperSus($id);
    else if($c == "Sausage Man") $result = $GameNC->SausageMan($id);
    else if($c == "Dragon Raja") $result = $GameNC->DragonRaja($id);
    else if($c == "HAGO") $result = $GameNC->Hago($id);
    else if($c == "Point Blank") $result = $GameNC->PointBlank($id);
    else if($c == "League of Legends") $result = $GameNC->LeagueofLegends($id);
    #else if($c == "Laplace M") $result = $GameNC->LaplaceM($id);
    #else if($c == "Genshin Impact") $result = $GameNC->Genshin($id,$id2);
    else if($c == "Zepeto") $result = $GameNC->Zepeto($id);
    else if($c == "Valorant") $result = $GameNC->Valorant($id);
    else if($c == "Apex Legends Mobile") $result = $GameNC->ApexLegends($id);
    else if($c == "Tom and Jerry Chase") $result = $GameNC->TomJerryChase($id);
    else if($c == "Lords Mobile") $result = $GameNC->LordsMobile($id);
    else if($c == "Mobile Legends") $result = $GameNC->MobileLegends($id,$id2);
    else if($c == "Mobile Legends A") $result = $GameNC->MobileLegends($id,$id2);
    else if($c == "Mobile Legends B") $result = $GameNC->MobileLegends($id,$id2);
    else if($c == "Mobile Legends Membership") $result = $GameNC->MobileLegends($id,$id2);
    else if($c == "Mobile Legends Vilog") $result = $GameNC->MobileLegends($id,$id2);
    else if($c == "Mobile Legends Gift") $result = $GameNC->MobileLegends($id,$id2);
    else if($c == "Free Fire") $result = $GameNC->FreeFire($id);
    else if($c == "Free Fire Max") $result = $GameNC->FreeFire($id);
    else if($c == "Lost Saga") $result = $GameNC->LostSaga($id);
    else if($c == "Marvel Super War") $result = $GameNC->MarvelSuperWar($id);
    else if($c == "Arena of Valor") $result = $GameNC->ArenaofValor($id);
    else if($c == "Call of Duty Mobile") $result = $GameNC->CallofDutyMobile($id);
    else if($c == "Higgs Domino") $result = $GameNC->HiggsDomino($id);
    else if($c == "LifeAfter") $result = $GameNC->LifeAfter($id,$id2);
    else if($c == "Speed Drifters") $result = $GameNC->SpeedDrifters($id);
    else if($c == "Ragnarok M Eternal Love") $result = $GameNC->RagnarokEternalLove($id);
    else exit(err(false,'The game is not registered, please contact the developer!'));
    
    if(isset($result['result'])) {
        if($result['result']  == true) {
            if(isset($result['data'])) {
                exit(err(true,$result['data']));
            } else {
                exit(err(false,'Player not found!'));
            }
        } else {
            exit(err(false,$result['message']));
        }
    } else {
        exit(err(false,'Not connecting!'));
    }
} else {
	exit(err(false,'No direct script access allowed!'));
}