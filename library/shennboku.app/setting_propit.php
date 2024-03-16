<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['setprofit'])) {
    $post_9 = $_POST['ppobb'];
    $post_10 = $_POST['ppobp'];
    $post_3 = $_POST['sosmedb'];
    $post_4 = $_POST['sosmedp'];
    $post_5 = $_POST['dolarset'];
    $post_6 = $_POST['raja1'];
    $post_7 = $_POST['raja2'];
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(!in_array($data_user['level'],['Admin'])) {
        ShennXit(['type' => false,'message' => 'Anda tidak memiliki akses untuk menggunakan fitur ini.']);
    } else if(!is_numeric($post_3) || !is_numeric($post_4) || !is_numeric($post_3) || !is_numeric($post_4)) {
        ShennXit(['type' => false,'message' => 'Nilai harus numerik.']);
    }else {
        if($call->query("UPDATE conf SET c1 = '$post_1', c2 = '$post_2', c3 = '$post_3',c4 = '$post_4',c5 = '$post_5',c6 = '$post_6',c7 = '$post_7',c9 = '$post_9',c10 = '$post_10' WHERE code = 'profit'") == true) {
            ShennXit(['type' => true,'message' => 'Update Berhasil.']);
        } else {
            ShennXit(['type' => false,'message' => 'Our server is in trouble, please try again later.']);
        }
    }
}