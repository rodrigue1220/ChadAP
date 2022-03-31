<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nom = $result["nom"];
	$prenom = $result["prenom"];
				
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom' AND off_unit='ICT/CO NDJAMENA' ")->fetch_array();
	if($oic['ID'] == 0)
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-check"></i> Approbation OIC / ICT</h1>
	  <a href="listdeqpmtatit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des demandes</a>				     
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
        <form name="formulaire" action="auto2askeq.php" method="post">
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
			  <input type="text" id="nbr" name="nbr" class="form-control" value="<?php echo $result['vars_nbr']; ?>" required />
			</div>
		  </div>	
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="comm">Commentaires OIC /ICT :</label>
			<div class="col-sm-8">
			  <textarea class="form-control" id="comm" name="comm" placeholder="Saisir vos remarques"></textarea>
			</div>
		  </div>	
					
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-check fa-fw"></i> Approuver</button>
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