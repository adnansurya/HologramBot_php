<?php
include 'ported_db.php';
include 'global.php';
if(isset($_POST['id']) && isset($_POST['filename'])) {
    if(checkMember($_POST['id']) == 0){
        echo 'Anggota Tidak Dikenali';
    }else if(checkMember($_POST['id']) == 1){
        $currentImage = getOneMember($_POST['id'])['im_fl'];
        if($currentImage == ''){
            $currentImage = $_POST['filename'];
        }       
        if(addImage($_POST['id'], $currentImage)){
            echo 'Berhasil:'.$currentImage; 
            sendMessage($_POST['id'], 'Foto berhasil ditambahkan', $token);        
        }else{
            echo 'Gagal menambahkan foto';
        }
    }else{
        echo 'Duplikasi member terdeteksi!';
    }
}else{
    echo 'Parameter tidak lengkap';
}


?>