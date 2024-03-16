<?php
class GameNickChecker
{
    private $id;
    private $key;
    
    public function __construct($id,$key) {
        $this->key = $id;
        $this->sign = $key;
    }
    
    public function MobileLegends($id,$zone) {
        return $this->connectPost(['code' => 'mobile-legends','target' => $id,'additional_target' => $zone]);
    }

    public function FreeFire($id) {
        return $this->connectPost(['code' => 'free-fire','target' => $id]);
    }
    
    
    public function CallofDutyMobile($id) {
        return $this->connectPost(['code' => 'call-of-duty-mobile','target' => $id]);
    }
    
    public function PubgMobile($id) {
        return $this->connectPost(['code' => 'pubg-mobile','target' => $id]);
    }
    
    public function Hago($id) {
        return $this->connectPost(['code' => 'hago','target' => $id]);
    }
    
    public function Zepeto($id) {
        return $this->connectPost(['code' => 'zepeto','target' => $id]);
    }
    
    public function eightBall($id) {
        return $this->connectPost(['code' => '8-ball-pool','target' => $id]);
    }
    
    public function DragonRaja($id) {
        return $this->connectPost(['code' => 'dragon-raja','target' => $id]);
    }
    
    public function PointBlank($id) {
        return $this->connectPost(['code' => 'point-blank','target' => $id]);
    }
    
    public function LeagueofLegends($id) {
        return $this->connectPost(['code' => 'league-of-legends-wild-rift','target' => $id]);
    }
    
    public function ApexLegends($id) {
        return $this->connectPost(['code' => 'Apex-Legends','target' => $id]);
    }
    
    public function LordsMobile($id) {
        return $this->connectPost(['code' => 'lords-mobile','target' => $id]);
    }
    
    public function LostSaga($id) {
        return $this->connectPost(['code' => 'Lost-Saga','target' => $id]);
    }
    
    public function ArenaofValor($id) {
        return $this->connectPost(['code' => 'arena-of-valor','target' => $id]);
    }
    
    public function SpeedDrifters($id) {
        return $this->connectPost(['code' => 'speed-drifters','target' => $id]);
    }
    
    public function LifeAfter($id) {
        return $this->connectPost(['code' => 'Life-After','target' => $id]);
    }
    
    public function MarvelSuperWar($id) {
        return $this->connectPost(['code' => 'marvel-super-war','target' => $id]);
    }
    
    public function RagnarokEternalLove($id) {
        return $this->connectPost(['code' => 'ragnarok-m-eternal-love-big-cat-coin','target' => $id]);
    }
    
    public function Valorant($id) {
        return $this->connectPost(['code' => 'valorant','target' => $id]);
    }
    
    public function SausageMan($id) {
        return $this->connectPost(['code' => 'Sausage-Man','target' => $id]);
    }
    
    
    // END POINT CONNECTION
    
  public function connectPost($postdata,$reqout = 'decode') {
        $end_point = 'https://vip-reseller.co.id/api/game-feature';
        $postdata['key'] = $this->key;
        $postdata['sign'] = $this->sign;
        $postdata['type'] = 'get-nickname';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $end_point);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $chresult = curl_exec($ch);
        curl_close($ch);
        if(!$chresult) $chresult = $this->connectHeaderPost($end_point,['content-type: multipart/form-data;'],$postdata,'original');
        return ($reqout == 'decode') ? json_decode($chresult, true) : $chresult;
    }
}