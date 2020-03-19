<?php

    include 'db_access.php';
    include 'global.php';

    // $chat_id = $hologram_id;
    $chat_id = $adnan_id;

    $sql = "";
    $status = "";
    $identity = "";

   
    if(isset($_POST['card']) && isset($_POST['suhu'])) {
        $card_id = $_POST['card'];
        $suhu = $_POST['suhu'];
        $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_card='" .$card_id."' order by no_user asc limit 1");
        if (mysqli_num_rows($check_user) > 0) {
            //id dikenali
            while($row = mysqli_fetch_assoc($check_user)) {
                $identity = $row['nickname']." (@".$row['username'].")";            
            }

            $check_hadir = mysqli_query($conn,"SELECT * FROM hologramBot_hadir WHERE id_card='" .$card_id."'");
            if (mysqli_num_rows($check_hadir) > 0) {
                //id sudah hadir
              
                $sql = "DELETE FROM hologramBot_hadir WHERE id_card='" .$card_id. "'";
                if (!mysqli_query($conn,$sql)){            
                    $pesan = 'Terjadi Kesalahan pada database kehadiran';
                }else{
                    $pesan = $identity." telah meninggalkan Ambeso.".PHP_EOL."Suhu Tubuh: ".$suhu;
                }
                $status = "keluar";
            }else{
                //id belum hadir
               
                $sql = "INSERT INTO hologramBot_hadir(id_card,suhu,waktu) VALUES ('$card_id','$suhu','$waktu')";
                
                if (!mysqli_query($conn,$sql)){            
                    $pesan = 'Terjadi Kesalahan pada database kehadiran';
                }else{
                    $pesan = $identity." sedang berada di Ambeso.".PHP_EOL."Suhu Tubuh: ".$suhu;
                }
                $status = "hadir";
            }
            echo $sql;
           
        }else{
            //id tidak dikenali
            
            sendMessage($chat_id,  "Id Kartu : ", $token);
            sendMessage($chat_id,  $card_id, $token);
            $pesan = "Orang tak dikenal sedang berada di Ambeso.";
        }
        

       




        sendMessage($chat_id,  $pesan, $token);
        echo $pesan;

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