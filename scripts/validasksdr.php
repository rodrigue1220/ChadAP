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
	
	if ($profil != "AdminSDR")
	{
		header('Location:simple.php');
	}
	$id = $_GET["id"];
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-check-circle fa-fw"></i> Validation Demande SDR | n&deg; <?php echo $id;?></h1>
	<hr />
	<div class="row">
	  <div class="col-lg-12">
		<?php
			$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_id='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
		?>
        
		<form class="form-horizontal" name="formulaire" action="validasksdr2.php" method="post">
		  <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />	
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sdr">Demandeur :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="id" name="id" value="<?php echo $result['reqsdr_deman'];?>" disabled="disabled"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sdr">Salle :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="sdr" name="sdr" >
				<?php
					$sqlb 	= "SELECT gesdr_lib1 FROM wfp_chd_gesdr WHERE gesdr_cat='SDR' ORDER BY gesdr_lib1" ;
					$requeteb = $mysqli->query( $sqlb ) ;
								
					echo("<option> ".$result['reqsdr_salle']."</option>");
								
					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['gesdr_lib1']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="comm">Commentaire :</label>
			<div class="col-sm-5">
			  <textarea id="comm" name="comm" class="form-control" placeholder="Ajouter commentaire"></textarea>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fas fa-check-circle fa-fw"></i> Confirmer</button>
			  <button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
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
