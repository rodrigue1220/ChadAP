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
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-line-chart"></i> Chad Stock Report</h1>
		<a href="logstktransit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fa fa-exchange fa-sm text-white-75"></i> In Transit</a>
	</div>	
	<hr />
	<div class="row">
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus fa-fw"></i> Ajouter In Stock</h6>
            </div>
            <div class="card-body">
             
                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" name="formulaire" action="addlogstk.php" method="post">
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="wh">Warehouse :</label>
					  <div class="col-sm-9">
						<select class="form-control" id="wh" name="wh" required >
						  <?php
							$sqlb 	= "SELECT DISTINCT logc_nom FROM wfp_chd_logconf WHERE logc_type='WH' " ;
							$requeteb = $mysqli->query( $sqlb ) ;

							while( $resultb = $requeteb->fetch_assoc() )
							{
								echo("<option> ".$resultb['logc_nom']." </option>");
							}				
						  ?>
						</select>
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="mdesc">Mat. Desc. :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="mdesc" name="mdesc" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="batch">Batch :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="batch" name="batch" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="WBS">WBS :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="wbs" name="wbs" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="gnum">Grant Num. :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="gnum" name="gnum" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="gdesc">Grant Desc. :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="gdesc" name="gdesc" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="bbd">SLED/BBD :</label>
					  <div class="col-sm-9">
						<input type="date" class="form-control" id="bbd" name="bbd" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="total">Tot. Stock :</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="total" name="total" required >
					  </div>
					</div>
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="gtdd">TDD Grant :</label>
					  <div class="col-sm-9">
						<input type="date" class="form-control" id="gtdd" name="gtdd" required >
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
	  
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-6">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-secondary"><i class="fas fa-search fa-fw"></i> Rechercher et Modifier</h6>
            </div>
            <div class="card-body">

                <table class="table table-bordered" >
				  
				  <form class="form-horizontal" name="formulaire" action="rechlogstkreport.php" method="get">
					<div class="form-group row">
					  <label class="control-label col-sm-3" for="pwh">Par WH :</label>
					  <div class="col-sm-9">
						<select class="form-control" id="pwh" name="pwh">
						  <option></option>
						  <?php
							$sqlb 	= "SELECT DISTINCT logc_nom FROM wfp_chd_logconf WHERE logc_type='WH' " ;
							$requeteb = $mysqli->query( $sqlb ) ;

							while( $resultb = $requeteb->fetch_assoc() )
							{
								echo("<option> ".$resultb['logc_nom']." </option>");
							}				
						  ?>
						</select>
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