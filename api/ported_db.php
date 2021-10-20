<?php

$dbDir = '../python_files/faceRecognition/';
$db= new SQLite3($dbDir.'holoAbsen.db');




function checkMember($id_user){
    global $db;    
    $userNum = $db->querySingle("SELECT  count(id_ur) AS 'user' FROM holo_ur WHERE id_ur=".$id_user, false);    
    return $userNum;
}


function newMember($idTele, $idKtp, $fstNm, $lstNm, $urNm, $imFl, $tmStmp, $role){
    global $db;
    $sqlStr = "INSERT INTO holo_ur  (id_ur, ktp_hex, fst_nm, lst_nm, ur_nm, im_fl, tm_stmp, role) VALUES ('".$idTele."','".$idKtp."','".$fstNm."','".$lstNm."','".$urNm."','".$imFl."','".$tmStmp."','".$role."') " ;
    echo $sqlStr;
    $dbResult = $db->exec($sqlStr);
    if($dbResult){
        return TRUE;
    }else{
        return FALSE;
    }
}

?>