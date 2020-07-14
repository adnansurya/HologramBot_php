<?php

    include 'db_access.php';
    include 'global.php';

    $chat_id = $hologram_id;
    // $chat_id = $adnan_id;

    $sql = "";
    $status = "";
    $identity = "";
    $response = "";

   
    if(isset($_POST['card'])) {
        $card_id = $_POST['card'];
        $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_card='" .$card_id."' order by id_acc asc limit 1");
        $check_hadir = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE id_card='" .$card_id."'");
        if($check_user){
            if (mysqli_num_rows($check_user) > 0) {
                //id dikenali
                while($row = mysqli_fetch_assoc($check_user)) {
                    $identity = $row['first_name']." ".$row['last_name']." (@".$row['username'].")";            
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
                $response = 'ERROR';
            }

        }else{
            $pesan = 'Error Check User';
        }
       
        
        sendMessage($chat_id,  $pesan, $token);
        echo $response;
        

        if($status != "" && $card_id != ""){
            $sql = "INSERT INTO hologramBot_log(id_card,status,waktu) VALUES ('$card_id','$status','$waktu')";
            if (!mysqli_query($conn,$sql)){            
                $pesan = 'Terjadi Kesalahan penulisan log';
                sendMessage($chat_id, $pesan, $token);
                echo $pesan;
            }
        }

        
    }else{
        echo "Link tidak tervalidasi!";
    }
?>