<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	include("inc/taarikh.php");
	include('inc/headers.php');
?>

<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-line-chart"></i> Chad Stock Report</h1>
		<a href="logstkreport.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fa fa-cart-arrow-down fa-sm text-white-75"></i> In Stock</a>
		<a href="logstktransit.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fa fa-exchange fa-sm text-white-75"></i> In Transit</a>
		
	</div>
	<hr />
    <!-- Content Row -->
    <div class="row">
	  <div class="col-xl-auto col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-fw fa-calculator"></i> Cumul</h6>
            </div> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
				
				  <table class="table table-striped table-bordered table-hover">
					<thead><tr>
					  <th>#</th>
					  <th>Sub-Office</th>
					  <th>Warehouse</th>
					  <th>In Stock</th>
					  <th>In Transit</th>
					</tr></thead>
				    <tbody>
					<?php
						$i = 1;
						$sqlb 		= "SELECT * FROM wfp_chd_logconf WHERE logc_type='WH' ORDER BY logc_lib" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;

						while( $resultb = $requeteb->fetch_assoc() )
						{
							$wh		= $resultb["logc_nom"];
								
							$cum	= $mysqli->query("SELECT SUM(logs_total) AS TOT FROM wfp_chd_logstock WHERE logs_wh='$wh'")->fetch_array();
							$cumul	= $cum["TOT"];
							
							$cum2	= $mysqli->query("SELECT SUM(logt_netdeliv) AS TOT FROM wfp_chd_logtransit WHERE logt_destiwh='$wh'")->fetch_array();
							$cumul2	= $cum2["TOT"];
						
							echo("<tr><td>".$i."</td>");
							echo("<td>".$resultb["logc_lib"]."</td>");
							echo("<td>".$wh."</td>");
							echo("<td>".$cumul."</td>");
							echo("<td>".$cumul2."</td></tr>");
							$i = $i+1;
						}
						echo("</tbody></table>");
					?>
				</table>
              </div>
            </div>
          </div>
	  </div>
	  
	</div>
    <!-- /.row -->
		
	
		</div>
        <!-- /.container-fluid -->	
		
		<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	
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