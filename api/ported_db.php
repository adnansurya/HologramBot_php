<?php
include 'global.php';
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


function getAllMemberStr(){
    global $db;
    $userData = $db->query("SELECT * FROM holo_ur");  
    // $queries = $dbProduct->query("SELECT * from table_product");
    $msg = 'Member Terdaftar :'.PHP_EOL .PHP_EOL;
    
    while($row = $userData->fetchArray(SQLITE3_ASSOC) ) {                                        
        $satu = $row['id_ac']. ' - '. $row['id_ur']. ' - '. $row['fst_nm'] .' '. $row['lst_nm'] .' (@'. $row['ur_nm'] . ') '. $row['im_fl'] .' - '.$row['role'].' - '.$row['holonick'].PHP_EOL.PHP_EOL;
        $msg= $msg.$satu; 
    } 
    return $msg;
}


function editNick($id_user, $newNick){
    global $db;
    $sqlStr = "UPDATE holo_ur SET holonick='".$newNick."' WHERE id_ur='".$id_user."'";
    // echo $sqlStr;
    $dbResult = $db->exec($sqlStr);
    if($dbResult){
        return TRUE;
    }else{
        return FALSE;
    }
}




function newMember($idTele, $idKtp, $fstNm, $lstNm, $urNm, $imFl, $tmStmp, $role, $nickname){
    global $db;
    $sqlStr = "INSERT INTO holo_ur  (id_ur, ktp_hex, fst_nm, lst_nm, ur_nm, im_fl, tm_stmp, role, holonick) VALUES ('".$idTele."','".$idKtp."','".$fstNm."','".$lstNm."','".$urNm."','".$imFl."','".$tmStmp."','".$role."','".$nickname."') " ;
    // echo $sqlStr;
    $dbResult = $db->exec($sqlStr);
    if($dbResult){
        return TRUE;
    }else{
        return FALSE;
    }
}

function addLog($nama, $idTele, $idKtp, $stat, $waktu){
    global $db;
    $sqlStr = "INSERT INTO holo_lg  (nm, id_ur, ktp_hex, st_lg, wkt) VALUES ('".$nama."','".$idTele."','".$idKtp."','".$stat."','".$waktu."') " ;
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
    $namaImg = strtoupper($filename);

    global $db;
    $sqlStr = "UPDATE holo_ur SET im_fl='".$namaImg."', role=1 WHERE id_ur='".$idUser."'";
    // echo $sqlStr;
    $dbResult = $db->exec($sqlStr);
    if($dbResult){
        return TRUE;
    }else{
        return FALSE;
    }
    // return $dbResult;
}


function actHadir($val, $jenis, $wkt){
    global $db;
    $msg = '';
    $idTel = '';
    $idKtp = '';
    $statusLog = '';
    $nama = '';
    $sqlAbsen = "";
    if($jenis == 'img'){
        $nama = $val;
        $sqlAbsen = "SELECT * FROM holo_ur WHERE im_fl='".$nama."'";
        
        
    }elseif($jenis == 'wifi'){
        $holonick = $val;
        $sqlAbsen =  "SELECT * FROM holo_ur WHERE holonick='".$holonick."'";
    }

    $cekMember = $db->querySingle($sqlAbsen, true);  
    if($cekMember){
        $idTel = $cekMember['id_ac'];            
        $cekHadir = $db->querySingle("SELECT  count(id_ac) AS 'hadir' FROM hadir WHERE id_ac='".$idTel."'", false); 
        if($cekHadir){                
            $statusLog = 'pulang';
            $db->exec("DELETE from hadir WHERE id_ac='".$idTel."'");
            $msg = 'Nanti datang lagi ya, '.$nama.' !';
        }else{
            $statusLog = 'datang';
            $db->exec("INSERT INTO hadir (id_ac, waktu) VALUES ('".$idTel."','".$wkt."')");
            $msg = $cekMember['fst_nm'].' '.$cekMember['lst_nm'] .'lagi di basecamp nih';
        }

    }else{
        $statusLog = 'tak dikenali';
        $nama = 'UNKNOWN';
        $msg = 'Member tak dikenali';
    }
    
    addLog($nama, $idTel, $idKtp, $statusLog, $wkt);
    return $msg;
}


function getLastLogByName($nama){
    global $db, $date;

    $sqlStr = "SELECT * FROM holo_lg WHERE nm='".$nama."' ORDER BY id_lg DESC LIMIT 1";
    $cekLog = $db->querySingle($sqlStr, true);

    if($cekLog){
        $myDateTime = DateTime::createFromFormat('d-m-Y H:i:s', $cekLog['wkt']);
        $newDateString = $myDateTime->format('Y-m-d H:i:s');
    }else{
        $newDateString = $date->format('Y-m-d H:i:s');
    }   

    return $newDateString;
}




?>