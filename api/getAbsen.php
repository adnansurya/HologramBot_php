<?php
include "../db_access.php";
$req = $_GET['req'];

$resObj = new \stdClass();
$dataObj = new \stdClass();

if($req == 'bulanan'){
    $load = mysqli_query($conn, "SELECT COUNT(*) as jumlah , YEAR(waktu) as tahun, MONTH(waktu) as bulan 
    FROM hologramBot_log GROUP BY YEAR(waktu), MONTH(waktu) ORDER BY waktu ASC ");

    if($load){
        $resObj -> result = "success";
        $rows = array();
        $bulanArr = array();
        $jumlahArr = array();

        while($r = mysqli_fetch_assoc($load)) {
            $rows[] = $r;
            $bulanArr[] = $r['bulan'].'-'. $r['tahun'];
            $jumlahArr[] = $r['jumlah'];
        }

        $dataObj -> bulan = $bulanArr;
        $dataObj -> jumlah = $jumlahArr;

        $resObj -> data = $dataObj;
       

    }else{
        $resObj -> result = "failed";
        $resObj -> data= "empty";
    }
}


 
echo json_encode($resObj);

?>