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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-asterisk"></i> Assigner Profil User</h1>
	  <a href="userprofil.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"title="Liste des utilisateurs"><i class="fas fa-list fa-fw"></i> Liste Prof / Users</a>
	  <a href="addprofil.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm" title="Ajouter Profil"><i class="fas fa-plus fa-fw"></i> Nouveau Profil</a>
	</div>
	<hr />   

    <!-- /.row -->
    <div class="row">
	<div class="col-lg-12">
      <form class="form-horizontal" name="formulaire" action="ass2profil.php" method="post" onsubmit="return verif_formulaire()" >
		<div class="form-group row">
		  <label class="control-label col-sm-3" for="nom">Utilisateur :</label>
		  <div class="col-sm-5">
			<select class="form-control" id="nom" name="nom" required>
			  <option></option>
			  <?php
				
				$sqlb 	= "SELECT * FROM user WHERE pseudo!='$pseudo' ORDER BY nom " ;
				$requeteb = $mysqli->query( $sqlb ) ;

				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['nom'].",".$resultb['prenom']."</option>");
				}				
			  ?>
			</select>
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-3" for="prof">Profil  :</label>
		  <div class="col-sm-5">
			<select class="form-control" id="prof" name="prof" required>
			  <option></option>
			  <?php
								
				$sqlb 	= "SELECT * FROM wfp_chd_gest WHERE gest_type='PROFIL' ORDER BY gest_nom " ;
				$requeteb = $mysqli->query( $sqlb ) ;

				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['gest_nom']."</option>");
				}				
			  ?>
			</select>
		  </div>
		</div>
		
		<div class="form-group row">
		  <div class="col-sm-offset-2 col-sm-12">
			<button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Assigner</button>
			<button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
		  </div>
		</div>
	  </form>
	  </div>
    </div>
    <!-- /.row -->
	
	<?php
		if($pseudo=="zimbos")
		{
			echo("<hr /><div class=\"row\">
				<div class=\"col-lg-12\">
				<form class=\"form-horizontal\" action=\"ass3profil.php\" method=\"post\">
					<div class=\"form-group row\">
						<label class=\"control-label col-sm-3\" for=\"nom\">Utilisateur :</label>
						<div class=\"col-sm-5\">
							<select class=\"form-control\" id=\"nom\" name=\"nom\" required>
								<option></option>");
								
								$sqlb 	= "SELECT * FROM user ORDER BY nom " ;
								$requeteb = $mysqli->query( $sqlb ) ;

								while( $resultb = $requeteb->fetch_assoc() )
								{
									echo("<option> ".$resultb['nom'].",".$resultb['prenom']."</option>");
								}				
						echo("</select>
						</div>
					</div>
					
					<div class=\"form-group row\">
						<div class=\"col-sm-offset-2 col-sm-12\">
							<button type=\"submit\" class=\"btn btn3 btn-success\"><i class=\"fa fa-download fa-fw\"></i> Super User</button>
						</div>
					</div>
				</form>
			  </div>
			</div>
			<!-- /.row -->");
		}
	?>

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