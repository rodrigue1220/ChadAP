<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro2	= $mysqli->query("SELECT profil2 AS PRO FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil2 = $pro2["PRO"];
	
	if($profil2 != "AdminSU")
	{
		header('Location:simple.php');
	}
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-exchange fa-fw"></i> Basculer de Profil Utilisateur </h1>
	<hr />
	<div class="row">
	  <div class="col-lg-10">
	    <form class="form-horizontal" name="formulaire" action="basc2prof.php" method="post">
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="prof">Profil  :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="prof" name="prof" required>
				<option></option>
				<?php
					$unit	= $mysqli->query("SELECT unite AS un FROM user WHERE pseudo='$pseudo'")->fetch_array();
					$unite	= $unit["un"];
					if ($pseudo == "zimbos")
					{
						$sqlb 	= "SELECT * FROM wfp_chd_gest WHERE gest_type='PROFIL' ORDER BY gest_nom " ;
					}
					else
					{
						$sqlb 	= "SELECT * FROM wfp_chd_gest WHERE gest_type='PROFIL' AND gest_lib2='$unite' ORDER BY gest_nom " ;
					}
					$requeteb = $mysqli->query( $sqlb ) ;
					echo("<option>Normal</option>");
					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['gest_nom']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-exchange fa-fw"></i> Basculer</button>
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
