<?php
set_time_limit(240);
require '../../../connect.php';
require_once '../helper.php';

$prov = $call->query("SELECT * FROM provider WHERE code = 'VIP'");
if ($prov->num_rows == 1) {
    $prov = $prov->fetch_assoc();
    $try = $curl->connectPost($prov['link'] . 'prepaid', ['key' => $prov['apikey'], 'sign' => md5($prov['userid'] . $prov['apikey']), 'type' => 'services', 'filter_type' => 'type','filter_value' => 'paket-telepon']);
    if (isset($try['result'])) {
        if ($try['result'] == true) {
            if (count($try['data']) > 0) {
                for ($i = 0; $i <= count($try['data']) - 1; $i++) {
                    $data = $try['data'][$i];
                    $code = trim($data['code']);
                    $name = trim($data['name']);
                    $note = $data['note'];
                    $type = $data['type'];
                    $brand = $data['brand'];
                    $price = $data['price']['special'];
                    $category = $data['category'];
                    $status = $helper->stock($data['status']);
                    $prepost = strtolower($data['prepost']);

                    ///////////////Start Harga///////////////
                    $priceb = 290;
                    $pricep = 210;
                    ///////////////End Harga///////////////

                    $check_category = $call->query("SELECT * FROM category WHERE code = '$brand' AND type = '$type' AND `order` = '$prepost'");
                    $check_service = $call->query("SELECT * FROM srv_ppob WHERE code = '$code' AND provider = '" . $prov['code'] . "'");

                    if ($check_category->num_rows == 0)
                        $call->query("INSERT INTO category VALUES ('','$brand','$brand','$type','$type','$prepost','')");

                    if ($check_service->num_rows == 0) {
                        $call->query("INSERT INTO srv_ppob VALUES ('','$type','$code','$name','$note','$price','$priceb','$pricep','$status','$brand','" . $prov['code'] . "','$date $time')");
                         print '<font color="green"><pre>';
                        print "[+] $name {Berhasil ditambahkan}<br>";
                        print "Type: $otype -> $type<br>";
                        print "Status: $status<br>";
                        print "Harga Pusat: $price<br>";
                        print "Harga Basic: ".($price+$priceb)."<br>";
                        print "Harga Premium: ".($price+$pricep);
                        print '</pre></font><hr>';
                    } else {
                        $data_service = $check_service->fetch_assoc();
                        if ($data_service['price'] <> $price || $data_service['status'] <> $status) {
                            $call->query("UPDATE srv_ppob SET note = '$note', price = '$price', basic = '$priceb', premium = '$pricep', status = '$status', date_up = '$date $time' WHERE code = '$code' AND provider = '" . $prov['code'] . "'");
                            print '<font color="green"><pre>';
                            print "[+] $name {Berhasil diupdate}<br>";
                            print "Type: $otype -> $type<br>";
                            print "Status: ".$data_service['status']." -> $status<br>";
                            print "Harga Pusat: ".$data_service['price']." -> $price<br>";
                            print "Harga Basic: ".($data_service['price']+$data_service['basic'])." -> ".($price+$data_service['basic'])."<br>";
                            print "Harga Premium: ".($data_service['price']+$data_service['premium'])." -> ".($price+$data_service['premium']);
                            print '</pre></font><hr>';
                        }else {
                            print '<font color="red"><pre>[!] '.$name.' {Data masih sama}</pre></font><hr>';
                        }
                    }
                }
            }
        }
    }
}
