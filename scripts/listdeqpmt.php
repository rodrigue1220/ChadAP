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
	
	if ($profil != "AdminSTOCK")
	{
		header('Location:simple.php');
	}
	
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

<style type="text/css"> .btn3{ width:180px; text-color: #ffffff;} </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />  
  <style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-list fa-fw"></i> Demande d'equipement (s) </h1>
	  <a href="geststockit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-cart-arrow-down fa-sm text-white-75"></i> Stock Disponible</a>
	  <a href="stockvarfit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-bar-chart fa-sm text-black-75"></i> Variations de Stock</a>
	  <a href="stockaddsortit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fa fa-exchange fa-sm text-white-75"></i> E/S du Stock</a>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row"> 
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste des demandes d'equipement | <font color="#FF0000"> approuv&eacute;es par OIC / TEC</font></h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
			
			<?php
				
				$i=1;
				$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_date>'2020-12-15 00:00:00' AND rqeqpmt_state='APPROUVE2' AND rqeqpmt_type!='FOURN' ")->fetch_array();
					
				if($exis['ID'] != 0)
				{
					$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_date>'2020-12-15 00:00:00' AND rqeqpmt_state='APPROUVE2' AND rqeqpmt_type!='FOURN' " ;
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
						$nom	= $res["nom"];
						$pnom	= $res["prenom"];
		
						echo("<tbody><tr><td>".$result3['rqeqpmt_id']."</td>");
						echo("<td>".$result3['rqeqpmt_ref']."</td>");
						echo("<td>".$nom." ".$pnom."</td>");
						echo("<td>".$result3['rqeqpmt_date']."</td>");
						echo("<td>".$result3['rqeqpmt_motif']."</td>");
						echo("<td>".$result3['rqeqpmt_oic']."</td>");
						echo("<td>".$result3['rqeqpmt_doic']."</td>");
						echo("<td><a href=\"listdeqpmtdet.php?id=".$result3['rqeqpmt_ref']."\" class=\"btn btn-info btn-circle btn-sm\" title=\"DETAILLER LA DEMANDE\"><i class=\"fas fa-list text-white\"></i></a></td>");
						//echo("<td><a href=\"askfourmgapprv.php?id=".$result3['rqeqpmt_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success btn-circle btn-sm\" title=\"APPROUVER\"><i class=\"fas fa-check text-white\"></i></a></td>");
						//echo("<td><a href=\"askfourmgrej.php?id=".$result3['rqeqpmt_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-circle btn-sm\" title=\"REJETER\"><i class=\"fa fa-reply text-white\"></i></a></td>");
					}
					echo("</tr></table");
				}
				else
				{
					echo("<div class=\"alert alert-danger\">Aucune demande approuv&eacute;e par OIC / TEC...</div>") ;		
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