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
	
	if ($pseudo != "zimbos" && $profil!= "ADMINSYS")
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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list-alt"></i> Liste Index</h1>
	  <a href="assindex.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-asterisk fa-sm text-black-75"></i> Assigner Index</a>				     
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-auto">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Index Utilisateurs</h6>
          </div>
               
		<?php
			$i=1;
			echo("<div class=\"card-body\">
				<div class=\"table-responsive\">
              <table class=\"table\">");
			  
			$sql = "SELECT * FROM user WHERE pseudo!='administrateur' AND state!='INACTIF' ORDER BY nom ASC LIMIT 0, 10" ;
			$requete = $mysqli->query( $sql ) ;
			echo("<thead><tr>
				<th>#</th>
				<th>Nom et Pr&eacute;nom</th>
				<th>Unit&eacute;</th>
				<th>Index</th>
				<th></th>
			</tr></thead>");
		
			while( $result = $requete->fetch_assoc()  )
			{
				echo("<tbody><tr><td>".$i."</td>");
				echo("<td>".$result['nom']." ".$result['prenom']."</td>");	
				echo("<td>".$result['unite']."</td>");
				echo("<td>".$result['indexid']."</td>");
				echo("<td><a href=\"indexmod.php?ide=".$result['id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-warning btn-sm d-sm-inline-block\" title=\"MODIFIER\"><i class=\"fa fa-edit\"></i></a></td></tr></tbody>");
				
				$i++;
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
		<a href="indexlist.php" class="btn btn-danger" id="confirmModalNo">Non</a>
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
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
