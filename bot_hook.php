<?php
    include 'db_access.php';
   
    
    
    $token = '935743271:AAH_FkEs0Zzfm3MwXflAWHAkLuZbGH3ZEbc';
    $hologram_id = '-1001195370799';
    $adnan_id = '108488036';

    $getter = file_get_contents("php://input");

    $update = json_decode($getter, TRUE);

    // $chat_id = $update["message"]["chat"]["id"];
    $chat_id = $adnan_id;
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

    $pesan = '';
    include 'global.php';
    $timestamp = date_timestamp_get($date);

    $sql = "";
    $status = "";
    $nomor = 0;
    // $check = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE user_id='" .$user_id."'");
    if(getComm($message, '/cek')){           
        $check = mysqli_query($conn,"SELECT * FROM hologramBot_hadir");
        if (mysqli_num_rows($check) > 0) {
            $pesan = 'Anggota yang hadir saat ini :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $nomor++; 
                $satu = 'User'.$nomor.PHP_EOL;               
                // $satu = $nomor . '. ' .$row['first_name'] .' '. $row['last_name'] .' (@'. $row['username'] . ') - '. $row['status']. PHP_EOL;
                $pesan = $pesan.$satu; 
            }
        }else {
            $pesan = 'Belum ada orang di Ambeso.';
        }
    }elseif(getComm($message, '/log')){        
        $check = mysqli_query($conn,"SELECT * FROM hologramBot_hadir_log order by id_log desc limit 10");
        if (mysqli_num_rows($check) > 0) {
            $pesan = '10 Aktifitas Terakhir :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $nomor++;
                $satu =  $nomor . '. @' . $row['username'] . ' - '. $row['status'] . ' ('. $row['waktu'] . ')' . PHP_EOL;
                $pesan = $pesan.$satu; 
            }
        }else {
            $pesan = 'Log Kosong';
        }
    }elseif(strpos($message, '/daftar') == 0){            
        if($chat_id != $user_id){
            if($chat_id == $hologram_id){
                $pesan = 'Untuk mendaftar, chat (PC) saya dengan format:'.PHP_EOL.'/daftar <id_kartu>';
            }else{
                $pesan = 'Gunakan HologramBot hanya pada Grup HOLOGRAM!';
            }            
        }else{
           
            $card_id = substr($message, 8);
            $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_card='".$card_id."'");
            if (mysqli_num_rows($check_user) > 0) {
                //id dikenali                        
                $pesan = 'Kartu sudah terdaftar!';
            }else{
                //id baru
                $status = "daftar";
                $sql = "INSERT INTO hologramBot_user(id_user,id_card,first_name,last_name,username,timestamp) VALUES ('$user_id','$card_id','$first_name','$last_name','$username','$timestamp')";
                if (!mysqli_query($conn,$sql)){            
                    $pesan = 'Terjadi Kesalahan pendaftaran user';
    
                }else{
                    $last_id = mysqli_insert_id($conn);
                    // sendRegisterLink($last_id);
                    $id_query = "";
                    $time_query = "";
                    $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE no_user='".$last_id."'");
                    if (mysqli_num_rows($check_user) > 0) {
                        //id dikenali
                        while($row = mysqli_fetch_assoc($check_user)) {
                            $id_query = $row['id_user'];
                            $time_query = $row['timestamp'];                            
                        }
            
                        $daftar_url = "https://makassarrobotics.000webhostapp.com/hologramBot/daftar.php?id=".$id_query."&token=".$time_query;
                        $pesan = "Isi data kamu pada link berikut :".PHP_EOL.$daftar_url;
                        
                
                    }else{
                        //id tidak dikenali
                        $pesan = 'Terjadi Kesalahan pengiriman URL pendaftaran.';            
                                  
                    }
                }
            }
            
        }
        
        
    }
    // elseif(getComm($message, '/keluar')){
    //     $status = 'Keluar';
    //     if (mysqli_num_rows($check) > 0) {
    //         $sql = "UPDATE hologramBot_hadir SET status = '".$status."', username = '".$username."' , first_name = '".$first_name."' , last_name = '".$last_name."' , waktu = '".$waktu."' WHERE user_id='" .$user_id. "'";
    //     }else{
    //         $sql = "INSERT INTO hologramBot_hadir(user_id,username,first_name,last_name,status,waktu) VALUES ('$user_id','$username','$first_name','$last_name','$status','$waktu')";
    //     }
       
    //     if (!mysqli_query($conn,$sql)){            
    //         $pesan = 'Terjadi Kesalahan';
    //     }else{
    //         $pesan = $first_name." ".$last_name." (@".$username.") sedang keluar untuk sementara waktu.";
    //     }

    // }
    // elseif(getComm($message, '/pulang')){
    //     $status = 'Pulang';
    //     $pesan = $first_name." ".$last_name." (@".$username.") sudah pulang.";
    //     if (mysqli_num_rows($check) > 0) {
    //         $sql = "DELETE FROM hologramBot_hadir WHERE user_id='" .$user_id. "'";
    //         if (!mysqli_query($conn,$sql)){            
    //             $pesan = 'Terjadi Kesalahan';
    //         }
    //     }
    // }elseif(getComm($message, '/hadir')){
    //     //sendMessage($adnan_id, 'adama', $token );
    //     $status = 'Hadir';

    //     if (mysqli_num_rows($check) > 0) {
    //         $sql = "UPDATE hologramBot_hadir SET status = '".$status."', username = '".$username."' , first_name = '".$first_name."' , last_name = '".$last_name."' , waktu = '".$waktu."' WHERE user_id='" .$user_id. "'";
    //     }else{
    //         $sql = "INSERT INTO hologramBot_hadir(user_id,username,first_name,last_name,status,waktu) VALUES ('$user_id','$username','$first_name','$last_name','$status','$waktu')";
    //     }
       
    //     if (!mysqli_query($conn,$sql)){            
    //         $pesan = 'Terjadi Kesalahan';
    //     }else{
    //         $pesan = $first_name." ".$last_name." (@".$username.") sedang berada di Ambeso.";
    //     }

    // }
    

    
    
    sendMessage($chat_id, $pesan, $token);

    if($status != "" && $card_id != ""){
        $sql = "INSERT INTO hologramBot_log(id_card,status,waktu) VALUES ('$card_id','$status','$waktu')";
        if (!mysqli_query($conn,$sql)){            
            $pesan = 'Terjadi Kesalahan penulisan log';
            sendMessage($chat_id, $pesan, $token);
        }
    }
   
    
    
    
    

?>