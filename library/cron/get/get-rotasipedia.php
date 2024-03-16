<?php
set_time_limit(240);
require '../../../connect.php';
require _DIR_('library/shennboku.app/setting_propit');
require_once '../helper.php';

$prov = $call->query("SELECT * FROM provider WHERE code = 'ROTASIPEDIA'");

$basics = conf('profit',3);
$premiums = conf('profit',4);
$reset = isset($_GET['reset']) ? true : false;
$shows = isset($_GET['cjorg']) ? false : true;
if ($prov->num_rows == 1) {
    $prov = $prov->fetch_assoc();
    $try = $curl->connectPost($prov['link'] . 'social-media', ['key' => $prov['apikey'], 'sign' => md5($prov['userid'] . $prov['apikey']),'type' => 'services']);
    // var_dump($try['data']);
    if (isset($try['result'])) {
        if ($try['result'] == true) {
            if (count($try['data']) > 0) {
                for ($i = 0; $i <= count($try['data']) - 1; $i++) {
                    $data = $try['data'][$i];
                    $pid = $data['id'];
                    $cat = $data['category'];
                    $name = $data['name'];
                    $min = $data['min'];
                    $max = $data['max'];
                    $price = $data['price'];
                    $note = $data['note'];
                    $type = $data['type'];
                    $refill = $data['refill'] == true ? 'true' : 'false';

                    ///////////////Start Harga///////////////
                    $priceb = ($price * $basics) - $price;
                    $pricep = ($price * $premiums) - $price;
                    ///////////////End Harga///////////////

                    $check_category = $call->query("SELECT * FROM category WHERE code = '$cat' AND type = 'social-media' AND `order` = 'social' AND server = 'S1'");
                    $check_service = $call->query("SELECT * FROM srv_socmed WHERE pid = '$pid' AND provider = '" . $prov['code'] . "' ");
                    
                    
                    // $check_category = $call->query("SELECT * FROM category WHERE code = '$cat' AND type = 'social-media' AND `order` = 'social'");
                    // $check_service = $call->query("SELECT * FROM srv_socmed WHERE pid = '$pid' AND provider = '" . $prov['code'] . "'");

                    if ($check_category->num_rows == 0)
                        $call->query("INSERT INTO category VALUES ('','$cat','$cat','social-media','social-media','social','S1')");

                    if ($check_service->num_rows == 0) {
                        $call->query("INSERT INTO srv_socmed VALUES ('','$pid','$cat','$name','$note','$price','$priceb','$pricep','$min','$max','available','$type','" . $prov['code'] . "','$date $time')");
                        if($shows == true) print '<font color="green"><pre>';
                        if($shows == true) print "[+] $name {Berhasil ditambahkan}<br>";
                        if($shows == true) print "Min: $min<br>";
                        if($shows == true) print "Max: $max<br>";
                        #if($shows == true) print "Status: $status<br>";
                        if($shows == true) print "Harga Pusat: $price<br>";
                        if($shows == true) print "Harga Basic: ".($price+$priceb)."<br>";
                        if($shows == true) print "Harga Premium: ".($price+$pricep)."<br>";
                        if($shows == true) print "Harga Special: ".($price+$prices);
                        if($shows == true) print '</pre></font><hr>';
                    } else {
                        $data_service = $check_service->fetch_assoc();
                        if ($data_service['price'] <> $price || $data_service['note'] <> $note) {
                        $call->query("UPDATE srv_socmed SET cid = '$category2',name = '$name', price = '$price', basic = '$priceb', premium = '$pricep', min = '$min', max = '$max',status = 'available', date_up = '$date $time', waktu = '$waktuProses' WHERE pid = '$pid' AND provider = '" . $prov['code'] . "'");
                        if($shows == true) print '<font color="green"><pre>';
                        if($shows == true) print "[+] $name {Berhasil diupdate}<br>";
                        if($shows == true) print "Min: ".$data_service['min']." -> $min<br>";
                        if($shows == true) print "Max: ".$data_service['max']." -> $max<br>";
                        #if($shows == true) print "Status: ".$data_service['status']." -> $status<br>";
                        if($shows == true) print "Harga Pusat: ".$data_service['price']." -> $price<br>";
                        if($shows == true) print "Harga Basic: ".($data_service['price']+$data_service['basic'])." -> ".($price+$priceb)."<br>";
                        if($shows == true) print "Harga Premium: ".($data_service['price']+$data_service['premium'])." -> ".($price+$pricep)."<br>";
                        if($shows == true) print "Harga Special: ".($data_service['price']+$data_service['special'])." -> ".($price+$prices);
                        if($shows == true) print '</pre></font><hr>';
                            
                        } else {
                            if($shows == true) print '<font color="red"><pre>[!] '.$name.' {Data masih sama}</pre></font><hr>';
                        }
                    }
                }
            }
        }
    }
}
