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
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<!--
	<a href="addcontcongj.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-info shadow-sm"><i class="fas fa-calculator fa-sm text-black-75"></i> Jours/Cong&eacute;s/Contrats</a>
	<a href="addcontcongp.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-black-75"></i> Profils Staff</a>				
	<a href="addcontcongjf.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-warning shadow-sm"><i class="fas fa-calendar fa-sm text-black-75"></i> Jours F&eacute;ri&eacute;s</a>
-->

<style type="text/css"> .btn2{ width:180px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-wrench"></i> Gestion des Contrats et Cong&eacute;s</h1>
	  <a href="#" class="d-none d-sm-inline-block btn btn2 btn-sm btn-info shadow-sm"><i class="fas fa-calculator fa-sm text-black-75"></i> Jours/Cong&eacute;s/Contrats</a>
	  <a href="addcontcongp.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-black-75"></i> Profils Staff</a>				
	  <a href="#" class="d-none d-sm-inline-block btn btn2 btn-sm btn-warning shadow-sm"><i class="fas fa-calendar fa-sm text-black-75"></i> Jours F&eacute;ri&eacute;s</a>
	</div>
    <hr />
	
	<!-- Content Row -->
	<div class="row">
     
	  <div class="col-xl-4 col-md-6 mb-4">
	  <!-- Tables -->
        <div class="card shadow mb-8">
		  <a href="#collapseCardLV" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardLV">

            <h6 class="m-0 font-weight-bold text-info">
			  <i class="fas fa-fw fa-calendar"></i> Leaves System | Total:
			  <?php
				$sql1 = $mysqli->query("SELECT COUNT(lv_id) AS ID FROM wfp_chd_rqdjoummah")->fetch_array();
				echo $sql1['ID'];
			  ?>	
			</h6>
          </a>
		  <div class="collapse no-show" id="collapseCardLV">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" >					
				<ul class="list-group">
				  <?php
					$sql1a = "SELECT DISTINCT(lv_state) FROM wfp_chd_rqdjoummah ORDER BY lv_state";
					$req1a = $mysqli->query($sql1a);
					while ($res1a = $req1a->fetch_assoc())
					{
						$state	= $res1a['lv_state'];
						$sql1b 	= $mysqli->query("SELECT COUNT(lv_id) AS ID FROM wfp_chd_rqdjoummah WHERE lv_state='$state' ")->fetch_array();
						if ($state =='')
						{
							echo ("<li class=\"list-group-item\">NO_SOUMIS: <strong>".$sql1b['ID']."</strong></li>");
						}
						else
						{
							echo ("<li class=\"list-group-item\">".$state.": <strong>".$sql1b['ID']."</strong></li>");
						}
					}
				  ?>
				</ul> 
			  </table>
            </div>
          </div>
		  </div>
        </div>
	  </div>
	  
	  <div class="col-xl-4 col-md-6 mb-4">
	  <!-- Tables -->
        <div class="card shadow mb-8">
          <a href="#collapseCardHS" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardHS">

            <h6 class="m-0 font-weight-bold text-success">
			  <i class="fas fa-fw fa-hourglass-1"></i> CTO / HS | Total: 
			  <?php
				$sql2 = $mysqli->query("SELECT COUNT(cto_id) AS ID FROM wfp_chd_djmcto")->fetch_array();
				echo $sql2['ID'];
			  ?>	
			</h6>
			</h6>
          </a>
		  <div class="collapse no-show" id="collapseCardHS">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" >					
				<ul class="list-group">
				  <?php
					$sql2a = "SELECT DISTINCT(cto_statut) FROM wfp_chd_djmcto ORDER BY cto_statut";
					$req2a = $mysqli->query($sql2a);
					while ($res2a = $req2a->fetch_assoc())
					{
						$state	= $res2a['cto_statut'];
						$sql2b 	= $mysqli->query("SELECT COUNT(cto_id) AS ID FROM wfp_chd_djmcto WHERE cto_statut='$state' ")->fetch_array();

						echo ("<li class=\"list-group-item\">".$state.": <strong>".$sql2b['ID']."</strong></li>");
					}
				  ?>
				</ul> 
			  </table>
            </div>
          </div>
		  </div>
        </div>
	  </div>
	  
	  <div class="col-xl-4 col-md-6 mb-4">
	  <!-- Tables -->
        <div class="card shadow mb-8">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">
			  <i class="fas fa-fw fa-users"></i> Employ&eacute;s | Total: 
			  <?php
				$sql3 = $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel")->fetch_array();
				echo $sql3['ID'];
			  ?>
			</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" >					
				<ul class="list-group">
				  <?php
				  
					$sql3b1 	= $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel WHERE rh_statut='ACTIF' ")->fetch_array();
					$sql3b2 	= $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel WHERE rh_statut='INACTIF' ")->fetch_array();
					$sql3b3 	= $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel WHERE rh_state='National' ")->fetch_array();
					$sql3b4 	= $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel WHERE rh_state='Expat' ")->fetch_array();
					$sql3b5 	= $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel WHERE rh_statut='' ")->fetch_array();
					
					echo ("<li class=\"list-group-item\">ACT: <strong>".$sql3b1['ID']."</strong> -- INACT: <strong>".$sql3b2['ID']."</strong> -- STDBY: <strong>".$sql3b5['ID']."</strong></li>");
					echo ("<li class=\"list-group-item\">NATIONAL: <strong>".$sql3b3['ID']."</strong> ----- EXPAT: <strong>".$sql3b4['ID']."</strong></li>");
	
					echo'<hr />';
					$sql3c = "SELECT DISTINCT(rh_contrat) FROM wfp_chd_personnel ORDER BY rh_contrat";
					$req3c = $mysqli->query($sql3c);
					while ($res3c = $req3c->fetch_assoc())
					{
						$contra	= $res3c['rh_contrat'];
						$sql3d 	= $mysqli->query("SELECT COUNT(rh_id) AS ID FROM wfp_chd_personnel WHERE rh_contrat='$contra' ")->fetch_array();

						echo ("<li class=\"list-group-item\">".$contra.": <strong>".$sql3d['ID']."</strong></li>");
					}
				  ?>
				</ul> 
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
