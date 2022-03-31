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
	
	$indx	= $mysqli->query("SELECT indexid AS IND FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$pers	= $indx["IND"];
	/*$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$pers'")->fetch_array();
	$contrat= $cpt["CONT"];
	
	if ($contrat != "SC" && $contrat != "SS")
	{
		header('Location:djoummahft.php');
	}*/
	
	include("inc/taarikh.php");
	include('inc/headers.php');
?>
<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar"></i> Cong&eacute;s</h1>
		<?php				
			$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
			$nopers = $exis['ID'];
			$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state=''")->fetch_array();		
			if($nb['nb']!=0)
			{
				echo ("<a href=\"vadjoummahaskdmd.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm\"><i class=\"fas fa-check fa-sm text-white-75\"></i> Confirmer Demande</a>");	
			}
			else
			{
				$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND (lv_state LIKE '%APPROUVE%' OR lv_state='' OR lv_state LIKE '%ATTENTE%') ")->fetch_array();		
				if($nb['nb']==0)
				{
					echo ("<a href=\"djoummahdmd.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm\"><i class=\"fas fa-edit fa-sm text-white-75\"></i> Nouvelle Demande</a>");
				}
				$nb2 = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='APPROUVE2'")->fetch_array();		
				if($nb2['nb']!=0)
				{
					echo ("<a href=\"djoummahaskconfdmd.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-danger shadow-sm\"><i class=\"fas fa-bell fa-sm text-white-75\"></i> Confirmer Reprise</a>");
				}
			}
		?>
		<a href="djoummahatt.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-list fa-sm text-white-75"></i> Liste des Demandes</a>
    </div>
	<hr />
    <!-- Content Row -->
    <div class="row">
		<div class="col-xl-6 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $nopers;?> | Vos Cong&eacute;s</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >					
					<?php
						require_once('config.php');
						require_once('verifications.php');
						include('connexion.php');
								
						$exis = $mysqli->query("SELECT leave_id AS ID FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_statu='' ")->fetch_array();
						$numb = $exis['ID'];
							
						if($numb != "")
						{
							echo("<table class=\"table table-bordered\">
								<thead>
									<tr>
										<th>Type de Cong&eacute;s</th>
										<th>Solde</th>
										<th>Au</th>
									</tr>
								</thead>");
										
							$sqlz 		= "SELECT * FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_statu='' " ;
							$requetez	= $mysqli->query( $sqlz );
									
							while( $resultz = $requetez->fetch_assoc())
							{
								$solde		= $resultz["leave_solde"];
								$type		= $resultz["leave_type"];
								$wakit		= $resultz["leave_ldate"];
								$ldate 		= date("Y-m-d");			
								$nbjour		= (strtotime($ldate)-strtotime($wakit))/86400;
								$rr			= 0;
										
								$duty = $mysqli->query("SELECT rh_duty AS DUT FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();		
								$duty = $duty['DUT'];
								$etat = $mysqli->query("SELECT rh_state AS ETA FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();		
								$etat = $etat['ETA'];
										
								if (($nbjour>=56) && ($etat=="National"))
								{
									$rr=4;
								}
								if (($nbjour>=42) && ($etat=="Expat") && ($duty=="BOL"))
								{
									$rr=7;
								}
								if (($nbjour>=56) && ($etat=="Expat") && ($duty!="BOL"))
								{
									$rr=7;
								}
										
								if ($type == "AL")
								{
									if ($ldate <= $wakit)
									{
										echo("<tbody><tr><td>".$type."</td>");
										echo("<td>".$solde."</td>");
										echo("<td>".$wakit."</td></tr></tbody>");
									}
									else
									{
										$nbjourcong = getEstimCalc($ldate,$wakit);
										$total		= $nbjourcong+$solde;
									
										echo("<tbody><tr><td>".$type."</td>");
										echo("<td>".$total."</td>");
										echo("<td>".$ldate."</td></tr></tbody>");
									}
								}
								else
								{
									if ($type == "R&R")
									{
										echo("<tbody><tr><td>".$type."</td>");
										echo("<td>".$rr."</td>");
										echo("<td>".$wakit."</td></tr></tbody>");
									}
									elseif ($wakit>=$ldate)
									{
										echo("<tbody><tr><td>".$type."</td>");
										echo("<td>".$solde."</td>");
										echo("<td>".$wakit."</td></tr></tbody>");
									}
								}
							}
							echo("</table>");
						}
						else
						{
							echo("<div class=\"alert alert-danger\">Aucun cong&eacute; sur votre Compte ...</div>") ;		
						}
					?>
				</table>
              </div>
            </div>
          </div>
	
	</div>
	</div>
    <!-- Content Row -->
	
	
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