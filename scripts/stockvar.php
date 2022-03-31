<?php
/**
* @author Zaki IZZO <izzo.z@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	/*if ($profil != "AdminSTOCK")
	{
		header('Location:accueil.php');
	}*/
	
	include("inc/taarikh.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="@IZ">
  <link rel="shortcut icon" href="../img/WFPico.ico" />

  <title>Chad AP v1.1</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/fontawesome-free/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="../vendor/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
  
  <!-- Custom styles for this template-->
  <link href="../css/iz-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <script type="text/javascript" src="DataTables/media/js/jquery.js"></script>
  <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.min.js"></script>
   <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script>
	$(document).ready(function() {
		$('#example').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "servervar_processing.php"	
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
			<h1 class="h3 mb-0 text-gray-800"> Variations du stock</h1>
			  <a href="stockadd.php" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fa fa-exchange fa-sm text-white-75"></i> Entr&eacute;e / Sortie du Stock</a>			
		  </div>
		<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-12">
		<div class="card shadow mb-4">
          <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">R&eacute;capitulatif des Entr&eacute;es / Sorties</h6>
          </div>
          <div class="card-body">
			<div class="table-responsive">
              <table class="table table-bordered" width="100%" id="example">   
				<thead>
				  <tr>
					<th>Item Description</th>
					<th>Nombre</th>
					<th>Sens</th>
					<th>Remarque</th>
					<th>Date</th>
				  </tr>
				</thead>
				<tfoot>
				  <tr>
					<th>Item Description</th>
					<th>Nombre</th>
					<th>Sens</th>
					<th>Remarque</th>
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

		</div>
        <!-- /.container-fluid -->	
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>
