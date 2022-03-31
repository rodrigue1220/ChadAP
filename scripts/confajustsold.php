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
	
	if ($profil != "AdminRH")
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
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-check-square fa-fw"></i> Cong&eacute;s Ajust&eacute;s / En attente d'approbation</h1>
		<a href="soldeleave.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-check fa-sm text-black-75"></i> V&eacute;rifier Soldes</a>
		<a href="addcongpers.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-black-75"></i> D&eacute;finir Solde</a>
	</div>	
	<hr />
	
	<!--row -->
	<div class="row"> 
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste des cong&eacute;s Ajust&eacute;s</h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
            <?php
				$existe = $mysqli->query("SELECT lvar_id AS ID FROM wfp_chd_djmvar WHERE lvar_apprv='' AND lvar_init!='$pseudo' ")->fetch_array();
				if($existe['ID'] != 0)
				{	
					echo("<table class=\"table\">
					<thead><tr>
						<th>#</th>
						<th>Initi&eacute; par</th>
						<th>Soumis le</th>
						<th>Employ&eacute;</th>
						<th>Index</th>
						<th>Type</th>
						<th>Solde</th>
						<th>Au</th>
						<th>Commentaires</th>
						<th></th>
					</tr></thead>");
									
					$i=1;
					$sql = "SELECT * FROM wfp_chd_djmvar WHERE lvar_apprv='' AND lvar_init!='$pseudo' ORDER BY lvar_index " ;
					$requete = $mysqli->query( $sql ) ;								
								
					while( $result = $requete->fetch_assoc()  )
					{
						$pers		= $result['lvar_index'];
						$sqld	 	= "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$pers' " ;
						$requeted 	= $mysqli->query( $sqld );
						$resultd	= $requeted->fetch_assoc();
						$dnom 		= $resultd["rh_lname"];
						$dprenom  	= $resultd["rh_fname"];
							
						echo("<tbody><tr class=\"default\"><td>".$i."</td>");
						echo("<td>".$result['lvar_init']."</td>");
						echo("<td>".$result['lvar_dinit']."</td>");	
						echo("<td>".$dnom." ".$dprenom."</td>");
						echo("<td>".$result['lvar_index']."</td>");
						echo("<td>".$result['lvar_ltype']."</td>");
						echo("<td>".$result['lvar_solde']."</td>");
						echo("<td>".$result['lvar_dsold']."</td>");
						echo("<td>".$result['lvar_lib1']."</td>");
						echo("<td><a href=\"confajustsold2.php?id=".$result['lvar_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn-success btn-circle btn-sm\"><i class=\"fas fa-check-square\"></i></button></td>");
						$i++;
					}
					echo("</tr></tbody></table>");
				}
				else
				{
					echo("<div class=\"alert alert-danger\">Aucun Cong&eacute; ajuster en attente...</div>") ;		
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
		<a href="confajustsold.php" class="btn btn-danger" id="confirmModalNo">Non</a>
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