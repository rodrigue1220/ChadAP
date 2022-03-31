<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$id = $_GET["id"];
	require('ctrl3.php');

	include("inc/taarikh.php");
	include('inc/headers.php');
?>	
<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-legal"></i> Demande HS n&deg; <font color="blue"><?php echo $_GET["id"];?></font> &agrave; CERTIFIER</h1>
	  <a href="djoummahapprv.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				     
	  <a href="compensctotout.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fa fa-list-alt fa-sm text-black-75"></i> Aper&ccedil;u HS</a></div>
	<hr />
    <!-- Content Row -->
    <div class="row">
	  <div class="col-lg-12">
		<?php
			$sql 	= "SELECT * FROM wfp_chd_djmcto WHERE cto_id='$id'" ;
			$requete= $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
			$h1		= strtotime($result['cto_hfin2']);
			$h2   	= strtotime($result['cto_hdeb2']);
			$dure 	= gmdate('H:i:s',$h1-$h2);
			$dem 	= $result['cto_dem'];
			
			$sqldem = "SELECT * FROM user WHERE pseudo='$dem' " ;
			$rqdem 	= $mysqli->query($sqldem);
			$resdem = $rqdem->fetch_assoc();
			$dnom	= $resdem["nom"];
			$dpnom 	= $resdem["prenom"];
		?>
        <form class="form-horizontal" name="formulaire" action="traite2hs2adj.php" method="post">
		  <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />	
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="deb">Date Effective:</label>
			<div class="col-sm-4">
			  <input type="date" id="deb" name="deb" class="form-control" value="<?php echo $result['cto_deb']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="heurd">D&eacute;but Effectif :</label>
			<div class="col-sm-2">
			  <select class="form-control" id="heurd" name="heurd" required>
				<option><?php echo date("H", strtotime($result['cto_hdeb2'])); ?></option><option> 00 </option><option> 01 </option><option> 02 </option>
				<option> 03 </option><option> 04 </option><option> 05 </option><option> 06 </option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
				<option> 19 </option><option> 20 </option><option> 21 </option><option> 22 </option><option> 23 </option>
			  </select>
			</div>			
			<div class="col-sm-2">
			  <select class="form-control" id="mind" name="mind" required>
				<option><?php echo date("i", strtotime($result['cto_hdeb2'])); ?></option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>	
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="heurr">Fin Effective :</label>
			<div class="col-sm-2">
			  <select class="form-control" id="heurr" name="heurr" required>
				<option><?php echo date("H", strtotime($result['cto_hfin2'])); ?></option><option> 00 </option><option> 01 </option><option> 02 </option>
				<option> 03 </option><option> 04 </option><option> 05 </option><option> 06 </option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
				<option> 19 </option><option> 20 </option><option> 21 </option><option> 22 </option><option> 23 </option>
			  </select>
			</div>
			<div class="col-sm-2">
			  <select class="form-control" id="minr" name="minr" required>
				<option><?php echo date("i", strtotime($result['cto_hfin2'])); ?></option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3">Dur&eacute;e Effective :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" name="opt" id="opt" value="<?php echo $dure; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="lib">T&acirc;ches &agrave; effectuer :</label>
			<div class="col-sm-4">
			  <textarea id="lib" name="lib" class="form-control"><?php echo $result['cto_raison']; ?></textarea>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3">Type de Compensation :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="opt" name="opt" disabled="disabled" required>
				<option><?php echo $result['cto_choix']; ?></option>
				<option> CASH </option><option> CTO </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
		    <label class="control-label col-sm-3" for="oic">Demandeur de Service / OIC :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" name="oic" id="oic" value="<?php echo $result['cto_approver'];  ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-legal fa-fw"></i> Certifier</button>
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