<?php
set_time_limit(240);
require '../../../connect.php';
require _DIR_('library/shennboku.app/setting_propit');
require_once '../helper.php';
#require '../helper-sos.php';


$prov = $call->query("SELECT * FROM provider WHERE code = 'MEDANPEDIA'");
$basics = conf('profit',3);
$premiums = conf('profit',4);
$reset = isset($_GET['reset']) ? true : false;
$shows = isset($_GET['cjorg']) ? false : true;
if($prov->num_rows == 1) {
    $prov = $prov->fetch_assoc();
    $try = $curl->connectPost($prov['link'].'/services',['api_id' => $prov['userid'],'api_key' => $prov['apikey']]);
 if(isset($try['status'])) {
        file_put_contents('medan-input.json', json_encode($try, JSON_PRETTY_PRINT));
        if($try['status'] == true) {
            if(count($try['data']) > 0) {
                for($i = 0; $i <= count($try['data'])-1; $i++) {
                    $data = $try['data'][$i];
                    $pid = $data['id'];
                    $min = $data['min'];
                    $max = $data['max'];
                    $name = $data['name'];
                    $type = $data['type'];
                    $note = $data['description'];
                    $waktuProses = $data['average_time'];
                    $price = $data['price'];
                    // $priceb = 3000; // Profit Basic
                    // $pricep = 1500; // Profit Premium
                    ///////////////Start Harga///////////////
                    $priceb = ($price * $basics) - $price;
                    $pricep = ($price * $premiums) - $price;
                    $prich = ($price * 1.17) - $price;
                    ///////////////End Harga///////////////
                    #$status = $helper->stock($data['status']);
                    $category = $data['category'];
                    $category2 = str_replace(['&','*'],'',$data['category']);

                    $check_category = $call->query("SELECT * FROM category WHERE code = '$category' AND type = 'social-media' AND server = 'S2'");
                    $check_service = $call->query("SELECT * FROM srv_socmed WHERE pid = '$pid' AND provider = 'MEDANPEDIA'");

                    if($check_category->num_rows == 0)
                        $call->query("INSERT INTO category VALUES ('','$category','$category','social-media','social-media','social','S2')");
                            
                    if($check_service->num_rows == 0) {
                        $call->query("INSERT INTO srv_socmed VALUES ('','$pid','$category','$name','$note','$price','$priceb','$pricep','$min','$max','available','','MEDANPEDIA','$date $time')");
                        // $call->query("INSERT INTO srv_socmed VALUES ('','$pid','$category2','$name','$note','$price','$priceb','$pricep',$prich,'$min','$max','available','','" . $prov['code'] . "','$date $time')");
                        if($shows == true) print '<font color="green"><pre>';
                        if($shows == true) print "[+] $name {Berhasil ditambahkan}<br>";
                        if($shows == true) print "Min: $min<br>";
                        if($shows == true) print "Max: $max<br>";
                        #if($shows == true) print "Status: $status<br>";
                        if($shows == true) print "Harga Pusat: $price<br>";
                        if($shows == true) print "Harga Basic: ".($price+$priceb)."<br>";
                        if($shows == true) print "Harga Premium: ".($price+$pricep)."<br>";
                        if($shows == true) print "Harga Special: ".($price+$prich);
                        if($shows == true) print '</pre></font><hr>';
                    } else {
                        $data_service = $check_service->fetch_assoc();
                        if($data_service['price'] <> $price || $reset == true || $data_service['min'] <> $min || $data_service['max'] <> $max) {
                            // $call->query("UPDATE srv_socmed SET name = '$name', note = '$note', price = '$price', basic = '$priceb', premium = '$pricep', min = '$min', max = '$max', date_up = '$date $time' WHERE pid = '$pid' AND provider = 'MEDANPEDIA'");
                            $call->query("UPDATE srv_socmed SET cid = '$category',name = '$name', price = '$price', basic = '$priceb', premium = '$pricep',h2h = '$prich', min = '$min', max = '$max',status = 'available', date_up = '$date $time', WHERE pid = '$pid' AND provider = 'MEDANPEDIA'");
                            if($shows == true) print '<font color="green"><pre>';
                            if($shows == true) print "[+] $name {Berhasil diupdate}<br>";
                            if($shows == true) print "Min: ".$data_service['min']." -> $min<br>";
                            if($shows == true) print "Max: ".$data_service['max']." -> $max<br>";
                            #if($shows == true) print "Status: ".$data_service['status']." -> $status<br>";
                            if($shows == true) print "Harga Pusat: ".$data_service['price']." -> $price<br>";
                            if($shows == true) print "Harga Basic: ".($data_service['price']+$data_service['basic'])." -> ".($price+$priceb)."<br>";
                            if($shows == true) print "Harga Premium: ".($data_service['price']+$data_service['premium'])." -> ".($price+$pricep)."<br>";
                            if($shows == true) print "Harga Special: ".($data_service['price']+$data_service['h2h'])." -> ".($price+$prich);
                            if($shows == true) print '</pre></font><hr>';
                        } else {
                            if($shows == true) print '<font color="red"><pre>[!] '.$name.' {Data masih sama}</pre></font><hr>';
                        }
                    }
                }
            } else {
                print '<font color="red"><pre>[!] No Service</pre></font>';
            }
        } else {
            print '<font color="red"><pre>[!] '.$try['data']['msg'].'</pre></font>';
        }
    } else {
        print '<font color="red"><pre>[!] Connection Failed</pre></font>';
    }
} else {
    print '<font color="red"><pre>[!] Provider not found</pre></font>';
}
?>