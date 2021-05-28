<?php

include('../api/global.php');

$id_user = $_POST['id_user'];
$id_card = $_POST['id_card'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$ringtone = $_POST['ringtone'];
$timestamp =  date_timestamp_get($date);
$role = $_POST['role'];
$codeHash = md5($_POST['password']);

$db = new SQLite3('../db/hologramMKS.db');
if(!$db){
        echo '<p>DB Error</p>';
}else{

    $sql = $db->exec("INSERT INTO user 
    (id_user, id_card, first_name, last_name, 
    username, ringtone, timestamp, role, codeHash) 
    VALUES ('".$id_user."','".$id_card."','".$first_name."','".$last_name."',
    '".$username."','".$ringtone."','".$timestamp."','".$role."',
    '".$codeHash."')");
}
$db->close();

?>