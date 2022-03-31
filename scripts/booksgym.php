<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');;
	include('connexion.php');
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-calendar fa-sm text-black-75"></i> Booking S. Gym </h1>
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
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-calendar" fa-fw></i> Planning | S. Gym</h6>
            </div> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
							
				<?php
								
					$exis = $mysqli->query("SELECT pgym_id AS ID FROM wfp_chd_progym ")->fetch_array();
					$numb = $exis['ID'];
								
					if($numb != "")
					{
						echo("<table class=\"table table-striped table-bordered table-hover\">
						<thead>
						<tr>
							<th>Jour</th>
							<th>Horaire</th>
							<th>Equipe</th>
						</tr>
						</thead>");
										
						$sqlz 		= "SELECT * FROM wfp_chd_progym" ;
						$requetez	= $mysqli->query( $sqlz );
									
						while( $resultz = $requetez->fetch_assoc())
						{
							echo("<tbody><tr class=\"default\"><td>".$resultz['pgym_jourf']."</td>");
							echo("<td>".$resultz['pgym_deb']." &agrave; ".$resultz['pgym_fin']."</td>");
							echo("<td>".$resultz['pgym_eqp']."</td></tr></tbody>");
						}
						echo("</table>");
					}
					else
					{
						echo("<div class=\"alert alert-danger\">Aucun planning ...</div>") ;		
					}
				?>
           </table>
              </div>
            </div>
          </div>
	  </div>
           
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-calendar-check-o" fa-fw></i> R&eacute;server</h6>
            </div> 
            <div class="card-body">
              <form class="form-horizontal" name="formulaire" action="booksgym2.php" method="post" >					
				<div class="form-group row">
					<label class="control-label col-sm-2" for="wakit">Date :</label>
					<div class="col-sm-8">
						<input type="date" id="wakit" name="wakit" placeholder="aaaa-mm-jj OU mm/jj/aaaa" class="form-control" required />
					</div>
				</div>
				
				<div class="form-group row">
					<label class="control-label col-sm-2" for="deb">De :</label>
					<div class="col-sm-4">
						<input type="time" id="deb" name="deb" class="form-control" required />
					</div>
					<label class="control-label col-sm-2" for="fin">A :</label>
					<div class="col-sm-4">
						<input type="time" id="fin" name="fin" class="form-control" required />
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-offset-4 col-sm-5">
						<button type="submit" class="btn btn3 btn-primary"><i class="fa fa-calendar-check-o" fa-fw></i> R&eacute;server</button>
					</div>
				</div>
			  </form>
			</div>
          </div>
		  
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

  <!-- Core plugin JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="http://10.109.87.10:8080/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://10.109.87.10:8080/js/demo/chart-area-demo.js"></script>
  <script src="http://10.109.87.10:8080/js/demo/chart-pie-demo.js"></script>

</body>

</html>