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
	
	if ($profil!= "AdminLOGSTK")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit fa-sm"></i> Modification In Stock</h1>
	</div>
	<hr />   
    
	<!--row -->
    <div class="row">
	  <div class="col-lg-10">
		<?php
			$id = $_GET["ide"];
			

			$sql = "SELECT * FROM wfp_chd_logstock WHERE logs_id='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
		?>
        
		<form class="form-horizontal" name="formulaire" action="logstkmod2.php" method="post">
		  <?php echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=".$id." />"); ?>
		  <?php echo("<input type=\"hidden\" id=\"pg\" name=\"pg\" value=".$_GET["page"]." />"); ?>
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="wh">Warehouse :</label>
			<div class="col-sm-6">
			  <select class="form-control" id="wh" name="wh" required >
			  <?php
				$sqlb 	= "SELECT DISTINCT logc_nom FROM wfp_chd_logconf WHERE logc_type='WH' " ;
				$requeteb = $mysqli->query( $sqlb ) ;
				echo("<option> ".$result['logs_wh']." </option>");
				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['logc_nom']." </option>");
				}				
			  ?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="mdesc">Mat. Desc. :</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="mdesc" name="mdesc" value="<?php echo $result['logs_matdesc']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="batch">Batch :</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="batch" name="batch" value="<?php echo $result['logs_batch']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="WBS">WBS :</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="wbs" name="wbs" value="<?php echo $result['logs_wbs']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="gnum">Grant Num. :</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="gnum" name="gnum" value="<?php echo $result['logs_grantnum']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="gdesc">Grant Desc. :</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="gdesc" name="gdesc" value="<?php echo $result['logs_grantdesc']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="bbd">SLED/BBD :</label>
			<div class="col-sm-6">
			  <input type="date" class="form-control" id="bbd" name="bbd" value="<?php echo $result['logs_sledbbd']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="total">Tot. Stock :</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" id="total" name="total" value="<?php echo $result['logs_total']; ?>" required >
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="gtdd">TDD Grant :</label>
			<div class="col-sm-6">
			  <input type="date" class="form-control" id="gtdd" name="gtdd" value="<?php echo $result['logs_tddgrant']; ?>" required >
			</div>
		  </div>
			
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-6">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-edit fa-fw"></i> Modifier</button>
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