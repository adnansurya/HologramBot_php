<?php
    include 'db_access.php';
    include 'global.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hologram Bot - Log Book</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/r-2.2.5/datatables.min.css"/>
 


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Hologram Bot</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>        
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Log Book</h1>
        <p class="lead">Siapa saja yang pernah ke Ambeso?</p>        
	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr> 
                        <th>No</th>
			<th>Waktu</th>	                                               
                        <th>Nama</th>
                        <th>Username</th>                                               
                        <th>Status</th>
                    </tr>
                </thead>                                        
                <tbody>
                <?php                                            
                    $load = mysqli_query($conn, "SELECT hologramBot_log.id_log, hologramBot_log.status, hologramBot_log.waktu, 
			hologramBot_user.first_name, hologramBot_user.last_name, hologramBot_user.username 
			FROM `hologramBot_log`, hologramBot_user 
			WHERE hologramBot_user.id_card=hologramBot_log.id_card GROUP BY id_log");   
                    while ($row = mysqli_fetch_array($load)){
		            echo '<tr>';
		                echo '<td>'.$row['id_log'].'</td>';
		                echo '<td>'.$row['waktu'].'</td>';
		                echo '<td>'.$row['first_name'].' '.$row['last_name'].'</td>';
		                echo '<td>@'.$row['username'].'</td>';
		                echo '<td>'.$row['status'].'</td>';                                           
		            echo '</tr>';
                    }                      
                ?>                                           
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/r-2.2.5/datatables.min.js"></script>
  <script>
	$(document).ready( function () {
	    $('#dataTable').DataTable({
		"responsive" : true,
		"order": [[ 0, "desc" ]],
		"pageLength": 25
	    });
	} );
  </script>

</body>

</html>
