<?php
if (!isset($call) && !isset($provider) && !isset($data_prv))
    die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");

if ($provider == 'SMMRAJA') {
 $try = $curl->connectPost($data_prv['link'].'',['key' => $data_prv['apikey'],'action' => 'refill','order' => $_POST["refill"]]);
 if($try['order']){
     $try['order'] == true;
 }else{
    $try['order'] == false;
 }
    if($try['order'] == true) {
        $req_result = true;
        $req_provid = $try['order'];
        $req_remain = 0;
        $req_count = 0;
    } else {
        $req_result = false;
        $req_message = isset($try['order']) ? $try['order'] : 'Koneksi Gagal/Hubungi Admin nurulsmmpedia2!';
    }
}