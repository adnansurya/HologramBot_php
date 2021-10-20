<?php

    include 'global.php';
    include 'ported_db.php';
    echo 'ported_hook.php';
       

    $getter = file_get_contents("php://input");

    $update = json_decode($getter, TRUE);

    $chat_id = $update["message"]["chat"]["id"];
    $message_id = $update["message"]["message_id"];
    $message = $update["message"]["text"];
    $sticker = $update["message"]["sticker"];
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
    if(getComm($message, '/calibrate')){           
        $check = mysqli_query($conn,"SELECT hologramBot_user.username, hologramBot_user.first_name, hologramBot_user.last_name, hologramBot_hadir.waktu FROM hologramBot_hadir INNER JOIN hologramBot_user ON hologramBot_user.id_card = hologramBot_hadir.id_card");
        if (mysqli_num_rows($check) > 0) {
            $pesan = 'Sini, nongkrong bareng :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $nomor++;
                $waktu_split = explode(" ", $row['waktu']);                                
                $satu = $nomor . '. '. $row['first_name'] .' '. $row['last_name'] .' (@'. $row['username'] . ') dari jam '. $waktu_split[1].' WITA'.PHP_EOL;
                $pesan = $pesan.$satu; 
            }
        }else {
            $pesan = 'Belum ada orang di Ambeso.';
        }
    }elseif(getComm($message, '/admin')){  
        $subcomm = substr($message, 7);
        if($user_id != $adnan_id){
            $pesan = 'Maaf kak, command itu hanya untuk admin :)';
        }else{
           
            $msg_data = $subcomm;
            $pesan = "ADMIN : ". $msg_data;
            $send_id = $hologram_id;
            if(!$debugMode){
                sendMessage($send_id, $pesan, $token);
            }
           
            
            
        }        
    }elseif(getComm($message, '/daftar')){            
        if($chat_id !== $user_id){
            if($chat_id === $hologram_id || getComm($message, '/daftar@hologrambeso_bot')){
                $pesan = 'Untuk mendaftar, chat (PC) saya dengan format:'.PHP_EOL.'/daftar <id_kartu>' .PHP_EOL.PHP_EOL.'PENTING: Jangan mendaftar dengan sembarang id_kartu!';
                
            }else{
                $pesan = 'Gunakan HologramBot hanya pada Grup HOLOGRAM!';
            }
                      
        }else{                                      
            if (checkMember($user_id)) {
                //id dikenali                        
                $pesan = 'User sudah terdaftar!';                               
            }else{
                //id baru
                $status = "daftar";                                
                if (!newMember($user_id, "", $first_name, $last_name, $username, "", $timestamp, 0)){            
                    $pesan = 'Terjadi Kesalahan pendaftaran user!';    
                }else{                    
                    $pesan = 'Pendaftaran berhasil!';
                }                               
            }      
        }                
    }

    if($pesan != ""){
        if($debugMode){
            sendMessage($adnan_id, $pesan, $token);
        }else{
            sendMessage($chat_id, $pesan, $token);
        }
        
    }
    

?>