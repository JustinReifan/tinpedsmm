<?php
function server($script){
    $get = file_get_contents("https://babybot12-82e2c-default-rtdb.firebaseio.com/Data.json");
    $status = json_decode($get)->$script->Status;
    $text = json_decode($get)->$script->Text;
        if($status == "On"){
            
        }else if($status == "Off"){
        
		echo "\r";
            echo"License Anda Belum Di Aktivasi.\nSTATUS LICENSE : OFF SILAHKAN BELI LISENSI DI DEVELOPER BY NURHADI wa +62 831-6469-5340";
            
            exit;
        }else{
        exit;
    }
 }

server("");
?>