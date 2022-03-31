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
	
	if ($profil != "AdminLOGSTK")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:150px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-plus"></i> New WH / Lieu</h1>
		<a href="logstkreport.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-chart-line fa-sm text-white-75"></i> Stock Report</a>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-plus fa-fw"></i> Ajouter Warehouse</h6>
            </div>
            <div class="card-body">
             
                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" name="formulaire" action="addlogconfwh.php" method="post" >
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="wh">Libelle :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="wh" name="wh" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="orig">Sub-Office :</label>
					  <div class="col-sm-9">
						<select class="form-control" id="orig" name="orig" required >
						  <?php
							$sqlb 	= "SELECT DISTINCT logc_lib FROM wfp_chd_logconf WHERE logc_type='WH' ORDER BY logc_lib" ;
							$requeteb = $mysqli->query( $sqlb ) ;

							while( $resultb = $requeteb->fetch_assoc() )
							{
								echo("<option> ".$resultb['logc_lib']." </option>");
							}				
						  ?>
						</select>
					  </div>
					</div>

					<div class="form-group row">
					  <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
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
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus fa-fw"></i> Cr&eacute;er Origine</h6>
            </div>
            <div class="card-body">

                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" name="formulaire" action="addlogconforig.php" method="get" >
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="orig">Libelle :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="orig" name="orig" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="comm">D&eacute;tails :</label>
					  <div class="col-sm-9">
						<textarea class="form-control" id="comm" name="comm" >
						  
						</textarea>
					  </div>
					</div>

					<div class="form-group row">
					  <div class="col-sm-offset-2 col-sm-6">
					    <button type="submit" class="btn btn3 btn-primary"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
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