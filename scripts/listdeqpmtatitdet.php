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
	
	$id	= $_GET["id"];
	
	$sql 	= "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_ref='$id' " ;
	$requet = $mysqli->query( $sql );
	$resu	= $requet->fetch_assoc();	
	
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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list-alt"></i> D&eacute;tails Demande en attente | OIC/TEC</h1>
	  <a href="listdeqpmtatit.php" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Demande (s) en Attente | OIC/TEC</a>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row"> 
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste des articles de la demande <font color="#FF0000"><?php echo $id; ?> | en attente d'approbation par OIC / TEC</font></h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
			
			<?php
				
				$exis = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$id' AND rqeqv_state='APRV1' ")->fetch_array();
						
				if($exis['ID'] != 0)
				{
					$sql = "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$id' AND rqeqv_state='APRV1' " ;
					$requete = $mysqli->query( $sql ) ;
					echo("<table class=\"table\">
					<thead><tr>
						<th>#</th>
						<th>Item Description</th>
						<th>Qtt&eacute;.</th>
						<th>En Stock</th>
						<th>Apprv.</th>
						<th>Seuil</th>
						<th>OIC</th>
						<th>Approuv&eacute; le</th>
						<th colspan=\"2\"></th>
					</tr></thead>");
					
					while( $result = $requete->fetch_assoc()  )
					{
						$code	= $result['rqeqv_item'];
						$stk 	= $mysqli->query("SELECT stock_nbr AS NB FROM wfp_chd_sandouk WHERE stock_item='$code' ")->fetch_array();
						$nbr	= $stk["NB"];
						
						$sql4 	= "SELECT * FROM wfp_chd_catart WHERE catart_code='$code' " ;
						$req4 	= $mysqli->query( $sql4 ) ;
						$res4 	= $req4->fetch_assoc(); 
						$item	= $res4["catart_nom"];
						$type	= $res4["catart_lib"];
						$seuil	= $res4["catart_seuil"];
						
						if($item =="")
						{
							$item = $code;
							$seuil = "N/D";
							$nbr = 0;
						}
						
						echo("<tbody><tr><td>".$result['rqeqv_id']."</td>");
						echo("<td>".$item."</td>");
						echo("<td>".$result['rqeqv_nbr']."</td>");
						if ($nbr<$result['rqeqv_nbr'])
						{
							echo("<td bgcolor=\"#FF0000\">".$nbr."</td>");
						}
						else
						{
							echo("<td bgcolor=\"#00FF90\">".$nbr."</td>");
						}
						echo("<td>".$result['rqeqv_nbraprv']."</td>");
						echo("<td>".$seuil."</td>");
						echo("<td>".$resu["rqeqpmt_oic"]."</td>");
						echo("<td>".$resu["rqeqpmt_doic"]."</td>");
						
						echo("<td><a href=\"cmdmgrejaction.php?id=".$result['rqeqv_id']."&refer=".$result['rqeqv_ref']."&cx=ADJ\" class=\"btn btn-success btn-circle btn-sm\" title=\"AJUSTER QTTE\"><i class=\"fas fa-balance-scale text-white\"></i></a></td>");
						echo("<td><a href=\"cmdmgrejaction.php?id=".$result['rqeqv_id']."&refer=".$result['rqeqv_ref']."&cx=REJ\" class=\"btn btn-danger btn-circle btn-sm\" title=\"REJETER\"><i class=\"fa fa-reply text-white\"></i></a></td>");
					}
					echo("</tr></tbody></table>");
					echo("<hr /><center><a href=\"askeqoictapall.php?ref=".$id."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn3 btn-info\"><i class=\"fas fa-check fa-sm text-white\"></i><i class=\"fas fa-check fa-sm text-white\"></i> Tout Approuver</a></center>");
				}
				else
				{
					echo("<div class=\"alert alert-danger\">Pas de d&eacute;tails pour cette demande...</div>") ;		
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
		<a href="listdeqpmtatit.php" class="btn btn-danger" id="confirmModalNo">Non</a>
		<a href="#" class="btn btn-info" id="confirmModalYes">Oui</a>
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