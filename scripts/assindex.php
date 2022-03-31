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
	
	if ($profil!= "ADMINSYS" && $profil!="AdminFIN")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-asterisk fa-fw"></i> Assigner Index Utilisateur </h1>
	  <a href="indexlist.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des Index</a>				
	</div>
	<hr />
	<div class="row">
	  <div class="col-lg-12">
        <form class="form-horizontal" name="formulaire" action="ass2index.php" method="post" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nom">Utilisateur :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="nom" name="nom" required>
				<option>Choisir..</option>
				<?php
					$sqlb 	= "SELECT * FROM user WHERE pseudo!='administrateur' AND (indexid='N/D' OR indexid='') ORDER BY nom " ;
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
		    <label class="control-label col-sm-3" for="idex">Index  :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="idex" name="idex"  placeholder="Saisir l'index..." required>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-asterisk fa-fw"></i> Assigner</button>
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
