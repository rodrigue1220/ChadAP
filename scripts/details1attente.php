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
	include("inc/headers.php");
?>

<script type="text/javascript" src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="http://10.109.87.10:8080/scripts/js/bootstrap.min.js"></script>

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
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-hand-o-right fa-fw"></i> Mes Demandes en Attente</h1>
	<hr />
	<!--row -->
	<div class="row"> 
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste de mes demandes Eqpmt / Four | <font color="#FF0000">en attente</font></h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
			
			<?php
				
				$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='SOUMIS' OR rqeqpmt_state LIKE '%ATT%' OR rqeqpmt_state='APPROUVE1') ")->fetch_array();
						
				if($exis['ID'] != 0)
				{
					$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='SOUMIS' OR rqeqpmt_state LIKE '%ATT%' OR rqeqpmt_state='APPROUVE1') " ;
					$requete = $mysqli->query( $sql ) ;
					echo("<table class=\"table\">
					<thead><tr>
						<th>#</th>
						<th>R&eacute;f&eacute;rence</th>
						<th>Soumis le</th>
						<th>Raison</th>
						<th>OIC</th>
						<th>Statut</th>
						<th colspan=\"2\"></th>
					</tr></thead>");
					
					while( $result = $requete->fetch_assoc()  )
					{
						echo("<tbody><tr><td>".$result['rqeqpmt_id']."</td>");
						echo("<td>".$result['rqeqpmt_ref']."</td>");
						echo("<td>".$result['rqeqpmt_date']."</td>");	
						echo("<td>".$result['rqeqpmt_motif']."</td>");
						echo("<td>".$result['rqeqpmt_oic']."</td>");
						echo("<td>".$result['rqeqpmt_state']."</td>");
						
						echo("<td><a href=\"details1attente2.php?id=".$result['rqeqpmt_ref']."\" class=\"btn btn-info btn-circle btn-sm\" title=\"DETAILLER LA DEMANDE\"><i class=\"fas fa-list text-white\"></i></a></td>");
						if ($result['rqeqpmt_state']=="ATTENTE")
						{
							echo("<td><a href=\"rejaskuser.php?ref=".$result['rqeqpmt_ref']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-circle btn-sm\" title=\"ANNULER\"><i class=\"fa fa-reply text-white\"></i></a></td>");
						}
					}
					echo("</tr></tbody></table>");
				}
				else
				{
					echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de fourniture / equipement en attente...</div>") ;		
				}
			?>
			</div>
	      </div>
		</div>
      </div>
	</div>
	
	<hr />
	<!--row -->
	<div class="row"> 
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste de mes demandes SDR | <font color="#FF0000">en attente</font></h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
			
			<?php
				
				$exis = $mysqli->query("SELECT reqsdr_id AS ID FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE'")->fetch_array();
				
				if($exis['ID'] != 0)
				{
					$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE' " ;
					$requete = $mysqli->query( $sql ) ;
					echo("<table class=\"table\">
					<thead><tr>
						<th>#</th>
						<th>Raison</th>
						<th>Salle</th>
						<th>Du</th>
						<th>Au</th>
						<th>Pause-caf&eacute;</th>
						<th>Multim&eacute;dia</th>
						<th></th>
					</tr></thead>");
					
					while( $result = $requete->fetch_assoc()  )
					{
						echo("<tbody><tr class=\"default\"><td>".$result['reqsdr_id']."</td>");
						echo("<td>".$result['reqsdr_raison']."</td>");
						echo("<td>".$result['reqsdr_salle']."</td>");	
						echo("<td>".$result['reqsdr_deb']." ".$result['reqsdr_horaire1']."</td>");
						echo("<td>".$result['reqsdr_fin']." ".$result['reqsdr_horaire2']."</td>");
						echo("<td>".$result['reqsdr_pc']."</td>
						<td>".$result['reqsdr_mmedia']."</td>");
						
						echo("<td><a href=\"modif1asksdr.php?id=".$result['reqsdr_id']."\" class=\"btn btn-warning btn-circle btn-sm\" title=\"MODIFIER\"><i class=\"fa fa-edit text-white\"></i></a></td>");

					}
					echo("</tr></tbody></table>");
				}
				else
				{
					echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de SDR en attente...</div>") ;		
				}
			?>
			</div>
	      </div>
		</div>
      </div>
	</div>
		
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
		<a href="details1attente.php" class="btn btn-danger" id="confirmModalNo">Non</a>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>
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

</body>

</html>