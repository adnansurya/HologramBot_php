<?php

    include 'db_access.php';
    include 'global.php';

    $chat_id = $hologram_id;
    // $chat_id = $adnan_id;

    $sql = "";
    $status = "";
    $identity = "";
    $tone_data = "unknown";
    $response = "";
    $resObj = new \stdClass();
    $resObj -> result = "";

   
    if(isset($_POST['card'])) {
        $card_id = $_POST['card'];
        $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_card='" .$card_id."' order by id_acc asc limit 1");
        $check_hadir = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE id_card='" .$card_id."'");
        if($check_user){
            if (mysqli_num_rows($check_user) > 0) {
                //id dikenali
                while($row = mysqli_fetch_assoc($check_user)) {
                    $identity = $row['first_name']." ".$row['last_name']." (@".$row['username'].")";  
                    $get_tone = mysqli_query($conn,"SELECT * FROM hologramBot_tone WHERE id_ringtone=". $row['ringtone']);
                    if($get_tone){
                        $tone_data = mysqli_fetch_assoc($get_tone);   
                    }else{
                        $tone_data = "unknown";
                    }
                          
                }
    
                $check_hadir = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE id_card='" .$card_id."'");
                if($check_hadir){
                    if (mysqli_num_rows($check_hadir) > 0) {
                        //id sudah hadir
                      
                        $sql = "DELETE FROM hologramBot_hadir WHERE id_card='" .$card_id. "'";
                        if (!mysqli_query($conn,$sql)){            
                            $pesan = 'Terjadi Kesalahan pada database kehadiran';
                            $response = 'ERROR';
                        }else{
                            $pesan = $identity." telah meninggalkan Ambeso.";
                            $response = 'KELUAR';
                        }
                        $status = "keluar";
                    }else{
                        //id belum hadir
                       
                        $sql = "INSERT INTO hologramBot_hadir(id_card,waktu) VALUES ('$card_id','$waktu')";
                        
                        if (!mysqli_query($conn,$sql)){            
                            $pesan = 'Terjadi Kesalahan pada database kehadiran';
                            $response = 'ERROR';
                        }else{
                            $pesan = $identity." sedang berada di Ambeso.";
                            $response = 'HADIR';
                        }
                        $status = "hadir";
                    }
                }else{
                    $pesan = 'Error Check Hadir';
                }
                                
               
            }else{
                //id tidak dikenali
                
                sendMessage($adnan_id,  "Id Kartu : ", $token);
                sendMessage($adnan_id,  $card_id, $token);
                $pesan = "Orang tak dikenal sedang berada di Ambeso.";
                $response = 'UNKNOWN';
            }

        }else{
            $pesan = 'Error Check User';
        }
       
        
        sendMessage($chat_id,  $pesan, $token);
        $resObj -> result = $response;
        $resObj -> msg = $pesan;
        $dataObj = new \stdClass();
        $dataObj -> uid = $_POST['card'];
        $dataObj -> tone = $tone_data;
        $resObj -> data = $dataObj;
        echo json_encode($resObj);
        

        if($status != "" && $card_id != ""){
            $sql = "INSERT INTO hologramBot_log(id_card,status,waktu) VALUES ('$card_id','$status','$waktu')";
            if (!mysqli_query($conn,$sql)){            
                $pesan = 'Terjadi Kesalahan penulisan log';
                sendMessage($chat_id, $pesan, $token);
                echo json_encode($resObj);
            }
        }

        
    }else{
        echo "Link tidak tervalidasi!";
    }
?>