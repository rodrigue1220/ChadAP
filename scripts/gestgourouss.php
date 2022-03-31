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
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	$auinc	= $mysqli->query("SELECT MAX(ID)+1 AS ID FROM wfp_chd_bilpp")->fetch_array();
	$auinc	= $auinc["ID"];
	
	$existe = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp WHERE STATE='IMPORT'")->fetch_array();
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:200px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-money fa-fw"></i> Gestion de Facturation </h1>
		<?php 
			if($existe['ID'] != 0)
				echo("<a href=\"importcsvend.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm\"><i class=\"fas fa-close fa-sm text-black-75\"></i> Terminer Import</a>");
		?>
		<a href="rapplistall.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-spinner fa-sm text-black-75"></i> Liste Rappels</a>
		<a href="factallfinance.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-danger shadow-sm"><i class="fas fa-money fa-sm text-black-75"></i> Facture Globale Fin.</a>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-warning fa-fw"></i> Facture (s) en Attente d'Identification</h6>
            </div>
            <div class="card-body">
             
                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" name="formulaire" action="rechfactnidenpm.php" method="get" onsubmit="return verif_formulaire()" >
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="cle">Mois :</label>
					  <div class="col-sm-9">
						<select class="form-control" id="cle" name="cle" required >
						  <?php
							$sqlb 	= "SELECT * FROM wfp_chd_month ORDER BY mth_id DESC" ;
							$requeteb = $mysqli->query( $sqlb ) ;

							while( $resultb = $requeteb->fetch_assoc() )
							{
								echo("<option> ".$resultb['mth_chahar']." </option>");
							}				
						  ?>
						</select>
					  </div>
					</div>
					<div class="form-group row">
					  <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" class="btn btn3 btn-danger"><i class="fa fa-search fa-fw"></i> Rechercher</button>
					  </div>
					</div>
				  </form>

				</table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card-shadow -->
      </div>
      <!-- /.col-lg- -->
	  
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-check fa-fw"></i> Facture (s) Identifi&eacute;e (s)</h6>
            </div>
            <div class="card-body">

                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" name="formulaire" action="rechfactidenpm.php" method="get" onsubmit="return verif_formulaire()" >
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="cle">Mois :</label>
					  <div class="col-sm-9">
						<select class="form-control" id="cle" name="cle" required >
						  <?php
							$sqlb 	= "SELECT * FROM wfp_chd_month ORDER BY mth_id DESC" ;
							$requeteb = $mysqli->query( $sqlb ) ;

							while( $resultb = $requeteb->fetch_assoc() )
							{
								echo("<option> ".$resultb['mth_chahar']." </option>");
							}				
						  ?>
						</select>
					  </div>
					</div>
					<div class="form-group row">
					  <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" class="btn btn3 btn-success"><i class="fa fa-search fa-fw"></i> Rechercher</button>
					  </div>
					</div>
				  </form>
				  
				</table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card-shadow -->
      </div>
      <!-- /.col-lg- -->
	  
	</div>
    <!-- /.row -->
	
	<div class="row">
		<div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-secondary"><i class="fas fa-search fa-fw"></i> Rechercher Facture</h6>
            </div>
            <div class="card-body">

                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" action="rechfactnum.php" method="get" >
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="num">Num&eacute;ro :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="num" name="num" required />
					  </div>
					</div>
					<div class="form-group row">
					  <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" class="btn btn3 btn-secondary"><i class="fa fa-search fa-fw"></i> Rechercher</button>
					  </div>
					</div>
				  </form>
				
				</table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card-shadow -->
		</div>
		<!-- /.col-lg- -->
		
		<div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-upload fa-fw"></i> Importer Nouvelle Facture | Last ID: <?php echo $auinc; ?></h6>
            </div>
            <div class="card-body">

                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" enctype="multipart/form-data" action="importcsv.php" method="post" >
					<div class="form-group row">
					  <label class="control-label col-sm-5" for="choix">Choisir un fichier CSV :</label>
					  <div class="col-sm-7">
						<input type="file" class="form-control" name="file" id="file" accept=".csv" required />
					  </div>
					</div>
					<div class="form-group row">
					  <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" name="import" class="btn btn3 btn-warning"><i class="fa fa-upload fa-fw"></i> Importer</button>
					  </div>
					</div>
				  </form>
				
				</table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card-shadow -->
		</div>
		<!-- /.col-lg- -->
		
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