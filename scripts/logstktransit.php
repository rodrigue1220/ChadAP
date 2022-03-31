<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	include("inc/taarikh.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
    <meta name="author" content="@IZ">

    <title>Chad AP v1.1</title>

	<link rel="shortcut icon" href="../img/WFPico.ico" />
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
			"pageLength": 3,
			"ajax": "serverlogt_processing.php",
			"language": {
				"url": "../vendor/font-awesome/css/French.json"
			}
		} );	
	} );		
  </script>	
  <style type="text/css"> .btn3{ width:150px; } </style>

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
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-line-chart"></i> Chad Stock Report</h1>
		<a href="logstkreport.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fa fa-cart-arrow-down fa-sm text-white-75"></i> In Stock</a>
			
		<?php 
			if ($profil == "AdminLOGSTK")
			{
				echo ("<a href=\"majlogtransreport.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm\"><i class=\"fas fa-spinner fa-sm text-white-75\"></i> Mettre &agrave; jour TR</a>");
				echo ("<a href=\"addlogconfg.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm\"><i class=\"fas fa-plus fa-sm text-white-75\"></i> New WH / Orig</a>");
			}
		?>				
	</div> 
	<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
          <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-fw fa-exchange"></i> In Transit TDCO | <a href="logstktransakhar.php">OTHER</a></h6>
          </div>
		  
		  <?php
			
			$wakit	= date("dmY");
			include("exportlogtransit.php");
			echo("<a href=\"WFP_Chad-ReportTRANSIT-TDCO-".$wakit.".csv\" class=\"d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm\"><i class=\"fa fa-download fa-sm text-black-75\"></i> T&eacute;l&eacute;charger REPORT IN TRANSIT en CSV au | <b>".date("d.m.Y")."</b> <i class=\"fa fa-download fa-sm text-black-75\"></i></a>");
		  ?>							     
      
          <div class="card-body">
			<div class="table-responsive">
              <table class="table table-bordered" width="100%" id="example">   
				<thead>
					<tr>
						<th>Sub-Office</th>
						<th>Origine</th>
						<th>Destination</th>
						<th>WBS</th>
						<th>Comm. Desc.</th>
						<th>Batch</th>
						<th>Grant Code</th>
						<th>Grant Desc.</th>
						<th>BBD</th>
						<th>Net Delivery</th>
						<th>TDD Grant</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Sub-Office</th>
						<th>Origine</th>
						<th>Destination</th>
						<th>WBS</th>
						<th>Comm. Desc.</th>
						<th>Batch</th>
						<th>Grant Code</th>
						<th>Grant Desc.</th>
						<th>BBD</th>
						<th>Net Delivery</th>
						<th>TDD Grant</th>
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
