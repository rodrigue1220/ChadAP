<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	
	include("inc/taarikh.php");
	include('inc/headers.php');
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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-legal"></i> Certification HS</h1>
	  <a href="compenscto.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				     
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-auto">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des demandes HS en ATTENTE de certification </h6>
          </div>
		  <?php
			
			$sql	 = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
			$requete = $mysqli->query( $sql );
			$result	 = $requete->fetch_assoc();
			$nom 	 = $result["nom"];
			$prenom  = $result["prenom"];
			
			echo("<div class=\"card-body\">
				<div class=\"table-responsive\">
              <table class=\"table\">");	
			  
			$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='EFFECTUE'")->fetch_array();				
			if($approver['ID'] != 0)
			{
				$sql = "SELECT * FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='EFFECTUE'" ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>N&deg;</th>
					<th>Demandeur</th>											
					<th>Date Eff</th>
					<th>Heure d&eacute;but Eff</th>
					<th>Heure fin Eff</th>
					<th>Dur&eacute;e</th>
					<th>Raison</th>
					<th>Type</th>
					<th colspan=\"2\">Actions</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					$demandeur	= $result['cto_dem'];
					$sqld	 	= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
					$requeted 	= $mysqli->query( $sqld );
					$resultd	= $requeted->fetch_assoc();
					$dnom 		= $resultd["nom"];
					$dprenom  	= $resultd["prenom"];
										
					echo("<tbody><tr><td>".$result['cto_id']."</td>");
					echo("<td>".$dnom." ".$dprenom."</td>");
					echo("<td>".$result['cto_deb2']."</td>");
					echo("<td>".$result['cto_hdeb2']."</td>");	
					echo("<td>".$result['cto_hfin2']."</td>");
					echo("<td>".$result['cto_dure']."</td>");
					echo("<td>".$result['cto_raison']."</td>");
					echo("<td>".$result['cto_choix']."</td>");
										
					echo("<td><a href=\"traite2hsadj.php?id=".$result['cto_id']."\" class=\"btn btn-sm btn-success d-sm-inline-block\" onclick=\"document.location='traite2hsadj.php?id=".$result['cto_id']."'\" title=\"Certifier\"><i class=\"fa fa-legal\"></i></button></td>
						<td><a href=\"traitehs2.php?id=".$result['cto_id']."&cx=RJ\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-sm btn-danger d-sm-inline-block\" title=\"Rejeter\"><i class=\"fa fa-times\"></i></button></td></tr></tbody>");
				}
			}
			else
			{
				echo("<div class=\"alert alert-danger\">Il n'y a aucune demande d'heures suppl&eacute;mentaires en attente de votre Certification...<br /></div>") ;		
			}
		  ?>
		  </table>
 </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card shadow -->
      </div>
      <!-- /.col-lg-12 -->
	</div>
	<!--row -->
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
		<a href="vacompenscto2.php" class="btn btn-danger" id="confirmModalNo">Non</a>
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
