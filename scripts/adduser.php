<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="@IZ">
  <link rel="shortcut icon" href="http://10.109.87.10:8080/img/WFPico.ico" />

  <title>Chad AP v1.1 - Sign UP</title>

  <!-- Custom fonts for this template-->
  <link href="http://10.109.87.10:8080/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="http://10.109.87.10:8080/vendor/fontawesome-free/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://10.109.87.10:8080/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="http://10.109.87.10:8080/vendor/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
  
  <!-- Custom styles for this template-->
  <link href="http://10.109.87.10:8080/css/iz-admin-2.min.css" rel="stylesheet">
  
  <style type="text/css"> .btn3{ width:180px; } </style>
  
</head>

<body id="page-top">

    <!-- Page Wrapper -->
  <div id="wrapper" >

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
     <img src="http://10.109.87.10:8080/img/WFP-0000014687.png" width="225" height="90" alt="Logo WFP">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
			ChadAP v1.1.IZ &copy; WFP CO CHAD, 2020</strong>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
		  
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
			 <a class="nav-link" href="http://10.109.87.10:8080/index.php">
				<i class="fas fa-fw fa-sign-in-alt"></i>
				<span>Log in</span>
			 </a>
		  </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-user-plus fa-fw"></i> Nouvel Utilisateur</h1>

          <div class="row">
		    <div class="col-lg-12">
              <form class="form-horizontal" name="formulaire" action="add2user.php" method="post">
			    <div class="form-group row">
				  <label class="control-label col-sm-3" for="nom">Nom :</label>
				  <div class="col-sm-4">
					<input type="text" id="nom" name="nom" placeholder="Entrer nom" class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="pnom">Pr&eacute;nom :</label>
				  <div class="col-sm-4">
					<input type="text" id="pnom" name="pnom" placeholder="Entrer le prenom" class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="pseudo">Pseudo :</label>
				  <div class="col-sm-4">
					<input type="text" id="pseudo" name="pseudo" placeholder="Entrer un pseudo" class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="email">Email :</label>
				  <div class="col-sm-4">
					<input type="text" id="email" name="email"  class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="tel">T&eacute;l&eacute;phone :</label>
				  <div class="col-sm-4">
					<input type="text" id="tel" name="tel" placeholder="Votre numero Tel" class="form-control" required />
				  </div>
				</div>
					
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="mdp">Mot de passe :</label>
				  <div class="col-sm-4">
				    <input type="password" id="mdp" name="mdp" placeholder="Entrer un mot de passe" class="form-control" autocomplete="off" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="mdp2">Confirmer :</label>
				  <div class="col-sm-4">
					<input type="password" id="mdp2" name="mdp2" placeholder="Confirmer password" class="form-control" autocomplete="off" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="office">Bureau :</label>
				  <div class="col-sm-4">
					<select class="form-control" id="office" name="office" >
					  <option>Choisir...</option>
					  <?php
						include('connexion.php');
						$sqlb 	= "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ORDER BY goffu_type " ;
						$requeteb = $mysqli->query( $sqlb ) ;

						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['goffu_type']." ".$resultb['goffu_offlieu']."</option>");
						}				
					  ?>
					</select>
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="service">Unit&eacute; :</label>
				  <div class="col-sm-4">
					<select class="form-control" id="service" name="service" >
					  <option>Choisir...</option>
					  <?php
									include('connexion.php');
						$sqlb 	= "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type='UNITE' ORDER BY goffu_nom " ;
						$requeteb = $mysqli->query( $sqlb ) ;

						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['goffu_nom']."</option>");
						}				
					  ?>
					</select>
				  </div>
				</div>
				
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-12">
					<button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
					<button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
				  </div>
				</div>
			  </form>
            </div>
		  </div>
          <!-- /.row -->
            
		</div>
        <!-- /.container-fluid -->	
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

</body>

</html>
