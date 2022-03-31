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
	
	if ($profil != "AdminSDR")
	{
		header('Location:simple.php');
	}
	
	$id	= $_GET["id"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script language="javascript"> 
	$(document).ready(function () {
    var theHREF;

    $(".confirmModalLink").click(function(e) {
        e.preventDefault();
        theHREF = $(this).attr("href");
        $("#confirmModal").modal("show");
    });

    $("#confirmModalNo").click(function(e) {
        $("#confirmModal").modal("hide");
    });

    $("#confirmModalYes").click(function(e) {
        window.location.href = theHREF;
    });
});
</script>
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de demande SDR n&deg; <?php echo $id; ?></h1>
	</div>
	<hr />
    <!-- Content Row -->
    <div class="row">
	  <div class="col-lg-6">
        <div class="table-responsive">	
		  
		  <?php 
			$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_id='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
							
			$nprenom = $result['reqsdr_deman'];
							
			$sql2 = "SELECT * FROM user WHERE pseudo='$nprenom' OR nom LIKE '%$nprenom%' OR prenom LIKE '%$nprenom%' " ;
			$requete2 = $mysqli->query( $sql2 ) ;
			$result2 = $requete2->fetch_assoc();
									
			echo("<table class=\"table table-striped table-bordered table-hover\">
			  <tbody>
				<tr><th>Soumise le</th><td>".$result['reqsdr_date']."</td></tr>
				<tr><th>Demandeur</th><td>".$result2['nom']." ".$result2['prenom']."</td></tr>
				<tr><th>Raison (s)</th><td>".$result['reqsdr_raison']."</td></tr>
				<tr><th>Salle</th><td>".$result['reqsdr_salle']."</td></tr>
				<tr><th>Nombre de Participant</th><td>".$result['reqsdr_nbr']."</td></tr>
				<tr><th>Pause-Caf&eacute;</th><td>".$result['reqsdr_pc']."</td></tr>
				<tr><th>Equipement Multim&eacute;dia</th><td>".$result['reqsdr_mmedia']."</td></tr>
				<tr><th>D&eacute;but</th><td>".$result['reqsdr_deb'].", ".$result['reqsdr_heurd']."h".$result['reqsdr_mind']."mn</td></tr>
				<tr><th>Fin</th><td>".$result['reqsdr_fin'].", ".$result['reqsdr_heurf']."h".$result['reqsdr_minf']."mn</td></tr>
			</tbody>");

			echo("</table>");
			echo("<a href=\"validasksdr.php?id=".$id."\" class=\"btn btn-success\" title=\"Valider la Demande\"><i class=\"fa fa-check-circle\" fa-fw></i> CONFIRMER</a>			
			<a href=\"rejectasksdr.php?id=".$id."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger\" title=\"Rejeter la Demande\"><i class=\"fa fa-trash\" fa-fw></i> SUPPRIMER</a>");	
		  ?>
                
		</div>
        <!-- /.table-responsive -->
	  </div>
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

	<!-- Dialog Modal-->
	<div class="modal fade fond" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	  <div class="modal-header">     
		<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
      </div>
      <div class="modal-body">
        Cliquez sur "OUI" pour confirmer votre choix
	  </div>
      <div class="modal-footer">
		<?php echo("<a href=\"detailreqstsdr.php?id=".$id."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>
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
