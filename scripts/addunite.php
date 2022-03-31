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
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Unit&eacute;</h1>
	  <a href="listoic.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm" title="Liste de tous les OIC"><i class="fas fa-list fa-sm text-white-75"></i> Liste des OIC</a>				
	  <a href="addoic.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm" title="Enregistrer nouveau OIC"><i class="fas fa-plus fa-sm text-white-75"></i> Nouveau OIC</a>	
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-8">
        <form class="form-horizontal" name="formulaire" action="add2unit2.php" method="post">
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Nom :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="nom" name="nom" placeholder="Renseigner le nom" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="off">Office  :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="off" name="off" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ORDER BY goffu_type " ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['goffu_type']." ".$resultb['goffu_offlieu']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="det">D&eacute;tails :</label>
			<div class="col-sm-5">
			  <textarea id="det" name="det" class="form-control"></textarea>
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