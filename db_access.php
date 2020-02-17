<?php

$local = false;

if($local){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "id6774493_mksrobotics";
}else{
    $servername = "localhost";
    $username = "id6774493_mksrobotics";
    $password = "mksrobotics";
    $dbname = "id6774493_mksrobotics";
}


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    // echo "<script>console.log('DB connected!' );</script>";
}
?>