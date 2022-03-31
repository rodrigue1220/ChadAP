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
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}
	
	$id		= $_GET["ide"] ;
	$page	= $_GET["page"] ;
	$option	= $_GET["choix"] ;
	
	if ($option=="CHRG")
	{
		$mot	="Chargement";
	}
	else if ($option=="MSERTE")
	{
		$mot	="Mise en route";
	}
	else
	{
		$mot	="D&eacute;chargement";
	}

	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
	
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-bus"></i> <?php echo $mot.' Cargaison'; ?></h1>
		<a href="gestcharge.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-cogs fa-sm text-black-75"></i> Gest. Cargaisons</a>
		<a href="gestdmd.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des Demandes</a>	
	</div>
	<hr /> 
	
	<?php
		$sql = "SELECT * FROM wfp_chd_cargo WHERE cargo_id='$id'" ;
		$requete = $mysqli->query( $sql ) ;
		$result  = $requete->fetch_assoc();
	?>
		
	<!--row -->
	<div class="row">
      <div class="col-lg-10">
        <form class="form-horizontal" name="formulaire" action="cargoact2.php" method="post">
		  <?php 
			echo("<input type=\"hidden\" id=\"ide\" name=\"ide\" value=".$id." />"); 
			echo("<input type=\"hidden\" id=\"page\" name=\"page\" value=".$page." />");
			echo("<input type=\"hidden\" id=\"choix\" name=\"choix\" value=".$option." />");
		  ?>
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="dmde">R&eacute;f&eacute;rence :</label>
			<div class="col-sm-4">
			  <input type="text" id="dmde" name="dmde" class="form-control" value="<?php echo $result['cargo_ref']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="vehi">V&eacute;hicule :</label>
			<div class="col-sm-4">
			  <input type="text" id="vehi" name="vehi" class="form-control" value="<?php echo $result['cargo_vehi']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="driver">Driver :</label>
			<div class="col-sm-4">
			  <input type="text" id="driver" name="driver" class="form-control" value="<?php echo $result['cargo_chauf']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="wakit">Date de <?php echo $mot; ?> :</label>
			<div class="col-sm-4">
			   <input type="date" id="wakit" name="wakit" class="form-control"  required />
			</div>
		  </div>
		  
		   <div class="form-group row">
			<label class="control-label col-sm-4" for="heurd">Heure de <?php echo $mot; ?> :</label>
			<div class="col-sm-2">
			  <select class="form-control" id="heurd" name="heurd" required>
				<option>HH</option><option> 00 </option><option> 01 </option><option> 02 </option>
				<option> 03 </option><option> 04 </option><option> 05 </option><option> 06 </option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
				<option> 19 </option><option> 20 </option><option> 21 </option><option> 22 </option><option> 23 </option>
			  </select>
			</div>			
			<div class="col-sm-2">
			  <select class="form-control" id="mind" name="mind" required>
				<option>mn</option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>	
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-exchange fa-fw"></i> <?php echo $mot; ?></button>
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
  <script type="text/javascript" src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>