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
	
	$nopers = $_GET["nopers"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<script src="http://10.109.87.10:8080/scripts/js/jquery-2.2.4.min.js"></script>
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
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-calendar fa-fw"></i> Les Cong&eacute;s ayant droit <font color="green"><i><?php echo $nopers;?></i></font></h1>
		<a href="soldeleave.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-check fa-sm text-black-75"></i> V&eacute;rifier Soldes</a>
		<a href="addcongpers.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-black-75"></i> D&eacute;finir Solde</a>
	</div>	
	<hr />
	
	<!--row -->
	<div class="row"> 
	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Liste des cong&eacute;s </h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
			
			<?php
				$existe = $mysqli->query("SELECT leave_id AS ID FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
				if($existe['ID'] != 0)
				{	
					echo("<table class=\"table\">
						<thead><tr>
							<th>#</th>
							<th>Employ&eacute;</th>
							<th>Type</th>
							<th>Nombre</th>
							<th>Au</th>
							<th>Statut</th>
							<th></th>
							<th></th>
						</tr></thead>");
									
					$i=1;
					$sql = "SELECT * FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' " ;
					$requete = $mysqli->query( $sql ) ;								
								
					while( $result = $requete->fetch_assoc()  )
					{
						echo("<tbody><tr class=\"default\"><td>".$i."</td>");
						echo("<td>".$result['leave_nom']." ".$result['leave_pnom']."</td>");
						echo("<td>".$result['leave_type']."</td>");	
						echo("<td>".$result['leave_solde']."</td>");
						echo("<td>".$result['leave_ldate']."</td>");
						echo("<td>".$result['leave_statu']."</td>");
						echo("<td><a href=\"ajustmod.php?id=".$result['leave_id']."\" title=\"Ajuster\" class=\"btn-warning btn-circle btn-sm\"><i class=\"fa fa-balance-scale\"></i></a></td>");
						if ($result['leave_statu'] == '')
						{
							echo("<td><a href=\"ajustsup.php?id=".$result['leave_id']."&nopers=".$result['leave_nopers']."&cle=DCT\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn-danger btn-circle btn-sm\" title=\"Desactiver\"><i class=\"fas fa-lock text-white\"></i></a></td>");
						}
						if ($result['leave_statu'] == 'INACTIF')
						{
							echo("<td><a href=\"ajustsup.php?id=".$result['leave_id']."&nopers=".$result['leave_nopers']."&cle=ACT\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn-success btn-circle btn-sm\" title=\"Activer\"><i class=\"fas fa-unlock text-white\"></i></a></td>");
						}
						$i++;
					}
					echo("</tr></tbody></table>");
				}
				else
				{
					echo("<div class=\"alert alert-danger\">Aucun type de Cong&eacute; associer &agrave; Cet Index...</div>") ;		
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
		<?php echo("<a href=\"ajustsold2.php?nopers=".$nopers."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
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