<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$sqlt 		= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requetet	= $mysqli->query( $sqlt );
	$resultt	= $requetet->fetch_assoc();
	$nom1		= $resultt["nom"];
	$prenom1 	= $resultt["prenom"];
	$npnom		= $nom1.",".$prenom1;
	$id 		= $_GET["id"];

	$sql 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id'" ;
	$requet = $mysqli->query( $sql ) ;
	$result = $requet->fetch_assoc();
	$superv	= $result['lv_sup'];
	$supoic	= $result['lv_oic'];
	$etat	= $result['lv_state'];

	if(($superv!=$npnom && $etat=='ATTENTE') || ($supoic!=$npnom && $etat=='APPROUVE1') || $etat=='APPROUVE2')
	{
		header('Location:simple.php');
	}
	
	
	include("inc/taarikh.php");
	include('inc/headers.php');
?>
<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-remove"></i> Rejeter Demande de cong&eacute;s n&deg; <font color="blue"><?php echo $id;?></font></h1>
	  <a href="accueil.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				     
    </div>
	<hr />
    <!-- Content Row -->
    <div class="row">
	  <div class="col-lg-12">
		<?php
			$sql 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id'" ;
			$requet = $mysqli->query( $sql ) ;
			$result = $requet->fetch_assoc();
			$demandeur	= $result['lv_nopers'];
			$sqlz = "SELECT * FROM user WHERE indexid='$demandeur' " ;
			$requetez	= $mysqli->query( $sqlz );
			$resultz	= $requetez->fetch_assoc();
			$nom		= $resultz["nom"];
			$prenom 	= $resultz["prenom"];
		?>
        <form class="form-horizontal" name="formulaire" action="rejectaskdjoicdmd.php" method="post">
		  <input type="hidden" id="idt" name="idt" value="<?php echo $result['lv_id']; ?>" />
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="addr">Demandeur:</label>
			<div class="col-sm-5">
			  <input type="text" id="dem" name="dem" class="form-control" disabled="disabled" value="<?php echo $nom." ".$prenom; ?>"/>
			</div>
		  </div>
		
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="deb">D&eacute;but :</label>
			<div class="col-sm-2">
			  <input type="date" id="deb" name="deb" class="form-control"	value="<?php echo $result['lv_deb1']; ?>" disabled="disabled" />
			</div>
			<label class="control-label col-sm-1" for="ret">Retour :</label>
			<div class="col-sm-2">
			  <input type="date" id="ret" name="ret" class="form-control" value="<?php echo $result['lv_rep']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="addr">Adresse:</label>
			<div class="col-sm-5">
			  <input type="text" id="addr" name="addr" class="form-control" value="<?php echo $result['lv_addr']; ?>" disabled="disabled"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-4" for="addr">Raisons / Commentaires:</label>
			<div class="col-sm-5">
			  <textarea id="librej" name="librej" class="form-control" required></textarea>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-5">
			  <button type="submit" class="btn btn-danger"><i class="fa fa-remove fa-fw"></i> Rejeter la demande</button>
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