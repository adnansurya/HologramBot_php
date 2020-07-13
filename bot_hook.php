<?php
    include 'db_access.php';
    include 'global.php';
   
    
    // $chat_id = $adnan_id;

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

    $pesan = '';
    
    $timestamp = date_timestamp_get($date);

    $sql = "";
    $status = "";
    $nomor = 0;
    // $check = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE user_id='" .$user_id."'");
    if(getComm($message, '/cek')){           
        $check = mysqli_query($conn,"SELECT hologramBot_user.username, hologramBot_user.first_name, hologramBot_user.last_name, hologramBot_hadir.waktu FROM hologramBot_hadir INNER JOIN hologramBot_user ON hologramBot_user.id_card = hologramBot_hadir.id_card");
        if (mysqli_num_rows($check) > 0) {
            $pesan = 'Anggota yang hadir saat ini :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $nomor++;
                $waktu_split = explode(" ", $row['waktu']);                                
                $satu = $nomor . '. '. $row['first_name'] .' '. $row['last_name'] .' (@'. $row['username'] . ') dari jam '. $waktu_split[1].' WITA'.PHP_EOL;
                $pesan = $pesan.$satu; 
            }
        }else {
            $pesan = 'Belum ada orang di Ambeso.';
        }
    }elseif(getComm($message, '/log')){        
        $check = mysqli_query($conn,"SELECT hologramBot_user.first_name, hologramBot_user.last_name, hologramBot_user.username, hologramBot_log.waktu, hologramBot_log.status FROM hologramBot_log INNER JOIN hologramBot_user ON hologramBot_user.id_card = hologramBot_log.id_card order by hologramBot_log.id_log desc limit 5");
        if (mysqli_num_rows($check) > 0) {
            $pesan = '5 Aktifitas Terakhir :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $nomor++;
                $satu =  $nomor. '. '. $row['first_name'] .' '. $row['last_name'] .' / @' . $row['username']. PHP_EOL . "  - ". $row['status'] . ' ('. $row['waktu'] . ')'.PHP_EOL ;
                $pesan = $pesan.$satu; 
            }
        }else {
            $pesan = 'Log Kosong';
        }
    }elseif(getComm($message, '/daftar')){            
        if($chat_id !== $user_id){
            if($chat_id === $hologram_id || getComm($message, '/daftar@hologrambeso_bot')){
                $pesan = 'Untuk mendaftar, chat (PC) saya dengan format:'.PHP_EOL.'/daftar <id_kartu>' .PHP_EOL.PHP_EOL.'PENTING: Jangan mendaftar dengan sembarang id_kartu!';
                
            }else{
                $pesan = 'Gunakan HologramBot hanya pada Grup HOLOGRAM!';
            }            
        }else{
           
            $card_id = substr($message, 8);
            if($card_id == ''){
                $pesan = 'Id Kartu tidak valid!';
            }else{
                $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_card='".$card_id."'");
                if (mysqli_num_rows($check_user) > 0) {
                    //id dikenali                        
                    $pesan = 'Kartu sudah terdaftar!';
                }else{
                    //id baru
                    $status = "daftar";
                    $sql = "INSERT INTO hologramBot_user(id_user,id_card,first_name,last_name,username,timestamp) VALUES ('$user_id','$card_id','$first_name','$last_name','$username','$timestamp')";
                    if (!mysqli_query($conn,$sql)){            
                        $pesan = 'Terjadi Kesalahan pendaftaran user!';
        
                    }else{
                        // $last_id = mysqli_insert_id($conn);
                        // // sendRegisterLink($last_id);
                        // $id_query = "";
                        // $time_query = "";
                        // $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE no_user='".$last_id."'");
                        // if (mysqli_num_rows($check_user) > 0) {
                        //     //id dikenali
                        //     while($row = mysqli_fetch_assoc($check_user)) {
                        //         $id_query = $row['id_user'];
                        //         $time_query = $row['timestamp'];                            
                        //     }
                
                        //     $daftar_url = "https://makassarrobotics.000webhostapp.com/hologramBot/daftar.php?id=".$id_query."&token=".$time_query;
                        //     $pesan = "Isi data kamu pada link berikut :".PHP_EOL.$daftar_url;
                            
                    
                        // }else{
                        //     //id tidak dikenali
                        //     $pesan = 'Terjadi Kesalahan pengiriman URL pendaftaran.';            
                                      
                        // }
                        $pesan = 'Pendaftaran berhasil!';
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