<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	/*$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];*/
	
	if ($pseudo != "zimbos")
	{
		header('Location:simple.php');
	}

	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> <i class="fas fa-fw fa-bus"></i>  Nouvelle Demande Cargaison</h1>				
	</div>
	<hr /> 
	
    <div class="alert alert-primary" >
		Il est question ici de la demande de CAMIONS du WORKSHOP pour la livraison des VIVRES / NFI...
	</div>
	
	<!--row -->
	<div class="row">
      <div class="col-lg-8">
        <form class="form-horizontal" name="formulaire" action="askcargo2.php" method="post">
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="orig">Origine :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="orig" name="orig" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_adminar ORDER BY adm_lieu" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['adm_lieu']."</option>");
					}				
				?>
			  </select>
			</div>
		  
			<label class="control-label col-sm-2" for="desti">Destination :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="desti" name="desti" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_adminar ORDER BY adm_lieu" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['adm_lieu']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="natcar">Nature :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="natcar" name="natcar" required>
				<option></option>
				<option>VIVRE</option>
				<option>NFI</option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="tonne">Tonnage :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="tonne" name="tonne" placeholder="En Tonne" required />
			</div>
		  
			<label class="control-label col-sm-2" for="vol">Volume :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="vol" name="vol" placeholder="En m3" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="proj">Projet :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="proj" name="proj" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="dist">Distance :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="dist" name="dist" placeholder="En Km" />
			</div>
		  
			<label class="control-label col-sm-2" for="dure">Dur&eacute;e :</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="dure" name="dure" placeholder="En Jour" required />
			</div>
		  </div>
		  
		  <!--div class="form-group row">
			<label class="control-label col-sm-3" for="obs">Observations :</label>
			<div class="col-sm-5">
			  <textarea id="obs" name="obs" class="form-control"></textarea>
			</div>
		  </div-->
		  
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