<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <title>Daftar | HOLOGRAM</title>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container">
        <?php
            if(isset($_GET['id']) && isset($_GET['token'])) {
                include 'db_access.php';
                $user_id = $_GET['id'];
                $timestamp = $_GET['token'];

                // echo $user_id.PHP_EOL.$timestamp;
                
                $check_user = mysqli_query($conn,"SELECT * FROM hologramBot_user WHERE id_user='".$user_id."' AND timestamp='".$timestamp."' order by no_user asc limit 1");
                if (mysqli_num_rows($check_user) > 0) {
                    //id dikenali                                    
                                                                
        ?> 

        <?php
            $card_id = '';
            $first_name = '';
            $last_name = '';
            $nickname = '';
            $username = '';
            $pekerjaan = '';
            $instansi = '';
            $email = '';
            $no_hp = '';
            $alamat = '';
            while($row = mysqli_fetch_assoc($check_user)) {
                $card_id = $row['id_card'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $nickname = $row['nickname'];
                $username = $row['username'];
                $pekerjaan = $row['pekerjaan'];
                $instansi = $row['instansi'];
                $email = $row['email'];
                $no_hp = $row['no_hp'];
                $alamat = $row['alamat'];                          
            }
        ?>
                            
                           
        <!-- Page Content goes here -->
            <div class="row">
                <div class="col s12">
                    <h5>Form Pendaftaran Member HOLOGRAM</h5>
                    <form style="margin-top: 20px;" id="daftarForm" action="db_command.php" method="POST">
                      <input type="hidden" name="action" value="daftar">
                      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                      <input type="hidden" name="time_id" value="<?php echo $timestamp; ?>">
                      <div class="row">
                         <div class="input-field col s12 m6">
                             <input class="daftar" type="text" name="first_name" id="namadepan_text" value="<?php echo $first_name; ?>" required>
                             <label for="namadepan_text">Nama Depan</label>
                         </div>
                         <div class="input-field col s12 m6">
                            <input class="daftar" type="text" name="last_name" id="namabelakang_text" value="<?php echo $last_name; ?>" required>
                            <label for="namabelakang_text">Nama Belakang</label>
                        </div>
                         <div class="input-field col s12 m6">
                             <input class="daftar" type="text" name="nickname" id="nickname_text" value="<?php echo $nickname; ?>" required>
                             <label for="nickname_text">Nama Panggilan</label>
                         </div>
                         <div class="input-field col s12 m6">
                            <input class="daftar" type="text" name="username" id="username_text" value="<?php echo $username; ?>" required>
                            <label for="username_text">Username Telegram (tanpa @)</label>
                        </div>                                
                         <div class="input-field col s12 m6">
                             <input class="daftar" type="text" name="pekerjaan" id="job_text" value="<?php echo $pekerjaan; ?>" required>
                             <label for="job_text">Pekerjaan</label>
                         </div>
                         <div class="input-field col s12 m6">
                             <input class="daftar" type="text" name="instansi" id="instansi_text" value="<?php echo $instansi; ?>">
                             <label for="instansi_text">Instansi (sesuai Pekerjaan)</label>
                         </div>
                         <div class="input-field col s12 m6">
                              <input class="daftar" type="email" name="email" id="email_text" value="<?php echo $email; ?>" required>
                              <label for="email_text">Email</label>
                          </div>
                          <div class="input-field col s12 m6">
                            <input class="daftar" type="tel" name="no_hp" id="hp_text" value="<?php echo $no_hp; ?>" required>
                            <label for="hp_text">Nomor Handphone</label>
                          </div> 
                          <div class="input-field col s12">
                             <input class="daftar" type="text" name="alamat" id="job_text" value="<?php echo $alamat; ?>" required>
                             <label for="job_text">Alamat</label>
                         </div>                        
                      </div>                                                                                  
                   
                    <button id="daftar_btn" class="btn blue left waves-effect waves-light">Daftar</button>
                   </form>                                         
                </div>
            </div>
         

    <?php
            }else{
                echo '<h5 class="center-align" style="margin-top: 60px;">User tidak dikenali!</h5>';
            }         
        }else{
            echo '<h5 class="center-align" style="margin-top: 60px;">Link tidak tervalidasi!</h5>';
        }
    ?> 
        </div>  
   <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
