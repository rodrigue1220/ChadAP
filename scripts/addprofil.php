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
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Cr&eacute;er Profil Utilisateur</h1>
	  <a href="add1user.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm" title="Nouvel Utilisateur"><i class="fas fa-user-plus fa-fw"></i> Nouvel User</a>
	  <a href="assprofil.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm" title="Assigner Profil"><i class="fas fa-asterisk fa-fw"></i> Assigner Profil</a>								
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-8">
		<form class="form-horizontal" name="formulaire" action="add2profil.php" method="post" onsubmit="return verif_formulaire()" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Lib&eacute;l&eacute; Profil :</label>
			<div class="col-sm-5">
			  <input type="text" id="nom" name="nom" class="form-control" placeholder="Renseigner le nom du profil" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="office">Bureau :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="office" name="office" >
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ORDER BY goffu_type " ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['goffu_type']." ".$resultb['goffu_offlieu']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="service">Unit&eacute; :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="service" name="service" >
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type='UNITE' ORDER BY goffu_nom " ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['goffu_nom']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="det">D&eacute;tails :</label>
			<div class="col-sm-5">
			  <textarea id="det" name="det" class="form-control"></textarea>
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
      <!-- /.row -->
 </div>
 
 <!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
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