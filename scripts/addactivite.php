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
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-line-chart fa-fw"></i> Activit&eacute;</h1>
	<hr />
	<div class="row">
	  <div class="col-lg-12">
		<form class="form-horizontal" name="formulaire" action="add2activite.php" method="post" onsubmit="return verif_formulaire()" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="actv">Activit&eacute; :</label>
			<div class="col-sm-5">
			  <input type="text" id="actv" name="actv" placeholder="Entrer le nom de l'activit&eacute;" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
		    <label class="control-label col-sm-3" for="desc">Description :</label>
			<div class="col-sm-5">
			  <textarea id="desc" name="desc" class="form-control" placeholder="Renseigner description" required></textarea>
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
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
