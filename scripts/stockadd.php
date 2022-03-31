<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminSTOCK")
	{
		header('Location:accueil.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"> Entr&eacute;e / Sortie du Stock </h1>
	  <a href="articadd.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-plus fa-sm text-black-75"></i> Nouvel Article</a>				
      <a href="stockvar.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-bar-chart fa-sm text-black-75"></i> Variations Stock</a>				
      <a href="geststock.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-cart-arrow-down fa-sm text-black-75"></i> Stock Disponible</a>	
	</div>
	<hr />   
    
	<!--row -->
    <div class="row">
	 <div class="col-lg-6">
      <form name="formulaire" action="stockadd2.php" method="post" onsubmit="return verif_formulaire()" >
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="item">Item Description :</label>
		  <div class="col-sm-8">
			<select class="form-control" id="item" name="item" required>
			  <option></option>
			  <?php
				$sqlb 	= "SELECT DISTINCT catart_nom FROM wfp_chd_catart WHERE catart_type='ART' AND catart_lib!='FOURN' ORDER BY catart_nom" ;
				$requeteb = $mysqli->query( $sqlb ) ;
				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['catart_nom']." </option>");
				}				
			  ?>
			</select>
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="nbr">Nombre :</label>
		  <div class="col-sm-8">
			<input type="text" id="nbr" name="nbr" class="form-control" required />
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="rq">Remarques :</label>
		  <div class="col-sm-8">
			<input type="text" id="rq" name="rq" class="form-control" required />
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="sens">Sens :</label>
		  <div class="col-sm-8">
			<select class="form-control" id="sens" name="sens" required>
			  <option></option>
			  <option>ENTREE</option>
			  <option>SORTIE</option>
			</select>
		  </div>
		</div>
		
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="date">Date :</label>
		  <div class="col-sm-8">
			<input type="date" id="date" name="date" class="form-control" required />
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