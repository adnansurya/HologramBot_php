<?php
    include 'db_access.php';
    
    $token = '935743271:AAH_FkEs0Zzfm3MwXflAWHAkLuZbGH3ZEbc';
    $hologram_id = '-1001195370799';
    $adnan_id = '108488036';

    $getter = file_get_contents("php://input");

    $update = json_decode($getter, TRUE);

    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $username = $update["message"]["from"]["username"];
    $user_id = $update["message"]["from"]["id"];
    $first_name = $update["message"]["from"]["first_name"];
    $last_name = $update["message"]["from"]["last_name"];
    

    function getComm($msg, $commString){
        
        $pos = strpos($msg, $commString);
        echo $pos;
        if($pos !== false){
            if($pos === 0){
                return true;
            }else{
                return FALSE;
            }
        }else{
            return $pos;
        }      
          
    }


    function sendMessage($chatId, $msg, $tokenAPI){
        $request_params = [
            'chat_id' => $chatId,
            'text' => $msg
        ];    
        
        $request_url = 'https://api.telegram.org/bot'. $tokenAPI . '/sendMessage?' . http_build_query($request_params);
    
        file_get_contents($request_url);
    }

    $date = new DateTime("now", new DateTimeZone('Asia/Makassar') );
    $waktu = $date->format('Y-m-d H:i:s');

    $sql = "";
    $status = "";
    $check = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE user_id='" .$user_id."'");
    if(getComm($message, '/hadir')){
        //sendMessage($adnan_id, 'adama', $token );
        $status = 'Hadir';

        if (mysqli_num_rows($check) > 0) {
            $sql = "UPDATE hologramBot_hadir SET status = '".$status."' WHERE user_id='" .$user_id. "'";
        }else{
            $sql = "INSERT INTO hologramBot_hadir(user_id,username,first_name,last_name,status,waktu) VALUES ('$user_id','$username','$first_name','$last_name','$status','$waktu')";
        }
       
        if (!mysqli_query($conn,$sql)){            
            $pesan = 'Terjadi Kesalahan';
        }else{
            $pesan = $first_name." ".$last_name." (@".$username.") sedang berada di Ambeso.";
        }

    }
    elseif(getComm($message, '/keluar')){
        $status = 'Keluar';
        if (mysqli_num_rows($check) > 0) {
            $sql = "UPDATE hologramBot_hadir SET status = '".$status."' WHERE user_id='" .$user_id. "'";
        }else{
            $sql = "INSERT INTO hologramBot_hadir(user_id,username,first_name,last_name,status,waktu) VALUES ('$user_id','$username','$first_name','$last_name','$status','$waktu')";
        }
       
        if (!mysqli_query($conn,$sql)){            
            $pesan = 'Terjadi Kesalahan';
        }else{
            $pesan = $first_name." ".$last_name." (@".$username.") sedang keluar untuk sementara waktu.";
        }

    }
    elseif(getComm($message, '/pulang')){
        $pesan = $first_name." ".$last_name." (@".$username.") sudah pulang.";
        if (mysqli_num_rows($check) > 0) {
            $sql = "DELETE FROM hologramBot_hadir WHERE user_id='" .$user_id. "'";
            if (!mysqli_query($conn,$sql)){            
                $pesan = 'Terjadi Kesalahan';
            }
        }
    }elseif(getComm($message, '/cek')){
        $pesan = '';
        $check = mysqli_query($conn,"SELECT * FROM hologramBot_hadir");
        if (mysqli_num_rows($check) > 0) {
            $pesan = 'Anggota yang hadir saat ini :'.PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $satu = $row['first_name'] .' '. $row['last_name'] .' (@'. $row['username'] . ') - '. $row['status']. PHP_EOL;
                $pesan = $pesan.$satu; 
            }
        }else {
            $pesan = 'Belum ada orang di Ambeso.';
        }
    }

    
    
    sendMessage($chat_id, $pesan, $token);
   

   

    

    // if(strpos($message, "/hadir") == 0){
    //     sendMessage($adnan_id, "Kirim pesan hadir dari PHP", $token);
    // }

    // if(strpos($message, "/pulang") == 0){
    //     sendMessage($adnan_id, "Kirim pesan pulang dari PHP", $token);
    // }
?>