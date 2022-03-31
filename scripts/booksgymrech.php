<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("inc/fonctionscalc.php");
	include('connexion.php');

	$yom 	= $_POST['wakit'];
	$jour	= date('l', strtotime($yom)); 
	$yom2	= date("d.m.Y",strtotime($yom));
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-search fa-sm text-black-75"></i> Recherche Booking S. Gym </h1>
	  <a href="booksgymlist.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste</a>				
	  <a href="#" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-calendar-check-o fa-sm text-black-75"></i> Mes Reservations</a>
	</div>
	<hr />   

	<!--row -->
    <div class="row">
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-calendar" fa-fw></i> Planning | S. Gym du <?php echo $jour." ".$yom2; ?></h6>
            </div> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
				  <table class="table table-striped table-bordered table-hover">
					<thead>
					  <tr>
						<th>Equipe</th>
						<th>Horaire</th>
						<th>Disponible</th>
					  </tr>
					</thead>
				  <?php				
					$sqlz 		= "SELECT * FROM wfp_chd_progym WHERE pgym_jour='$jour'" ;
					$requetez	= $mysqli->query( $sqlz );
									
					while( $resultz = $requetez->fetch_assoc())
					{
						$equipe = $resultz['pgym_eqp'];
						echo("<tbody><tr class=\"default\"><td>".$resultz['pgym_eqp']."</td>");
						echo("<td>".$resultz['pgym_deb']." &agrave; ".$resultz['pgym_fin']."</td>");
									
						$result = $mysqli->query("SELECT COUNT(*) AS nbr FROM wfp_chd_progymrv WHERE pgymrv_jour='$yom' AND pgymrv_eqp='$equipe' ")->fetch_array();;
						$nombre	= $result["nbr"];
								
						if ($nombre >= 5)
						{								
							echo("<td>NON</td>
							</tr></tbody>");
						}
						else
						{								
							echo("<td>OUI</td>");
							echo("</tr></tbody>");		
						}
					}
				  ?>
				  </table>
				</table>
              </div>
            </div>
          </div>
	  </div>
		
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
	  <div class="card shadow mb-8">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-check" fa-fw></i> V&eacute;rifier disponibilit&eacute;</h6>
        </div>
		<div class="card-body">
          <form class="form-horizontal" name="formulaire" action="booksgymrech.php" method="post" >					
			<div class="form-group row">
			  <label class="control-label col-sm-5" for="wakit">Date pr&eacute;visionnelle :</label>
			  <div class="col-sm-5">
				<input type="date" id="wakit" name="wakit" placeholder="aaaa-mm-jj OU mm/jj/aaaa" class="form-control" required />
			  </div>
			</div>
				
			<div class="form-group row">
			  <div class="col-sm-offset-4 col-sm-5">
				<button type="submit" class="btn btn3 btn-success"><i class="fa fa-check" fa-fw></i> V&eacute;rifier</button>
			  </div>
			</div>
		  </form>
		</div>
      </div>			
    </div>
	</div>
                      
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