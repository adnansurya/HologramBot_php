<?php

include 'ported_db.php';

$nickname = $_GET['holonick'];

$pesan = actHadir($nickname, 'wifi', $waktu); 

if($pesan != ""){
    if($debugMode){
        sendMessage($adnan_id, $pesan, $token);
    }else{
        sendMessage($hologram_id, $pesan, $token);
    }
    
}
?>