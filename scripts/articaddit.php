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
	
	if ($profil != "AdminSTOCK")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>
	
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus fa-fw"></i> Cr&eacute;er un Nouvel Article </h1>
	  <a href="gestartit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des Articles</a>				
    </div>
	<hr />  

	<div class="row">
	  <div class="col-lg-12">
		<form class="form-horizontal" name="formulaire" action="articadd2.php" method="post" onsubmit="return verif_formulaire()" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="item">Item Description :</label>
			<div class="col-sm-5">
			  <input type="text" id="item" name="item" class="form-control" placeholder="Saisir le nom de l'article " required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="cat">Cat&eacute;gorie :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="cat" name="cat" required>
			  <option></option>
			  <?php
				$sqlb 	  = "SELECT confmg_nom FROM wfp_chd_confmg WHERE confmg_type='CAT' AND confmg_nom!='FOURN' ORDER BY confmg_nom" ;
				$requeteb = $mysqli->query( $sqlb ) ;

				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option>".$resultb['confmg_nom']."</option>");
				}				
			  ?>
			</select>
		  </div>
		</div>
		
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="seuil">Seuil Alerte :</label>
			<div class="col-sm-5">
			  <input type="text" id="seuil" name="seuil" class="form-control" placeholder="Renseigner la valeur du seuil d'alerte " required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="desc">Description :</label>
			<div class="col-sm-5">
			  <textarea id="desc" name="desc" class="form-control"></textarea>
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
