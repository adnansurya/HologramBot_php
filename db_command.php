<?php
    if(isset($_POST['user_id']) && isset($_POST['time_id']) && isset($_POST['action'])) {
        include 'db_access.php';
        include 'global.php';

        
       

        $user_id = $_POST['user_id'];
        $timestamp = $_POST['time_id'];
        $action = $_POST['action'];

        $chat_id = $user_id;

        // echo $user_id.PHP_EOL.$timestamp;
        $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_user='".$user_id."' AND timestamp='".$timestamp."' order by no_user asc limit 1");
        if (mysqli_num_rows($check_user) > 0) {
            //id dikenali 

            if($action === 'daftar'){
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $nickname = $_POST['nickname'];
                $username = $_POST['username'];
                $pekerjaan = $_POST['pekerjaan'];
                $instansi = $_POST['instansi'];
                $email = $_POST['email'];
                $no_hp = $_POST['no_hp'];
                $alamat = $_POST['alamat'];
                
                $sql = "UPDATE hologramBot_user SET  
                    first_name = '".$first_name."',  
                    last_name = '".$last_name."', 
                    nickname = '".$nickname."' ,  
                    username = '".$username."' ,  
                    pekerjaan = '".$pekerjaan."',  
                    instansi = '".$instansi."', 
                    email = '".$email."', 
                    no_hp = '".$no_hp."', 
                    alamat = '".$alamat."'   
                    WHERE id_user='" .$user_id. "' AND timestamp='".$timestamp."'";
                
                $pesan = '';
                if (!mysqli_query($conn,$sql)){                               
                    $pesan = 'Terjadi kesalahan pada Pendaftaran';
                    echo $pesan;
                }else{
                    echo 'Pendaftaran Berhasil, silahkan tutup halaman ini dan gunakan kartu.';
                    $pesan = 'Pendaftaran Berhasil, silahkan gunakan kartu.';
                }
                sendMessage($chat_id, $pesan, $token);          

            }else{
                echo 'Aksi tidak dikenali!';
            } 
            
        }else{
            echo 'User tidak dikenali!';  
        }
               
       
    }else{
        echo 'Link tidak tervalidasi!';
    }                                                   
?> 