<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$phone	= $_GET["tel"];
	
	$wakit	= date("YmdHis");
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	$numero	= $mysqli->query("SELECT tel AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phone2	= $numero["num"];
	
	$numer2	= $mysqli->query("SELECT tel2 AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phon2	= $numer2["num"];
	
	if (($profil != "AdminBILLING") && (($phone2 != $phone) && ($phon2 != $phone)))
	{
		header('Location:gouroussphone.php');
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
			"ajax": "serverfactchar_processing.php",
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
			<?php 
				include_once('inc/topbar.php'); 
				include("exportdetbil.php");
			?>
        <!-- End of Topbar -->
		
        <!-- Begin Page Content -->
        <div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails des Appels T&eacute;l&eacute;phoniques et SMS</h1>
			<?php echo("<a href=\"factchahar.php?tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm\" title=\"Mes Factures\"><i class=\"fas fa-newspaper-o fa-sm text-white-75\"></i> MES FACTURES</a>"); ?>
		</div> 
		<hr /> 

		<!--row -->
	<div class="row">
	  <div class="col-lg-12">
		<div class="card shadow mb-4">
          <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste de tous les Appels T&eacute;l&eacute;phoniques et SMS Identifi&eacute;s</h6>			
          </div>
		  
		  <?php echo ("<a href=\"Details_Billing".$phone."-".$wakit.".csv\" class=\"d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm\"><i class=\"fa fa-download fa-sm text-black-75\"></i> T&eacute;l&eacute;charger D&eacute;tails | ".$phone." <i class=\"fa fa-download fa-sm text-black-75\"></i></a>"); ?>								     
          
          <div class="card-body">
			<div class="table-responsive">
              <table class="table table-bordered" width="100%" id="example">   
				<thead>
				  <tr>
					<th>Date et Heure</th>
					<th>Num&eacute;ro App&eacute;l&eacute;</th>					
					<th>Dur&eacute;e</th>
					<th>Type</th>
					<th>Terminaison</th>
					<th>Montant (FCFA)</th>
					<th>OFF/PRIV</th>
					<th>Mois</th>
				  </tr>
				</thead>
				<tfoot>
				  <tr>
					<th>Date et Heure</th>
					<th>Num&eacute;ro App&eacute;l&eacute;</th>
					<th>Dur&eacute;e</th>
					<th>Type</th>
					<th>Terminaison</th>
					<th>Montant (FCFA)</th>
					<th>OFF/PRIV</th>
					<th>Mois</th>
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
  <script src="http://10.109.87.10:8080/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://10.109.87.10:8080/js/demo/chart-area-demo.js"></script>
  <script src="http://10.109.87.10:8080/js/demo/chart-pie-demo.js"></script>
  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>