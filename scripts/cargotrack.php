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

	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> <i class="fas fa-fw fa-cogs"></i> Tracking / Position Camion</h1>	
		<a href="suivflotte.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-sliders fa-sm text-black-75"></i> Situat&deg; Camions</a>
		<a href="cargomouv.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-line-chart fa-sm text-white-75"></i> En Mouvement</a>
	</div>
	<hr /> 
	
	<!--row -->
	<div class="row">
      <div class="col-lg-8">
        <form class="form-horizontal" name="formulaire" action="cargotrack2.php" method="post">
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="ref">R&eacute;f&eacute;rence :</label>
			<div class="col-sm-6">
			  <select class="form-control" id="ref" name="ref" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_cargo WHERE cargo_state='EN_ROUTE' ORDER BY cargo_id" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['cargo_ref']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="posi">Position :</label>
			<div class="col-sm-6">
			  <select class="form-control" id="posi" name="posi" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_adminar ORDER BY adm_lieu" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['adm_lieu']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="wakit">Date :</label>
			<div class="col-sm-6">
			  <input type="date" class="form-control" id="wakit" name="wakit" required />
			</div>
		  </div>
		  
		   <div class="form-group row">
			<label class="control-label col-sm-4" for="heure">Heure :</label>
			<div class="col-sm-3">
			  <select class="form-control" id="heure" name="heure" required>
				<option>HH</option><option> 00 </option><option> 01 </option><option> 02 </option>
				<option> 03 </option><option> 04 </option><option> 05 </option><option> 06 </option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
				<option> 19 </option><option> 20 </option><option> 21 </option><option> 22 </option><option> 23 </option>
			  </select>
			</div>			
			<div class="col-sm-3">
			  <select class="form-control" id="min" name="min" required>
				<option>mn</option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>	
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="obs">Observations :</label>
			<div class="col-sm-6">
			  <textarea id="obs" name="obs" class="form-control"></textarea>
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
  <script type="text/javascript" src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>