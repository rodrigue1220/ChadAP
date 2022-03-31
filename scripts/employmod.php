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
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-edit fa-fw"></i> Modifier Profil Employ&eacute; </h1>
		<a href="gestcontcong.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-wrench fa-sm text-black-75"></i> Admin. RH</a>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-lg-12">
	  <?php
		$id 	= $_GET["id"];
		$pg 	= $_GET["page"];
		$sql	= "SELECT * FROM wfp_chd_personnel WHERE rh_id='$id'" ;
		$requete= $mysqli->query( $sql ) ;
		$result = $requete->fetch_assoc();
	  ?>
        
		<form class="form-horizontal" name="formulaire" action="employmod2.php" method="post" onsubmit="return verif_formulaire()" >
		  <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />	
		  <input type="hidden" id="pg" name="pg" value="<?php echo $pg;?>" />
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Nom :</label>
			<div class="col-sm-5">
			  <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $result['rh_lname']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="pnom">Pr&eacute;nom :</label>
			<div class="col-sm-5">
			  <input type="text" id="pnom" name="pnom" class="form-control" value="<?php echo $result['rh_fname']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nopers">Index :</label>
			<div class="col-sm-5">
			  <input type="text" id="nopers" name="nopers" class="form-control" value="<?php echo $result['rh_nopers']; ?>" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sex">Genre :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="sex" name="sex" required />
				<option><?php echo $result['rh_genre']; ?></option>
				<option>MALE</option>
				<option>FEMALE</option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="titre">Titre :</label>
			<div class="col-sm-5">
			  <input type="text" id="titre" name="titre" class="form-control" value="<?php echo $result['rh_titre']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="duty">Duty :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="duty" name="duty" required />
				<option><?php echo $result['rh_duty']; ?></option><option> NDJAMENA </option><option> ABECHE </option><option> AMDJARASS </option><option> ATI </option><option> BAGA-SOLA </option><option> BOL </option>
				<option> FARCHANA </option><option> GORE </option><option> GOZ-BEIDA </option><option> GUEREDA </option><option> IRIBA </option>
				<option> MAO </option><option> MONGO </option><option> MOUNDOU </option><option> MOUSSORO </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="cont">Contrat :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="cont" name="cont" required />
				<option><?php echo $result['rh_contrat']; ?></option>
				<option>SC</option><option>SS</option><option>Fixed Term</option>
				<option>Continuing</option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="eod">Date EOD :</label>
			<div class="col-sm-5">
			  <input type="date" id="eod" name="eod" class="form-control" value="<?php echo $result['rh_eod']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nte">Date NTE :</label>
			<div class="col-sm-5">
			  <input type="date" id="nte" name="nte" class="form-control" value="<?php echo $result['rh_nte']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-edit fa-fw"></i> Modifier</button>
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
