<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$sql 	= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete= $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nom 	= $result["nom"];
	$prenom = $result["prenom"];
				
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom' AND off_unit='ICT/CO NDJAMENA' ")->fetch_array();
	if($oic['ID'] == 0) 
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
<script src="http://10.109.87.10:8080/scripts/js/bootstrap.min.js"></script>
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

<style type="text/css"> .btn3{ width:180px; text-color: #ffffff;} </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" /> 
<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Demandes d'&eacute;quipement</h1>
	  <a href="geststockit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-cart-arrow-down fa-sm text-white-75"></i> Stock Disponible</a>
	  <a href="stockvarfit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-bar-chart fa-sm text-black-75"></i> Variations de Stock</a>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-auto">
	  <div class="card shadow mb-8">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des demandes d'&eacute;quipement en attente d'approbation par OIC / TEC</h6>
        </div>
		<div class="card-body">
			<div class="table-responsive">
		<?php		
			$i=1;
			$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_date>'2020-12-15 00:00:00' AND rqeqpmt_state='APPROUVE1' AND rqeqpmt_oicit='$nom,$prenom' AND rqeqpmt_type!='FOURN' ")->fetch_array();
					
			if($exis['ID'] != 0)
			{
				$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_date>'2020-12-15 00:00:00' AND rqeqpmt_state='APPROUVE1' AND rqeqpmt_oicit='$nom,$prenom' AND rqeqpmt_type!='FOURN' " ;
				$requete = $mysqli->query( $sql ) ;
				echo("<table class=\"table\">
				<thead><tr>
					<th>#</th>
					<th>Ref.</th>
					<th>Demandeur</th>
					<th>Initi&eacute;e le</th>
					<th>Raison</th>
					<th>OIC</th>
					<th>Valid&eacute;e le</th>
				<th></th>
				</tr></thead>");
					
				while( $result3 = $requete->fetch_assoc()  )
				{
					$init	= $result3['rqeqpmt_demand'];
					$sql 	= "SELECT * FROM user WHERE pseudo='$init' " ;
					$req 	= $mysqli->query( $sql );
					$res	= $req->fetch_assoc();
					$nomi	= $res["nom"];
					$pnomi	= $res["prenom"];
		
					echo("<tbody><tr><td>".$result3['rqeqpmt_id']."</td>");
					echo("<td>".$result3['rqeqpmt_ref']."</td>");
					echo("<td>".$nomi." ".$pnomi."</td>");
					echo("<td>".$result3['rqeqpmt_date']."</td>");
					echo("<td>".$result3['rqeqpmt_motif']."</td>");
					echo("<td>".$result3['rqeqpmt_oic']."</td>");
					echo("<td>".$result3['rqeqpmt_doic']."</td>");
					echo("<td><a href=\"listdeqpmtatitdet.php?id=".$result3['rqeqpmt_ref']."\" class=\"btn btn-info btn-circle btn-sm\" title=\"DETAILLER LA DEMANDE\"><i class=\"fas fa-list text-white\"></i></a></td>");
					//echo("<td><a href=\"askfourmgapprv.php?id=".$result3['rqeqpmt_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success btn-circle btn-sm\" title=\"APPROUVER\"><i class=\"fas fa-check text-white\"></i></a></td>");
					//echo("<td><a href=\"askfourmgrej.php?id=".$result3['rqeqpmt_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-circle btn-sm\" title=\"REJETER\"><i class=\"fa fa-reply text-white\"></i></a></td>");
				}
				echo("</tr></table");
			}
			else
			{
				echo("<div class=\"alert alert-danger\">Aucune demande d'&eacute;quipement en attente de votre approbation (OIC/TEC)...</div>") ;		
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
		<a href="listdemfourn.php" class="btn btn-danger" id="confirmModalNo">Non</a>
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