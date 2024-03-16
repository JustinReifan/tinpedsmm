<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['simpanwa'])) {
    $post_1 = $_POST['devices'];
    $post_2 = $_POST['keys'];
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    }  else {
        if($call->query("UPDATE conf SET c1 = '$post_1', c2 = '$post_2' WHERE code = 'wapisender'") == true) {
            ShennXit(['type' => true,'message' => 'wapisender update.']);
        } else {
            ShennXit(['type' => false,'message' => 'Our server is in trouble, please try again later.']);
        }
    }
}