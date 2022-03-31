<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('connexion.php');
	require_once('verifications.php');
	
	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nomoic = $result["nom"];
	$pnomoic = $result["prenom"];
			
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic'")->fetch_array();
	if($oic['ID'] == 0)
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include('inc/headers.php');
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
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-check"></i> <i class="fas fa-fw fa-laptop"></i> <i class="fas fa-fw fa-book-open"></i> Demandes d'&eacute;quipement / fourniture &agrave; Approuver</h1>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row-lg-auto">
		<div class="card shadow mb-4">
			<a href="#collapseCardEQAprv" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardEQAprv">
				<h6 class="m-0 font-weight-bold text-primary">Liste des demandes en ATTENTE d'approbation </h6>
			</a>
        
		<?php
			$sql	 = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
			$requete = $mysqli->query( $sql );
			$result	 = $requete->fetch_assoc();
			$nom 	 = $result["nom"];
			$prenom  = $result["prenom"];
								
			$approver = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_oic='$nomoic,$pnomoic' AND rqeqpmt_state='ATTENTE'")->fetch_array();				
			if($approver['ID'] != 0)
			{
				echo("<div class=\"collapse show\" id=\"collapseCardEQAprv\">
				<div class=\"card-body\">
					<table class=\"table\">");
				
				$sql3 		= "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_oic='$nomoic,$pnomoic' AND rqeqpmt_state='ATTENTE'" ;
				$requete3 	= $mysqli->query( $sql3 ) ;
						
				echo("<table class=\"table\">
					<thead><tr>
					<th>#</th>
					<th>Demandeur</th>
					<th>Item Description</th>
					<th>Qtt&eacute;.</th>
					<th>Raison</th>
					<th></th>
				</tr></thead>");
					
				echo("<tfoot><tr>
					<th>#</th>
					<th>Demandeur</th>
					<th>Item Description</th>
					<th>Qtt&eacute;.</th>
					<th>Raison</th>
					<th></th>
				</tr></tfoot>");
					
				while( $result3 = $requete3->fetch_assoc()  )
				{				
					$refer		= $result3['rqeqpmt_ref'];
					$motif		= $result3['rqeqpmt_motif'];
					$demandeur	= $result3['rqeqpmt_demand'];
					$sqlz		= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
					$requetez	= $mysqli->query( $sqlz );
					$resultz	= $requetez->fetch_assoc();
					$nom		= $resultz["nom"];
					$prenom 	= $resultz["prenom"];
							
					$sql3v 		= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='SOUMIS'" ;
					$requete3v 	= $mysqli->query( $sql3v ) ;
					
					while( $resultv3 = $requete3v->fetch_assoc()  )
					{
						$code	= $resultv3['rqeqv_item'];
						$sql4 	= "SELECT * FROM wfp_chd_catart WHERE catart_code='$code' " ;
						$req4 	= $mysqli->query( $sql4 ) ;
						$res4 	= $req4->fetch_assoc(); 
						$item	= $res4["catart_nom"];
						$type	= $res4["catart_lib"];
						if($item =="")
						{
							$item = $code;
						}
						
						echo("<tbody><tr><td>".$resultv3['rqeqv_id']."</td>");
						echo("<td>".$nom." ".$prenom."</td>");
						echo("<td>".$item."</td>");
						echo("<td>".$resultv3['rqeqv_nbr']."</td>");
						echo("<td>".$motif."</td>");
									
								//echo("<td><a href=\"auto1askeq.php?id=".$resultv3['rqeqv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success btn-circle btn-sm\" title=\"APPROUVER\"><i class=\"fas fa-check text-white\"></i></a></td>");
						echo("<td><a href=\"rejectaskeqoic.php?id=".$resultv3['rqeqv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-circle btn-sm\" title=\"REJETER\"><i class=\"fas fa-trash text-white\"></i></a></td>");
					}
				}
				echo("</tr></tbody></table>");
				echo("<hr /><center><a href=\"auto1askeqall.php\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn3 btn-info\"><i class=\"fas fa-check fa-sm text-white\"></i> Tout Approuver</a></center>");
			}

			else
			{
				echo("<div class=\"collapse no-show\" id=\"collapseCardEQAprv\">
				<div class=\"card-body\">
					<table class=\"table\">");
					
				echo("<div class=\"alert alert-danger\">Il n'y a aucune demande de fourniture / equipement en attente de votre approbation...<br /></div>") ;	
				echo("</tr></tbody></table>");
			}
		?>

			</div>
            <!-- /.card-body -->
          </div>
          <!-- /.collapse -->
        </div>
        <!-- /.card shadow -->	 
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
		<a href="askapprv.php" class="btn btn-danger" id="confirmModalNo">Non</a>
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
