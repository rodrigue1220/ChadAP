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
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-plus fa-fw"></i> Ajouter Infos Utilisateur </h1>
		<a href="directory2.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-address-book fa-sm text-black-75"></i> Gest. Annuaire</a>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-lg-12">
		<form class="form-horizontal" name="formulaire" action="diradd2.php" method="post">
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Nom & Pr&eacute;nom:</label>
			<div class="col-sm-5">
			  <input type="text" id="nom" name="nom" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="pnom">Titre :</label>
			<div class="col-sm-5">
			  <input type="text" id="titr" name="titr" class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="mail">Email :</label>
			<div class="col-sm-5">
			  <input type="text" id="mail" name="mail" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="tel">T&eacute;l&eacute;phone 1 :</label>
			<div class="col-sm-5">
			  <input type="text" id="tel" name="tel" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="tel2">T&eacute;l&eacute;phone 2 :</label>
			<div class="col-sm-5">
			  <input type="text" id="tel2" name="tel2" class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="tel3">T&eacute;l&eacute;phone 3 :</label>
			<div class="col-sm-5">
			  <input type="text" id="tel3" name="tel3" class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="ext">Extension :</label>
			<div class="col-sm-5">
			  <input type="text" id="ext" name="ext" class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="csign">Call Sign:</label>
			<div class="col-sm-5">
			  <input type="text" id="csign" name="csign" class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="thuraya">Thuraya :</label>
			<div class="col-sm-5">
			  <input type="text" id="thuraya" name="thuraya" class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="unit">Unit&eacute; :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="unit" name="unit" >
				<?php
					$sqlb 	= "SELECT DISTINCT(dir_unit) FROM wfp_chd_dir ORDER BY dir_unit" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['dir_unit']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="duty">Duty :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="duty" name="duty" >
				<?php
					$sqlb 	= "SELECT DISTINCT(dir_duty) FROM wfp_chd_dir ORDER BY dir_duty" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['dir_duty']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
			  <button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
			</div>
		  </div>
		</form>
      </div>
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
