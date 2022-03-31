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
	
	if ($pseudo != "zimbos" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-edit fa-fw"></i> Modifier Index Utilisateur </h1>
		<a href="assindex.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-plus fa-sm text-black-75"></i> Nouvel Index</a>				
		<a href="indexlist.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des Index</a>				
	</div>
	<hr />
	<div class="row">
	  <div class="col-lg-10">
		
		<?php
			
			$id = $_GET["ide"];

			$sql = "SELECT * FROM user WHERE id='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
		?>
        
		<form class="form-horizontal" name="formulaire" action="indexmod2.php" method="post" >
		  <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />					
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Utilisateur :</label>
			<div class="col-sm-5">
			  <input type="text" id="nom" name="nom" disabled="disabled" class="form-control" value="<?php echo $result['nom'].",".$result['prenom']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="idex">Index :</label>
			<div class="col-sm-5">
			  <input type="text" id="idex" name="idex" class="form-control" value="<?php echo $result['indexid']; ?>" required />
			</div>
		  </div>
					
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-edit fa-fw"></i> Modifier</button>
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
