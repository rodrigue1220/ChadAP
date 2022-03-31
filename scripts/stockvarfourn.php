<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nom = $result["nom"];
	$prenom = $result["prenom"];
	$prof2 = $result["profil2"];
	$unite = $result["unite"];
		
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if (($prof2!="AdminSU" AND $unite!="ADMIN-FINANCE/CO NDJAMENA") AND $profil!="AdminFOURN")
	{
		header('Location:accueil.php');
	}
	
	include("inc/taarikh.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
    <meta name="author" content="@IZ">

    <title>Chad AP v1.1</title>

	<link rel="shortcut icon" href="http://10.109.87.10:8080/img/WFPico.ico" />
<!-- Custom fonts for this template-->
  <link href="http://10.109.87.10:8080/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="http://10.109.87.10:8080/vendor/fontawesome-free/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://10.109.87.10:8080/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="http://10.109.87.10:8080/vendor/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
  
  <!-- Custom styles for this template-->
  <link href="http://10.109.87.10:8080/css/iz-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <script type="text/javascript" src="http://10.109.87.10:8080/scripts/DataTables/media/js/jquery.js"></script>
  <script type="text/javascript" src="http://10.109.87.10:8080/scripts/DataTables/media/js/jquery.dataTables.min.js"></script>
   <link href="http://10.109.87.10:8080/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script>
	$(document).ready(function() {
		$('#example').DataTable( {
			"processing": true,
			"serverSide": true,
			"pageLength": 3,
			"ajax": "serverfourn_processing.php",
			"language": {
				"url": "http://10.109.87.10:8080/vendor/font-awesome/css/French.json"
			}
		} );	
	} );		
  </script>	
  <style type="text/css"> .btn3{ width:180px; } </style>

</head>
<body id="page-top">

  <!-- Page Wrapper --> 
  <div id="wrapper">

    <!-- Sidebar -->
		<?php include_once('inc/botoune.php'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Topbar -->
		<?php include_once('inc/topbar.php'); ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fa fa-bar-chart fa-fw"></i> Variations du stock</h1>
			<a href="geststockfourn.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-cart-arrow-down fa-sm text-white-75"></i> Stock Disponible</a>
		<?php
			
			$mois	= date('Y-m', strtotime('-1 month'));

			include("exportrapfourn.php");
				
			if($profil=="AdminFOURN" && $prof2!="AdminSU")
			{
				echo ("<a href=\"stockaddsortfourn.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm\"><i class=\"fa fa-exchange fa-sm text-white-75\"></i> E/S du Stock</a>");
			}
			
		?>
	</div> 
	<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-12">
		<div class="card shadow mb-4">
          <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">R&eacute;capitulatif des Entr&eacute;es / Sorties</h6>			
          </div>
		  <?php
			echo("<a href=\"Rapport_Variations_Fourn-".$mois.".csv\" class=\"d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm\"><i class=\"fa fa-download fa-sm text-black-75\"></i> T&eacute;l&eacute;charger RECAP E/S en CSV | <b>".$mois."</b> <i class=\"fa fa-download fa-sm text-black-75\"></i></a>");
		  ?>
          <div class="card-body">
			<div class="table-responsive">
              <table class="table table-bordered" width="100%" id="example">   
				<thead>
				  <tr>
					<th>#</th>
					<th>Ref.</th>
					<th>Item Description</th>
					<th>Nombre</th>
					<th>Sens</th>
					<th>Date</th>
				  </tr>
				</thead>
				<tfoot>
				  <tr>
					<th>#</th>
					<th>Ref.</th>
					<th>Item Description</th>
					<th>Nombre</th>
					<th>Sens</th>
					<th>Date</th>
				  </tr>
				</tfoot>
			  </table>
			 </div>  
          </div>
		</div>
	  </div>
	</div>
	<!-- /.row -->
	
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

		</div>
        <!-- /.container-fluid -->	
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="http://10.109.87.10:8080/scripts/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
