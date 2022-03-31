<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$id = $_GET["ide"];
	
	if ($id == "")
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
			if(document.formulaire.nouv_passe.value != document.formulaire.nouv_passe2.value)  
			{
				alert("Le mot de passe est different de sa confirmation!");
				document.formulaire.nouv_passe2.focus();
				return false;
			}
		}
	//-->
</script>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-key fa-sm"></i> Modification Password</h1>
	</div>
	<hr />   
    
	<!--row -->
    <div class="row">
	  <div class="col-lg-10">
		<?php
			$sql = "SELECT * FROM user WHERE pseudo='$id'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
		?>
        
		<form class="form-horizontal" name="formulaire" action="modif1user2.php" method="post" onSubmit="return verif_formulaire()">
		  <?php echo("<input type=\"hidden\" id=\"cle\" name=\"cle\" value=".$id." />"); ?>
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Nom :</label>
			<div class="col-sm-5">
			  <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $result['nom']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="pnom">Pr&eacute;nom :</label>
			<div class="col-sm-5">
			  <input type="text" id="pnom" name="pnom" class="form-control" value="<?php echo $result['prenom']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="mail">Email :</label>
			<div class="col-sm-5">
			  <input type="text" id="mail" name="mail" class="form-control" value="<?php echo $result['email']; ?>" disabled="disabled"/>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="pseudo">Pseudo :</label>
			<div class="col-sm-5">
			  <input type="text" id="pseudo" name="pseudo" class="form-control" value="<?php echo $result['pseudo']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="tel">T&eacute;l&eacute;phone :</label>
			<div class="col-sm-5">
			  <input type="text" id="tel" name="tel" class="form-control" value="<?php echo $result['tel']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nouv_passe">Nouveau mot de passe :</label>
			<div class="col-sm-5">
			  <input type="password" id="nouv_passe" name="nouv_passe" class="form-control" autocomplete="off" required="required" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nouv_passe2">Confirmer mot de passe :</label>
			<div class="col-sm-5">
			  <input type="password" id="nouv_passe2" name="nouv_passe2" class="form-control" autocomplete="off" required="required" />
			</div>
		  </div>

		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fas fa-edit fa-fw"></i> Modifier</button>
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

  <!-- Core plugin JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="http://10.109.87.10:8080/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://10.109.87.10:8080/js/demo/chart-area-demo.js"></script>
  <script src="http://10.109.87.10:8080/js/demo/chart-pie-demo.js"></script>

</body>

</html>