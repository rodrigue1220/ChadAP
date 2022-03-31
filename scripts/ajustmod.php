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
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-edit fa-fw"></i> Ajuster Solde de Cong&eacute;s </h1>
		<a href="soldeleave.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-check fa-sm text-black-75"></i> V&eacute;rifier Soldes</a>
		<a href="addcongpers.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-black-75"></i> D&eacute;finir Solde</a>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-lg-12">
	  <?php
		$id = $_GET["id"];

		$sql = "SELECT * FROM wfp_chd_djoummah WHERE leave_id='$id'" ;
		$requete = $mysqli->query( $sql ) ;
		$result = $requete->fetch_assoc();
	  ?>

        <form class="form-horizontal" name="formulaire" action="ajustmod2.php" method="post">
		  <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />					
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Employ&eacute; :</label>
			<div class="col-sm-5">
			  <input type="text" id="nom" name="nom" disabled="disabled" class="form-control" value="<?php echo ($result['leave_nom']." ".$result['leave_pnom']); ?>" required />
			</div>
		  </div>
		   
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nopers">Index :</label>
			<div class="col-sm-5">
			  <input type="text" id="nopers" name="nopers" class="form-control" value="<?php echo $result['leave_nopers']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="typ">Type de Cong&eacute;s :</label>
			<div class="col-sm-5">
			  <input type="text" id="typ" name="typ" class="form-control" value="<?php echo $result['leave_type']; ?>" required />
			</div>
		  </div>	
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sold">Solde Cong&eacute;s :</label>
			<div class="col-sm-5">
			  <input type="text" id="sold" name="sold" class="form-control" value="<?php echo $result['leave_solde']; ?>" required />
			</div>
		  </div>	
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="dsold">Date Solde (au) :</label>
			<div class="col-sm-5">
			  <input type="date" id="dsold" name="dsold" class="form-control" value="<?php echo $result['leave_ldate']; ?>" required />
			</div>
		  </div>	
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="dsold">Suite &agrave; la demande :</label>
			<div class="col-sm-5">
			  <input type="text" id="ndem" name="ndem" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="comm">Commentaires :</label>
			<div class="col-sm-5">
			  <textarea id="comm" name="comm" class="form-control" placeholder="Saisir vos remarques, causes..."></textarea>
			</div>
		  </div>	
					
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-check fa-fw"></i> Valider</button>
			  <button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
			</div>
		  </div>
		</form>
      </div>
    </div>
	<!-- /.row -->
	
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
            
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
