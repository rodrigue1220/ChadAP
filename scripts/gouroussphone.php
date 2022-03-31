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
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tty"></i> Billing System</h1>
		<?php 
			$exis = $mysqli->query("SELECT tel AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
			$phone = $exis['ID'];
			echo("<a href=\"factchahar.php?tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm\" title=\"Mes Factures\"><i class=\"fas fa-newspaper-o fa-sm text-white-75\"></i> MES FACTURES</a>");
		?>
	</div>
	<hr />
    <!-- Content Row -->
    <div class="row">
	  <div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Num&eacute;ro (s) Assign&eacute; (s) / Personnel</h6>
            </div> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
				<?php
					if($phone != 0)
					{
						$exist = $mysqli->query("SELECT tel2 AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
						$phone2 = $exist['ID'];
							
						echo("<table class=\"table table-striped table-bordered table-hover\">
								<thead><tr>
								<th>#</th>
								<th>Num&eacute;ro</th>
								<th>Op&eacute;rateur</th>
							</tr></thead>");
						echo("<tbody><tr class=\"default\"><td>1</td>");
						echo("<td>".$phone."</td>");
						echo("<td>AIRTEL</td></tr></tbody>");
									
						if($phone2 != 0)
						{
							echo("<tbody><tr class=\"default\"><td>2</td>");
							echo("<td>".$phone2."</td>");
							echo("<td>AIRTEL</td></tr></tbody>");
						}
						echo("</table>");
					}
					else
					{
						echo("<div class=\"alert alert-warning\">Aucun Num&eacute;ro Assign&eacute; ...</div>") ;		
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
              <h6 class="m-0 font-weight-bold text-primary">Facture (s) en Attente d'Identification</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">			
				<?php
					$i=1;
					$tel = $mysqli->query("SELECT tel AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
					$phone = $tel['ID'];
					$tel2 = $mysqli->query("SELECT tel2 AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
					$phone2 = $tel2['ID'];
								
					$exis = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_bilpp WHERE (MSISDN_NO='$phone' OR MSISDN_NO='$phone2') AND STATE='ATTENTE' ")->fetch_array();
					$exis2 = $mysqli->query("SELECT COUNT(*) AS nb2 FROM wfp_chd_bilpp_archv WHERE (MSISDN_NO='$phone' OR MSISDN_NO='$phone2') AND STATE='ATTENTE' ")->fetch_array();
					
					if($exis['nb'] != 0 || $exis2['nb2'] != 0)
					{
						echo("<table class=\"table\">
							<thead><tr>
							<th>#</th>
							<th>Mois</th>
							<th>Num&eacute;ro</th>
							<th></th>
						</tr></thead>");
						
						$sql = "SELECT DISTINCT MONTH, MSISDN_NO  FROM wfp_chd_bilpp WHERE (MSISDN_NO='$phone' OR MSISDN_NO='$phone2') AND STATE='ATTENTE' " ;
						$requete = $mysqli->query( $sql ) ;
						while( $result = $requete->fetch_assoc()  )
						{		
							$phone = $result['MSISDN_NO'];
							$mois = $result['MONTH'];
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$mois."</td>");
							echo("<td>".$phone."</td>");	 
							echo("<td><a href=\"gouroussfact.php?opt=new&chahar=".$mois."&tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn-sm btn-success shadow-sm\" title=\"Identification\"><i class=\"fa fa-thumb-tack\" fa-fw></i> Identifier les Appels</a></td></tr>");
							$i++;
						}
						$sql2 = "SELECT DISTINCT MONTH, MSISDN_NO  FROM wfp_chd_bilpp_archv WHERE (MSISDN_NO='$phone' OR MSISDN_NO='$phone2') AND STATE='ATTENTE' " ;
						$requete2 = $mysqli->query( $sql2 ) ;
						while( $result2 = $requete2->fetch_assoc()  )
						{		
							$phone = $result2['MSISDN_NO'];
							$mois = $result2['MONTH'];
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$mois."</td>");
							echo("<td>".$phone."</td>");	 
							echo("<td><a href=\"gouroussfact.php?opt=archv&chahar=".$mois."&tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn-sm btn-success shadow-sm\" title=\"Identification\"><i class=\"fa fa-thumb-tack\" fa-fw></i> Identifier les Appels</a></td></tr>");
							$i++;
						}
						echo("</tbody></table>");
					}
					else
					{
						echo("<div class=\"alert alert-warning\">Aucune Facture en Attente...</div>") ;		
					}
				?>
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