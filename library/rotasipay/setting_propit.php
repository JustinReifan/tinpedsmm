<?php
if(!isset($call)) die("You cannot directly connect your application to the Enivay App system!<br>- Frendy Santoso (+62 856 5400 8642)");

if (isset($_POST['save'])) {
    
    u('update', 'tripay_key', $_POST['tripay_key']);
    u('update', 'tripay_private', $_POST['tripay_private']);
    u('update', 'tripay_merchant', $_POST['tripay_merchant']);
    
    ShennXit(['type' => true,'message' => 'Konfigurasi tripay berhasil disimpan.']);
}