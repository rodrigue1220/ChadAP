<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}
	
	$id		= $_GET["ide"];
	$page	= $_GET["page"];
	
	$sql	= "SELECT * FROM wfp_chd_cargo WHERE cargo_id='$id'" ;
	$requete= $mysqli->query( $sql ) ;
	$result = $requete->fetch_assoc(); 
	$ref	= $result['cargo_number'];
	$dchrge = date("d.m.Y", strtotime($result['cargo_dcharge']));
	$hchrge = $result['cargo_hcharge'];
	$ddchge = date("d.m.Y", strtotime($result['cargo_ddcharge']));
	$hdchge = $result['cargo_hdcharge'];
	$droute = date("d.m.Y", strtotime($result['cargo_droute']));
	$hroute = $result['cargo_hroute'];
	
	$wasac	= $dchrge." ".$hchrge;
	$wasad	= $ddchge." ".$hdchge;
	$wasar	= $droute." ".$hroute;
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de la Cargaison n&deg; <font color="red"><i><?php echo $ref;?></i></font></h1>
	   <a href="gestcharge.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>
	</div>
    <hr />   

	<!-- Content Row -->
    <div class="row">
	  <div class="col-lg-10">
		<div class="table-responsive">			
		  <table class="table table-striped table-bordered table-hover"><tbody>
	 
	 <?php		
		$sql	= "SELECT * FROM wfp_chd_cargo WHERE cargo_id='$id'" ;
		$requete= $mysqli->query( $sql ) ;
		$result = $requete->fetch_assoc(); 
		echo("<tr><th>Demandeur</th><td>".$result['cargo_dem']."</td></tr>
		<tr><th>Cr&eacute;&eacute;e le</th><td>".date("d.m.Y H:i:s",strtotime($result['cargo_date']))."</td></tr>
		<tr><th>Demandeur</th><td>".$result['cargo_dem']."</td></tr>
		<tr><th>Origine</th><td><b>".$result['cargo_depart']."</b></td></tr>
		<tr><th>Destination</th><td><b>".$result['cargo_desti']."</b></td></tr>
		<tr><th>V&eacute;hicule</th><td><b>".$result['cargo_vehi']."</b></td></tr>
		<tr><th>Driver</th><td><b>".$result['cargo_chauf']."</b></td></tr>
		<tr><th>Nature</th><td><b>".$result['cargo_nat']."</b></td></tr>
		<tr><th>Tonnage</th><td><b>".$result['cargo_tonne']."</b></td></tr>
		<tr><th>Statut</th><td><b>".$result['cargo_state']."</b></td></tr>
		<tr><th>OIC Log.</th><td><b>".$result['cargo_officer']."</b></td></tr>
		<tr><th>Date OIC Log.</th><td>".date("d.m.Y H:i:s",strtotime($result['cargo_daction']))."</td></tr>
		<tr><th>Date Chargement</th><td>".$wasac."</td></tr>
		<tr><th>Date de Mise en Route</th><td>".$wasar."</td></tr>
		<tr><th>Date D&eacute;chargement</th><td>".$wasad."</td></tr>");
			
		echo("</tbody></table></div></div>");
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
