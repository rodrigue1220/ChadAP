<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	$id = $_GET["ide"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list-alt"></i> D&eacute;tails Informations</h1>
		<a href="directory2.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-address-book fa-sm text-black-75"></i> Gest. Annuaire</a>
		<a href="diradd.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-plus fa-sm text-black-75"></i> Ajouter</a>
	</div>
	<hr />
	
	<div class="row">
	  <?php			
		$sql	 = "SELECT * FROM wfp_chd_dir WHERE dir_id='$id'" ;
		$requete = $mysqli->query( $sql ) ;
		$result  = $requete->fetch_assoc(); 

		echo("<div class=\"col-lg-6\">
		<div class=\"table-responsive\">");			

		echo("<table class=\"table table-striped table-bordered table-hover\"><tbody>");
		echo("<tr><th>Nom & Pr&eacute;nom</th><td>".$result['dir_fullname']."</td></tr>
			<tr><th>Titre</th><td>".$result['dir_titre']."</td></tr>
			<tr><th>Unit&eacute;</th><td>".$result['dir_unit']."</td></tr>
			<tr><th>Duty</th><td>".$result['dir_duty']."</td></tr>
			<tr><th>Email</th><td>".$result['dir_mail']."</td></tr>
			<tr><th>T&eacute;l&eacute;phone 1 </th><td>".$result['dir_tel1']."</td></tr>
			<tr><th>T&eacute;l&eacute;phone 2 </th><td>".$result['dir_tel2']."</td></tr>
			<tr><th>T&eacute;l&eacute;phone 3 </th><td>".$result['dir_tel3']."</td></tr>
			<tr><th>Call Sign </th><td>".$result['dir_csign']."</td></tr>
			<tr><th>Extension </th><td>".$result['dir_ext']."</td></tr>");
		echo("</tbody></table></div></div>");
	  ?>
	</div>
	<!-- /.row -->

<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
            
		</div>
        <!-- /.container-fluid -->	
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

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
