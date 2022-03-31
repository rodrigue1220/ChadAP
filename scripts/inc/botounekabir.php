<?php
/**
* @author Zaki IZZO <izzo.z@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
require_once('config.php');
include('headers.php');
?>


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
            <!--a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a-->
          </div>

          <!-- Content Row -->
          <div class="row">
		
			<!-- Users Card -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM user WHERE pseudo!='administrateur' ")->fetch_array(); echo $nb['nb']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Offices Card -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Offices</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ")->fetch_array(); echo $nb['nb']; ?></div>
                        </div>
                        <!--div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div-->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-institution fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Units Card -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unit&eacute;s </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_gestoffu WHERE goffu_type='UNITE' ")->fetch_array(); echo $nb['nb']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content Row -->
		  
		  <div class="row-lg-8">
            <div class="panel panel-success">

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">                      
					<?php
						require_once('config.php');
						require_once('verifications.php');
						include('connexion.php');

						$nbsdr = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_requestsdr")->fetch_array();
						$nbsdr = $nbsdr['nb'];
								
						$nbreq = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request")->fetch_array();
						$nbreq = $nbreq['nb'];
								
						$nbreqp = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_requesteqpmt")->fetch_array();
						$nbreqp = $nbreqp['nb'];
								
						$nbreqdj = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah")->fetch_array();
						$nbreqdj = $nbreqdj['nb'];
								
						echo("<table class=\"table table-striped table-bordered table-hover\">
							<thead>
								<tr>
									<th>Demandes SDR c&eacute;&eacute;es</th>
									<th>Demandes Transport c&eacute;&eacute;es</th>
									<th>Demandes Equipement c&eacute;&eacute;es</th>
									<th>Demandes Cong&eacute;s c&eacute;&eacute;es</th>
								</tr>
							</thead>");
		
						echo("<tbody><tr class=\"default\"><td>".$nbsdr."</td>");
						echo("<td>".$nbreq."</td>");
						echo("<td>".$nbreqp."</td>");
						echo("<td>".$nbreqdj."</td>");
						echo("</tr></tbody></table>");
					?>			
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
          </div>
          <!-- /.col-lg-8 -->
       
		
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
