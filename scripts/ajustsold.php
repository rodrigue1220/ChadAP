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

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-balance-scale fa-fw"></i> Ajuster Solde Employ&eacute;</h1>
		<a href="soldeleave.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-check fa-sm text-black-75"></i> V&eacute;rifier Soldes</a>
		<a href="addcongpers.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-black-75"></i> D&eacute;finir Solde</a>
		<?php
			$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djmvar WHERE lvar_apprv='' AND lvar_init!='$pseudo' ")->fetch_array();		
			if($nb['nb']!=0)
			{
				echo ("<a href=\"confajustsold.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm\"><i class=\"fa fa-legal\" fa-fw></i> Confirmer Aj Soldes</a>");
			}
		?>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-lg-12">
        <form class="form-horizontal" name="formulaire" action="ajustsold2.php" method="get" >
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="nopers">Index :</label>
			<div class="col-sm-3">
			  <input type="text" id="nopers" name="nopers" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-secondary"><i class="fa fa-search fa-fw"></i> Chercher</button>
			</div>
		  </div>
		</form>
      </div>
    </div>
	<!-- /.row -->
            
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
