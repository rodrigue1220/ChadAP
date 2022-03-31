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
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	if ($_GET["id"] == "")
	{
		header('Location:rechctorh.php');
	}
	
	$pivot	= $_GET["id"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
	include("inc/fonctionscalcul.php");
	//include("inc/fonctionscalc.php");	
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de la demande HS n&deg; <font color="red"><i><?php echo $_GET["id"];?></i></font></h1>
	</div>
    <hr />   

	<!-- Content Row -->
    <div class="row">
	  <?php			
		
		$sql	 = "SELECT * FROM wfp_chd_djmcto WHERE cto_id='$pivot'" ;
		$requete = $mysqli->query( $sql ) ;
		$result  = $requete->fetch_assoc(); 
		$nopers	 = $result['cto_index'];
				
		$sqlt 		= "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$nopers' " ;
		$requetet	= $mysqli->query( $sqlt );
		$resultt	= $requetet->fetch_assoc();
		$nom		= $resultt["rh_lname"];
		$prenom 	= $resultt["rh_fname"];
										
		echo("<div class=\"col-lg-auto\">
			<div class=\"table-responsive\">");			

		echo("<table class=\"table table-striped table-bordered table-hover\"><tbody>");
		echo("<tr><th>Demandeur</th><td>".$nom." ".$prenom."</td></tr>
		<tr><th>Cr&eacute;&eacute;e le</th><td>".date("d.m.Y H:m:s",strtotime($result['cto_date']))."</td></tr>
		<tr><th>Date et heure pr&eacute;vues</th><td> le <b>".date("d.m.Y",strtotime($result['cto_deb']))."</b> de <b>".$result['cto_hdeb']."</b> &agrave; <b>".$result['cto_hfin']."</b></td></tr>
		<tr><th>Date et heure effectives</th><td> le <b>".date("d.m.Y",strtotime($result['cto_deb2']))."</b> de <b>".$result['cto_hdeb2']."</b> &agrave; <b>".$result['cto_hfin2']."</b></td></tr>
		<tr><th>Dur&eacute;e</th><td><b>".$result['cto_dure']."</b></td></tr>
		<tr><th>Choix compens</th><td><b>".$result['cto_choix']."</b></td></tr>
		<tr><th>Raison / Motif</th><td><b>".$result['cto_raison']."</b></td></tr>
		<tr><th>Approbateur</th><td><b>".$result['cto_approver']."</b></td></tr>
		<tr><th>Statut</th><td><b>".$result['cto_statut']."</b></td></tr>");
				
		if($result['cto_statut'] == "CERTIFIE")
		{
			echo("<tr><th>Date Approbation</th><td><b>".date("d.m.Y H:m:s",strtotime($result['cto_dapprover']))."</b></td></tr>
				<tr><th>Date Certification</th><td><b>".date("d.m.Y H:m:s",strtotime($result['cto_dapprover2']))."</b></td></tr>");
		}
		if($result['cto_statut'] == "APPROUVE" OR $result['cto_statut'] == "EFFECTUE")
		{
			echo("<tr><th>Date Approbation</th><td><b>".date("d.m.Y H:m:s",strtotime($result['cto_dapprover']))."</b></td></tr>");
		}						
		if($result['cto_statut'] == "REJET")
		{
			echo("<tr><th>Date Rejet</th><td><b>".date("d.m.Y H:m:s",strtotime($result['cto_dapprover']))."</b></td></tr>");
			echo("<tr><th>Motif Rejet</th><td><b>".$result['cto_lib']."</b></td></tr>");
		}						
						
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
