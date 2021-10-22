<?php
        
    include 'ported_db.php';

    $gambar = $_POST['gambar'];
    $nama = strtoupper($_POST['nama']);

    $timestamp = date_timestamp_get($date);
    $namapic = $timestamp.'.jpg';
    
    $filepic='../captured/'.$namapic;
    file_put_contents($filepic, base64_decode($gambar));

    

   
    $lastLog = getLastLogByName($nama);
    $selisih = selisihWaktu($lastLog);
    echo $selisih;

    if($selisih > 60 || $selisih == 0){
        $pesan = actHadir($nama, 'img', $waktu);   

        // if($debugMode){            
        //     sendMessage($adnan_id, $pesan, $token);
        // }else{
        //     sendMessage($hologram_id, $pesan, $token);
        // }

        if($debugMode){
            sendImageCaption($adnan_id, $filepic,$pesan, $token);
        }else{
            sendImageCaption($hologram_id, $filepic,$pesan, $token);
        }
    }


    

    

?>