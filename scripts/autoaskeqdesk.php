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
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<script type="text/javascript">
<!--
	function verif_formulaire()
	{
		if(document.formulaire.oic.value == "Assigné a...")  {
			alert("Veuillez choisir le Chef de Section pour approbation!");
			document.formulaire.oic.focus();
		return false;
		}
	}
//-->
</script>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-pencil-square"></i> Assigner la Demande pour Approbation OIC / ICT</h1>
	  <a href="listaskeqpmt.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des demandes</a>				     
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
	  <div class="col-lg-8">
 	  <?php
		$id = $_GET["id"];
		$sql = "SELECT * FROM wfp_chd_sandoukvar WHERE vars_id='$id'" ;
		$requete = $mysqli->query( $sql ) ;
		$result = $requete->fetch_assoc();
	  ?>
      <form name="formulaire" action="autoaskeqdesk2.php" method="post" onsubmit="return verif_formulaire()">
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />					
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="demand">Demandeur :</label>
		  <div class="col-sm-8">
			<input type="text" id="demand" name="demand" disabled="disabled" class="form-control" value="<?php echo $result['vars_rq']; ?>" required />
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="item">Item Description :</label>
		  <div class="col-sm-8">
			<input type="text" id="item" name="item" disabled="disabled" class="form-control" value="<?php echo $result['vars_item']; ?>" required />
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="nbr">Nombre :</label>
		  <div class="col-sm-8">
			<input type="text" id="nbr" name="nbr" disabled="disabled" class="form-control" value="<?php echo $result['vars_nbr']; ?>" required />
		  </div>
		</div>	
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="oic">Chef de Section ICT </label>
		  <div class="col-sm-8">
			<select class="form-control" id="oic" name="oic" required>
			  <option>Assigné a...</option>
			  <?php
				$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
				$requet = $mysqli->query( $sqle );
				$resulte = $requet->fetch_assoc();
									
				$unite	= $resulte['unite'];
				$nom	= $resulte['nom'];
				$prenom	= $resulte['prenom'];
				$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
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
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>