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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-user-plus"></i> Nouvel Utilisateur</h1>
	  <a href="userlist.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"title="Liste des utilisateurs"><i class="fas fa-list fa-fw"></i> Liste Users</a>
	  <a href="unitmod.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm" title="Changer Unité"><i class="fas fa-building fa-fw"></i> Changer Unit&eacute;</a>
	  <a href="addprofil.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm" title="Ajouter Profil"><i class="fas fa-plus fa-fw"></i> Nouveau Profil</a>
	  <a href="assprofil.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm" title="Assigner Profil"><i class="fas fa-asterisk fa-fw"></i> Assigner Profil</a>								
	</div>
	<hr />   
	
    <!--row -->
	<div class="row">
      <div class="col-lg-10">
		<form class="form-horizontal" name="formulaire" action="add1user2.php" method="post" onsubmit="return verif_formulaire()" >
		  <input type="hidden" id="adm" name="adm" value="<?php echo $pseudo;?>" />
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="nom">Nom :</label>
				  <div class="col-sm-4">
					<input type="text" id="nom" name="nom" placeholder="Entrer nom" class="form-control"/>
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="pnom">Pr&eacute;nom :</label>
				  <div class="col-sm-4">
					<input type="text" id="pnom" name="pnom" placeholder="Entrer le prenom" class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="dem">Pseudo :</label>
				  <div class="col-sm-4">
					<input type="text" id="dem" name="dem" placeholder="Entrer un pseudo" class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="email">Email :</label>
				  <div class="col-sm-4">
					<input type="text" id="email" name="email"  class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="tel">T&eacute;l&eacute;phone :</label>
				  <div class="col-sm-4">
					<input type="text" id="tel" name="tel" placeholder="Votre numero Tel" class="form-control" required />
				  </div>
				</div>
					
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="mdp">Mot de passe :</label>
				  <div class="col-sm-4">
				    <input type="password" id="mdp" name="mdp" placeholder="Entrer un mot de passe" class="form-control" required />
				  </div>
				</div>
				
				<div class="form-group row">
				  <label class="control-label col-sm-3" for="mdp2">Confirmer :</label>
				  <div class="col-sm-4">
					<input type="password" id="mdp2" name="mdp2" placeholder="Confirmer password" class="form-control" required />
				  </div>
				</div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="office">Bureau :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="office" name="office" >
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
			<label class="control-label col-sm-3" for="service">Unit&eacute; :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="service" name="service" >
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type='UNITE' ORDER BY goffu_nom " ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['goffu_nom']."</option>");
					}				
				?>
			  </select>
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
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>