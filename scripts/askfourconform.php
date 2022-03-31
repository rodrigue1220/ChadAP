<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');;
	include('connexion.php');
	
	$ref	= $_GET['cle'];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"> Soumettre Demande de fourniture (s) </h1>
	  <a href="askfour.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Demande (s)</a>				
    </div>
	<hr />   
    
	<!--row -->
    <div class="row">
	 <div class="col-lg-6">
      <form name="formulaire" action="askfour3.php" method="post" onsubmit="return verif_formulaire()" >
		<input type="hidden" id="cle" name="cle" value="<?php echo $ref; ?>" />
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="motif">Raison :</label>
		  <div class="col-sm-8">
			<input type="text" id="motif" name="motif" maxlength="30" placeholder="Soyez BREF" class="form-control" required />
		  </div>
		</div>
					
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="oic">Responsable (OIC) :</label>
		  <div class="col-sm-8">
			<select class="form-control" id="oic" name="oic" required>
			  <option></option>
			  <?php	
				$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
				$requet = $mysqli->query( $sqle );
				$resulte = $requet->fetch_assoc();
									
				$unite	= $resulte['unite'];
				$nom	= $resulte['nom'];
				$prenom	= $resulte['prenom'];
				$sofo	= substr(stristr($unite, '/'), 1);
									
				if ($sofo != "NDJAM")
				{
					$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$sofo' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
					}										
				}
				$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
				$requeteb = $mysqli->query( $sqlb ) ;
				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
				}
			  ?>
			</select>
		  </div>
		</div>     
		
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-12">
			<button type="submit" class="btn btn3 btn-warning"><i class="fa fa-check fa-fw"></i> Soumettre</button>
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