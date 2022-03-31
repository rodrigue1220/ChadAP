<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminLOGSTK")
	{
		header('Location:simple.php');
	}
	
	$id 	= $_GET["id"];
	if ($id == "")
	{
		header('Location:logstktransit.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de l'enregistrement n&deg; <font color="red"><i><?php echo $_GET["id"];?></i></font></h1>
	</div>
    <hr />   

	<!-- Content Row -->
    <div class="row">
		<?php	

			$sql 	 = "SELECT * FROM wfp_chd_logtransit WHERE logt_id='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result  = $requete->fetch_assoc(); 
			
			$wareho	 = $result['logt_destiwh'];
			$loc	 = $mysqli->query("SELECT logc_lib AS LOC FROM wfp_chd_logconf WHERE logc_nom='$wareho'")->fetch_array();
			$lieu	 = $loc["LOC"];
	
	
			echo("<div class=\"col-lg-auto\">
					<div class=\"table-responsive\">");			

			echo("<table class=\"table table-striped table-bordered table-hover\"><tbody>
				<tr><th>Sub-office</th><td>".$lieu."</td></tr>
				<tr><th>Origine</th><td>".$result['logt_orig']."</td></tr>
				<tr><th>Destination WH</th><td>".$result['logt_destiwh']."</td></tr>
				<tr><th>Comm. Desc.</th><td>".$result['logt_desc']."</td></tr>
				<tr><th>Batch</th><td>".$result['logt_batch']."</td></tr>
				<tr><th>WBS</th><td>".$result['logt_wbs']."</td></tr>
				<tr><th>Grant Code</th><td>".$result['logt_grantnum']."</td></tr>
				<tr><th>Grant Desc.</th><td>".$result['logt_grantdesc']."</td></tr>
				<tr><th>BBD</th><td>".$result['logt_bbd']."</td></tr>
				<tr><th>Net Delivery</th><td>".$result['logt_netdeliv']."</td></tr>
				<tr><th>TDD Grant</th><td>".$result['logt_tddgrant']."</td></tr>");
										
			echo("</tbody></table>");
			echo("</div><!-- /.table-responsive --></div>");
		?>
			
</div>
	<!-- /.row -->
		</div>
        <!-- /.container-fluid -->
		
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

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
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
