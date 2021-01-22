<?php
    include 'db_access.php';
    include 'global.php';
   
    
    // $chat_id = $adnan_id;

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
    if(getComm($message, '/cek')){           
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
    }elseif(getComm($message, '/log')){        
        $check = mysqli_query($conn,"SELECT hologramBot_user.first_name, hologramBot_user.last_name, hologramBot_user.username, hologramBot_log.waktu, hologramBot_log.status FROM hologramBot_log INNER JOIN hologramBot_user ON hologramBot_user.id_card = hologramBot_log.id_card order by hologramBot_log.id_log desc limit 5");
        if (mysqli_num_rows($check) > 0) {
            $pesan = '5 Aktifitas Terakhir :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) {
                $nomor++;
                $satu =  $nomor. '. '. $row['first_name'] .' '. $row['last_name'] .' / @' . $row['username']. PHP_EOL . "  - ". $row['status'] . ' ('. $row['waktu'] . ')'.PHP_EOL ;
                $pesan = $pesan.$satu; 
            }
            $pesan = $pesan.PHP_EOL. 'Selengkapnya :'.PHP_EOL.'https://betaku.000webhostapp.com/hologramBot/';
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
                       
                        $pesan = 'Pendaftaran berhasil!';
                    }
                }
            }
            
            
        }
        
        
    }elseif(getComm($message, '/ringtone')){            
        if($chat_id !== $user_id){
            if($chat_id === $hologram_id || getComm($message, '/ringtone@hologrambeso_bot')){
                $pesan = 'Untuk mengganti ringtone, chat (PC) saya dengan format:'.PHP_EOL.PHP_EOL.
                '/ringtone <id_ringtone>' .PHP_EOL.PHP_EOL;
                $check = mysqli_query($conn,"SELECT * FROM hologramBot_tone");
                if (mysqli_num_rows($check) > 0) {
                    $pesan = $pesan.'ID Ringtone Pack :'. PHP_EOL ;
                    while($row = mysqli_fetch_assoc($check)) {    
                        $satu =  $row['id_ringtone'] .'. '. $row['ringtone_name']. PHP_EOL ;
                        $pesan = $pesan.$satu; 
                    }
                }else {
                    $pesan = 'Pack Ringtone Kosong';
                }
            }else{
                $pesan = 'Gunakan HologramBot hanya pada Grup HOLOGRAM!';
            }            
        }else{
           
            $ringtone_id = substr($message, 10);
            if($ringtone_id == ''){
                $pesan = 'Id Kartu tidak valid!';
            }else{
               
                $check_ringtone= mysqli_query($conn,"SELECT * from hologramBot_tone WHERE id_ringtone = '".$ringtone_id."'");
                if (mysqli_num_rows($check_ringtone) > 0) {
                    //id dikenali   
                    $sql = "UPDATE hologramBot_user SET ringtone = '".$ringtone_id."' WHERE id_user='".$user_id."'";
                    if (!mysqli_query($conn,$sql)){            
                        $pesan = 'Terjadi Kesalahan perubahan ringtone!';
        
                    }else{
                        $pesan = 'Ringtone berhasil diubah!';
                        
                    }                     
                  
                }else{
                    //id baru
                    $pesan = 'ID Ringtone tak dikenali!';
                    
                }
            }
            
            
        }
        
        
    }elseif(getComm($message, '/add_tone')){  
        $subcomm = substr($message, 10);
        if($user_id != $adnan_id){
            $pesan = 'Maaf kak, command itu hanya untuk admin :)';
        }else{
           
            $ringtone_name = $subcomm;
            $sql = "INSERT INTO hologramBot_tone(ringtone_name) VALUES ('$ringtone_name')";
            if (!mysqli_query($conn,$sql)){            
                $pesan = 'Terjadi Kesalahan pendaftaran ringtone!';

            }else{
               
                $pesan = 'Pendaftaran ringtone berhasil!';
            }
            
        }        
    }elseif(getComm($message, '/admin')){  
        $subcomm = substr($message, 7);
        if($user_id != $adnan_id){
            $pesan = 'Maaf kak, command itu hanya untuk admin :)';
        }else{
           
            $msg_data = $subcomm;
            $pesan = "ADMIN : ". $msg_data;
            $send_id = $hologram_id;
            sendMessage($send_id, $pesan, $token);
            
        }        
    }elseif(getComm($message, '/usir')){  
    
        if($user_id != $adnan_id){
            $pesan = 'Maaf kak, command itu hanya untuk admin :)';
        }else{
            $check = mysqli_query($conn,"SELECT hologramBot_hadir.*, hologramBot_user.first_name, hologramBot_user.last_name FROM hologramBot_hadir,hologramBot_user WHERE hologramBot_user.id_card = hologramBot_hadir.id_card");
            if (mysqli_num_rows($check) > 0) {
                $pesan = 'Mengusir paksa orang-orang ini :'.PHP_EOL .PHP_EOL;
                while($row = mysqli_fetch_assoc($check)) {
                    $member_id = $row['id_card'];
                    $sql = "DELETE FROM hologramBot_hadir WHERE id_card='" .$member_id. "'";
                    if (!mysqli_query($conn,$sql)){            
                        $pesan = 'Terjadi Kesalahan pada database kehadiran';  
                    }

                    $satu = '- '.$row['first_name']." ".$row['last_name'].PHP_EOL;                     
                    $pesan = $pesan.$satu; 
                    $status = "keluar";

                    $sql = "INSERT INTO hologramBot_log(id_card,status,waktu) VALUES ('$member_id','$status','$waktu')";
                    if (!mysqli_query($conn,$sql)){            
                        $pesan = 'Terjadi Kesalahan penulisan log';
                        sendMessage($chat_id, $pesan, $token);                       
                    }
                    
                }
            }else {
                $pesan = 'Gagal mengusir, tidak ada orang di Ambeso.';
            }
            
        }        
    }elseif(getComm($message, '/post')){  
        $subcomm = substr($message, 6);
        if($user_id == $adnan_id || $user_id == $akbar_id){
            $msg_data = $subcomm;
            $pesan =  $msg_data.PHP_EOL.PHP_EOL."Author : @".$username;
            $send_id = $hologram_id;
            sendMessage($send_id, $pesan, $token);
        }else{
            $pesan = 'Maaf kak, command itu hanya untuk editor :)';
           
            
        }        
    }elseif(getComm($message, '/add_toxic')){  
        $subcomm = substr($message, 11);
        if($user_id != $adnan_id){
            $pesan = 'Maaf kak, command itu hanya untuk admin :)';
        }else{
            $msg_data = explode(" ", $subcomm);
            $kata = $msg_data[0];
            $toleransi = $msg_data[1];
           
            deleteMessage($chat_id, $message_id, $token);  
            $sql = "INSERT INTO hologramBot_toxic(kata, toleransi) VALUES ('$kata','$toleransi')";
                        
            if (!mysqli_query($conn,$sql)){            
                $pesan = 'Terjadi Kesalahan pada database toxic';        
            }else{
                $pesan = 'Kata Toxic baru berhasil ditambahkan';  
            }
           
           
            
        }        
    }elseif(getComm($message, '/list_toxic')){  
       
        $check = mysqli_query($conn,"SELECT * FROM hologramBot_toxic");
        if (mysqli_num_rows($check) > 0) {
            $pesan = 'List Kata Terlarang :'.PHP_EOL .PHP_EOL;
            while($row = mysqli_fetch_assoc($check)) { 
                
                $kata_kotor = $row['kata'];
                $kata_kotor_len = strlen($kata_kotor);
                $one_kata =  substr_replace($kata_kotor,str_repeat("*",$kata_kotor_len-2), 1, -1) ;      
                $satu =  $row['id']. '. '. $one_kata .PHP_EOL ;
                $pesan = $pesan.$satu; 
            }
            // $pesan = $pesan.PHP_EOL. 'Selengkapnya :'.PHP_EOL.'https://betaku.000webhostapp.com/hologramBot/';
        }else {
            $pesan = 'Kata Terlarang Kosong';
        }
                                  
              
    }else{
        
        // if($chat_id == $hologram_id && $message != ""){
           
        //     $alnum_msg = preg_replace("/[^A-Za-z0-9 ]/", '', $message);
        //     $new_msg = str_replace(" ", "' OR kata LIKE '", trim($alnum_msg." "), $jumlah);
            
        //     $sql_toxic = "SELECT * FROM hologramBot_toxic WHERE kata LIKE '".$new_msg."'";
        //     $check_toxic = mysqli_query($conn,$sql_toxic);
        //     if($check_toxic){
        //         if (mysqli_num_rows($check_toxic) > 0) {
        //             $row = mysqli_fetch_assoc($check_toxic);
        //             $kata_kunci = $row['kata']; 
        //             $toleransi = $row['toleransi'];  
                    
        //             $sql = "INSERT INTO hologramBot_toxicLog(id_user,kata_kunci,kalimat,waktu) VALUES ('$user_id','$kata_kunci','$message','$waktu')";
                    
        //             // $pesan = $getter;
        //             // $pesan = $sql_toxic;
        //             $pesan = "";
        //             if($toleransi == 0){
        //                 $pesan = "Pesan dihapus karena bersifat terlalu toxic atau kasar";
        //                 deleteMessage($chat_id, $message_id, $token);  
        //             }else{
        //                 $pesan = "Sebaiknya gunakan kata yang lebih sopan ya";
        //             }
                         
        //             if (!mysqli_query($conn,$sql)){            
        //                 $pesan = 'Terjadi Kesalahan pada penulisan log database toxic';        
        //             }
        //         }
        //     }else{
        //         $pesan = 'Error Check Toxic';
        //     }
        // }
        
    }
    if($pesan != ""){
        sendMessage($chat_id, $pesan, $token);
    }
    

    if($status != "" && $card_id != ""){
        $sql = "INSERT INTO hologramBot_log(id_card,status,waktu) VALUES ('$card_id','$status','$waktu')";
        if (!mysqli_query($conn,$sql)){            
            $pesan = 'Terjadi Kesalahan penulisan log';
            sendMessage($chat_id, $pesan, $token);
        }
    }
   
    
    
    
    

?>