<?php

$dbDir = '../python_files/faceRecognition/';
$db= new SQLite3($dbDir.'holoAbsen.db');




function checkMember($id_user){
    global $db;    
    $userNum = $db->querySingle("SELECT  count(id_ur) AS 'user' FROM holo_ur WHERE id_ur=".$id_user, false);    
    return $userNum;
}


function getOneMember($id_user){
    global $db;
    $userData = $db->querySingle("SELECT * FROM holo_ur WHERE id_ur=".$id_user, true);    
    return $userData;
}




function newMember($idTele, $idKtp, $fstNm, $lstNm, $urNm, $imFl, $tmStmp, $role){
    global $db;
    $sqlStr = "INSERT INTO holo_ur  (id_ur, ktp_hex, fst_nm, lst_nm, ur_nm, im_fl, tm_stmp, role) VALUES ('".$idTele."','".$idKtp."','".$fstNm."','".$lstNm."','".$urNm."','".$imFl."','".$tmStmp."','".$role."') " ;
    // echo $sqlStr;
    $dbResult = $db->exec($sqlStr);
    if($dbResult){
        return TRUE;
    }else{
        return FALSE;
    }
}

function allMember(){
    global $db;
    $members = $db->query("SELECT * FROM holo_ur");    
    $rows = array();
    // $resObj -> result = "";
    while($row = $members->fetchArray(SQLITE3_ASSOC) ) {    
        $rows[] = $row;
    }

    return json_encode($rows);
}

function addImage($idUser, $filename){
    global $db;
    $sqlStr = "UPDATE holo_ur SET im_fl='".$filename."', role=1 WHERE id_ur='".$idUser."'";
    // echo $sqlStr;
    $dbResult = $db->exec($sqlStr);
    if($dbResult){
        return TRUE;
    }else{
        return FALSE;
    }
    // return $dbResult;
}

?>