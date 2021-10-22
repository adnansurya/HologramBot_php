<?php
        
    include 'ported_db.php';

    $gambar = $_POST['gambar'];
    $nama = strtoupper($_POST['nama']);

    $timestamp = date_timestamp_get($date);
    $namapic = $timestamp.'.jpg';
    
    $filepic='../captured/'.$namapic;
    file_put_contents($filepic, base64_decode($gambar));

    if($debugMode){
        sendImage($adnan_id, $filepic, $token);
    }else{
        sendImage($hologram_id, $filepic, $token);
    }

    $pesan = actHadir($nama, 'img', $waktu);   

    if($debugMode){
        sendImage($adnan_id, $pesan, $token);
    }else{
        sendImage($hologram_id, $pesan, $token);
    }

?>