<?php
set_time_limit(240);
require '../../../connect.php';
require_once '../helper.php';

$prov = $call->query("SELECT * FROM provider WHERE code = 'VIP'");
$shows = isset($_GET['cjorg']) ? false : true;
if($prov->num_rows == 1) {
    $prov = $prov->fetch_assoc();
    $try = $curl->connectPost($prov['link'].'game-feature',['key' => $prov['apikey'],'sign' => md5($prov['userid'].$prov['apikey']),'type' => 'services']);
    if(isset($try['result'])) {
        if($try['result'] == true) {
            if(count($try['data']) > 0) {
                for($i = 0; $i <= count($try['data'])-1; $i++) {
                    $data = $try['data'][$i];
                    $code = $data['code'];
                    $game = $data['game'];
                    $name = $data['name'];
                    $price = $data['price']['special'];
                    $priceb = 900;
                    $pricep = 350;
                    $server = $data['server'];
                    $status = $helper->stock($data['status']);

                    if(in_array($game,['','Netflix Premium','Spotify Premium','WeTV Premium','Vidio Premier','Youtube Premium','Disney Hotstar','Telegram Premium','Canva Pro','iQIYI Premium','Sausage Man','Omega Legends','Valorant','Marvel Super War','One Punch Man','PUBGM GLOBAL','PUBGM INDO A','PUBGM INDO B','Free Fire','Free Fire Max','Mobile Legends Promo','Mobile Legends Joki Rank','Mobile Legends Gift','Mobile Legends A','Mobile Legends B','Mobile Legends Vilog','Mobile Legends Membership','Apex Legends Mobile','Genshin Impact','Genshin Impact Vilog','Tower of Fantasy','Marvel Super War','Lords Mobile','Dragon Raja','Lita','Valorant','Honkai Impact 3','Arena of Valor','LifeAfter','Steam Wallet Code','League of Legends','Hyper Front','Apple Gift Card','Ragnarok M Eternal Love','PUBGM New State','RagnaroK X Next Generation','Light of Thel','Tom and Jerry Chase','Zepeto'])) {
                        $check_category = $call->query("SELECT * FROM category WHERE code = '$game' AND type = 'game-topup' AND `order` = 'game'");
                        $check_service = $call->query("SELECT * FROM srv_game WHERE code = '$code' AND provider = 'VIP'");
    
                        if($check_category->num_rows == 0)
                            $call->query("INSERT INTO category VALUES ('','$game','$game','game-topup','game-topup','game','')");
                                
                        if($check_service->num_rows == 0) {
                            if ($status == 'available'){
                            $call->query("INSERT INTO srv_game VALUES ('','$code','$game','$name','$server','$price','$priceb','$pricep','$status','VIP','$date $time')");
                            if($shows == true) print '<font color="green"><pre>';
                            if($shows == true) print "[+] $name {Berhasil ditambahkan}<br>";
                            if($shows == true) print "Status: $status<br>";
                            if($shows == true) print "Harga Pusat: $price<br>";
                            if($shows == true) print "Harga Basic: ".($price+$priceb)."<br>";
                            if($shows == true) print "Harga Premium: ".($price+$pricep);
                            if($shows == true) print '</pre></font><hr>';
                        }} else {
                            $data_service = $check_service->fetch_assoc();
                            if($data_service['price'] <> $price || $data_service['basic'] <> $priceb || $data_service['premium'] <> $pricep || $data_service['status'] <> $status) {
                                $call->query("UPDATE srv_game SET price = '$price', basic = '$priceb', premium = '$pricep', status = '$status', date_up = '$date $time' WHERE code = '$code' AND provider = 'VIP'");
                                if($shows == true) print '<font color="green"><pre>';
                                if($shows == true) print "[+] $name {Berhasil diupdate}<br>";
                                if($shows == true) print "Status: ".$data_service['status']." -> $status<br>";
                                if($shows == true) print "Harga Pusat: ".$data_service['price']." -> $price<br>";
                                if($shows == true) print "Harga Basic: ".($data_service['price']+$data_service['basic'])." -> ".($price+$data_service['basic'])."<br>";
                                if($shows == true) print "Harga Premium: ".($data_service['price']+$data_service['premium'])." -> ".($price+$data_service['premium']);
                                if($shows == true) print '</pre></font><hr>';
                            } else {
                                if($shows == true) print '<font color="red"><pre>[!] '.$name.' {Data masih sama}</pre></font><hr>';
                            }
                        }
                    }
                }
            } else {
                print '<font color="red"><pre>[!] No Service</pre></font>';
            }
        } else {
            print '<font color="red"><pre>[!] '.$try['message'].'</pre></font>';
        }
    } else {
        print '<font color="red"><pre>[!] Connection Failed</pre></font>';
    }
} else {
    print '<font color="red"><pre>[!] Provider not found</pre></font>';
}
?>