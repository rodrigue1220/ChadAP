<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	include('connexion.php');
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

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
		$('#example2').DataTable( {
			"processing": true,
			"serverSide": true,
			"pageLength": 3,
			"ajax": "serverasktrt_processing.php",
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
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-thumbs-up fa-fw"></i> Mes Demandes Trait&eacute;es</h1>
	</div> 
	<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-12">
		<div class="card shadow mb-4">
          <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste des articles des demandes d'&eacute;quipements / fournitures </h6>
          </div>
          <div class="card-body">
			<div class="table-responsive">
              <table class="table table-bordered" width="100%" id="example2">   
				<thead>
					<tr>
						<th>#</th>
						<th>Demande</th>
						<th>Item Description</th>
						<th>Qtt&eacute;</th>
						<th>Enregistr&eacute;e le</th>
						<th>Trait&eacute;e le</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Demande</th>
						<th>Item Description</th>
						<th>Qtt&eacute;</th>
						<th>Enregistr&eacute;e le</th>
						<th>Trait&eacute;e le</th>
					</tr>
				</tfoot>
			  </table>
			</div>  
          </div>
		</div>
	  </div>
    </div>
	<!-- /.row -->
	<hr />
	<div class="row-lg-auto">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liste des demandes de SDR </h6>
          </div>
								
		<?php
			echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");
			  
			$i=1;
			$exis = $mysqli->query("SELECT reqsdr_id AS ID FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE'")->fetch_array();
						
			if($exis['ID'] != 0)
			{
				$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' " ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>#</th>
					<th>Raison</th>
					<th>Salle</th>
					<th>Du</th>
					<th>Au</th>
					<th>Pause-caf&eacute;</th>
					<th>Multim&eacute;dia</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					echo("<tbody><tr><td>".$i."</td>");
					echo("<td>".$result['reqsdr_raison']."</td>");
					echo("<td>".$result['reqsdr_salle']."</td>");	
					echo("<td>".$result['reqsdr_deb']." ".$result['reqsdr_horaire1']."</td>");
					echo("<td>".$result['reqsdr_fin']." ".$result['reqsdr_horaire2']."</td>");
					echo("<td>".$result['reqsdr_pc']."</td>
						<td>".$result['reqsdr_mmedia']."</td></tr>");

					$i++;
				}
			}
			else
			{
				echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de SDR approuv&eacute;e...</div>") ;		
			}
		?>
		</tbody></table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card shadow -->
	</div>
	<!--row -->
	
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