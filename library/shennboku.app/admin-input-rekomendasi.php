<?php
if(!isset($call)) die("You cannot directly connect your application to the ShennBoku App system!<br>- Afdhalul Ichsan Yourdan");
if(isset($_POST['addrekomendasi'])) {
    $post_quest = $_POST['addfaq_quest'];
    $post_answer = str_replace(['<script','</script>'],'',$_POST['addfaq_ans']);
    
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(!in_array($data_user['level'],['Admin'])) {
        ShennXit(['type' => false,'message' => 'You do not have access to use this feature.']);
    } else if(strlen($post_quest) > 1000) {
        ShennXit(['type' => false,'message' => 'The question is too long, maximum 1000 characters.']);
    } else {
        if($call->query("INSERT INTO rekomendasi VALUES (null,'$post_quest','$post_answer')") == true) {
            ShennXit(['type' => true,'message' => 'added successfully.']);
        } else {
            ShennXit(['type' => false,'message' => 'Our server is in trouble, please try again later.']);
        }
    }
} if(isset($_POST['editrekomendasi'])) {
    $web_token = $_POST['web_token'];
    $post_quest = $_POST['editfaq_quest'];
    $post_answer = str_replace(['<script','</script>'],'',$_POST['editfaq_ans']);

    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(!in_array($data_user['level'],['Admin'])) {
        ShennXit(['type' => false,'message' => 'You do not have access to use this feature.']);
    } else if(strlen($post_quest) > 1000) {
        ShennXit(['type' => false,'message' => 'The question is too long, maximum 128 characters.']);
    } else if($call->query("SELECT * FROM rekomendasi WHERE no_id = '$web_token'")->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Data not found.']);
    } else {
        if($call->query("UPDATE rekomendasi SET nomor = '$post_quest', name = '$post_answer' WHERE no_id = '$web_token'") == true) {
            ShennXit(['type' => true,'message' => 'updated successfully.'],base_url('admin/input-rekomendasi/'));
        } else {
            ShennXit(['type' => false,'message' => 'Our server is in trouble, please try again later.']);
        }
    }
} if(isset($_POST['deleterekomendasi'])) {
    $web_token = $_POST['web_token'];
    if($result_csrf == false) {
        ShennXit(['type' => false,'message' => 'System Error, please try again later.']);
    } else if($_CONFIG['lock']['status'] == true) {
        ShennXit(['type' => false,'message' => $_CONFIG['lock']['reason']]);
    } else if(!in_array($data_user['level'],['Admin'])) {
        ShennXit(['type' => false,'message' => 'You do not have access to use this feature.']);
    } else if($call->query("SELECT no_id FROM rekomendasi WHERE no_id = '$web_token'")->num_rows == 0) {
        ShennXit(['type' => false,'message' => 'Data not found.']);
    } else {
        if($call->query("DELETE FROM rekomendasi WHERE no_id = '$web_token'") == true) {
            ShennXit(['type' => true,'message' => 'QnA deleted successfully.']);
        } else {
            ShennXit(['type' => false,'message' => 'Our server is in trouble, please try again later.']);
        }
    }
}