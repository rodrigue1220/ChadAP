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
	
	if ($profil != "AdminSTDESK")
	{
		header('Location:simple.php');
	}
	
	$refer	= $_GET["id"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<script type="text/javascript">
<!--
	function verif_formulaire()
	{
		if(document.formulaire.oic.value == "Assigné a...")  {
			alert("Veuillez choisir le OIC pour approbation!");
			document.formulaire.oic.focus();
		return false;
		}
	}
//-->
</script>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-pencil-square fa-fw"></i> Assigner la Demande pour Approbation OIC / TEC</h1>
	  <a href="listaskeqpmt.php" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Demande (s) en Attente | SDESK</a>
	</div>
	<hr />   
    
	<div class="row">
	  <div class="col-lg-8">
 	  <?php
		$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_ref='$refer' " ;
		$requete = $mysqli->query( $sql ) ;
		$result = $requete->fetch_assoc();
	  ?>
      <form name="formulaire" action="askeqsdeskassgn2.php" method="post" onsubmit="return verif_formulaire()">
		<input type="hidden" id="id" name="id" value="<?php echo $refer;?>" />					
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="ref">R&eacute;f&eacute;rence :</label>
		  <div class="col-sm-8">
			<input type="text" id="ref" name="ref" disabled="disabled" class="form-control" value="<?php echo $result['rqeqpmt_ref']; ?>" required />
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="demand">Demandeur :</label>
		  <div class="col-sm-8">
			<input type="text" id="demand" name="demand" disabled="disabled" class="form-control" value="<?php echo $result['rqeqpmt_demand']; ?>" required />
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="oic">Chef Unit&eacute; / OIC TEC </label>
		  <div class="col-sm-8">
			<select class="form-control" id="oic" name="oic" required>
			  <option>Assigné a...</option>
			  <?php

				$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='ICT/CO NDJAMENA' ORDER BY off_nom" ;
				$requeteb = $mysqli->query( $sqlb ) ;

				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
				}				
			  ?>
			</select>
		  </div>
		</div>	
					
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-12">
			<button type="submit" class="btn btn3 btn-success"><i class="fa fa-check-square fa-fw"></i> Assigner</button>
			<button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Annuler</button>
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