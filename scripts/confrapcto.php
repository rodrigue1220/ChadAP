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
      <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-reply fa-sm"></i> Annuler Demande CTO / H Supp.</h1>
	  <a href="rapctorh.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Retour Liste</a>				
    </div>
	<hr />   
    
	<!--row -->
    <div class="row">
	  <div class="col-lg-12">
		<?php
			$id = $_GET["id"];
			$pg = $_GET["page"];

			$sql = "SELECT * FROM wfp_chd_djmcto WHERE cto_id='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
				
			$demandeur	= $result['cto_index'];
			$sqlz = "SELECT * FROM user WHERE indexid='$demandeur' " ;
			$requetez	= $mysqli->query( $sqlz );
			$resultz	= $requetez->fetch_assoc();
			$nom		= $resultz["nom"];
			$prenom 	= $resultz["prenom"];
		?>
        
		<form class="form-horizontal" name="formulaire" action="rejectctorh.php" method="post">
		  <input type="hidden" id="idt" name="idt" value="<?php echo $result['cto_id']; ?>" />
		  <input type="hidden" id="pg" name="pg" value="<?php echo $pg; ?>" />
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="num">Num&eacute;ro de la demande:</label>
			<div class="col-sm-5">
			  <input type="text" id="num" name="num" class="form-control" value="<?php echo $result['cto_id']; ?>" disabled="disabled"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="dem">Demandeur:</label>
			<div class="col-sm-5">
			  <input type="text" id="dem" name="dem" class="form-control" disabled="disabled" value="<?php echo $nom." ".$prenom; ?>"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="datedeb">Date Pr&eacute;vue:</label>
			<div class="col-sm-5">
			  <input type="text" id="datedeb" name="datedeb" class="form-control" value="<?php echo $result['cto_deb']; ?>" disabled="disabled"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="statu">Statut:</label>
			<div class="col-sm-5">
			  <input type="text" id="statu" name="statu" class="form-control" disabled="disabled" value="<?php echo $result['cto_statut']; ?>"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="addr">Raisons / Commentaires:</label>
			<div class="col-sm-5">
			  <textarea id="librej" name="librej" class="form-control" required></textarea>
			</div>
		  </div>
			
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-reply fa-fw"></i> Annuler</button>
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