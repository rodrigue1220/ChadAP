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
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
<script src="http://10.109.87.10:8080/scripts/js/bootstrap.min.js"></script>

<style type="text/css"> .btn2{ width:150px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-wrench"></i> Gestion du Parc et Param&egrave;trages</h1>
	  <a href="addcam.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-info shadow-sm"><i class="fas fa-truck fa-sm text-black-75"></i> Camions</a>
	  <a href="addadmin.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-success shadow-sm"><i class="fas fa-globe fa-sm text-black-75"></i> Areas-Warehouse</a>				
	  <a href="addchauf.php" class="d-none d-sm-inline-block btn btn2 btn-sm btn-warning shadow-sm"><i class="fas fa-drivers-license fa-sm text-black-75"></i> Drivers</a>				
	</div>
    <hr />
	
	<!-- Content Row -->
	<div class="row">
     
	  <div class="col-xl-4 col-md-6 mb-4">
	  <!-- Tables -->
        <div class="card shadow mb-8">
		  <a href="#collapseCardCAM" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardCAM">

            <h6 class="m-0 font-weight-bold text-info">
			  <i class="fas fa-fw fa-truck"></i> Camions | Total:
			  <?php
				$sql1 = $mysqli->query("SELECT COUNT(cam_id) AS ID FROM wfp_chd_cam")->fetch_array();
				echo $sql1['ID'];
			  ?>	
			</h6>
          </a>
		  <div class="collapse show" id="collapseCardCAM">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" >					
				<ul class="list-group">
				  <?php
					if ($sql1['ID']==0)
					{
						echo("<div class=\"alert alert-danger\">Aucun Camion enregistr&eacute; ...</div>") ;
					}
					else
					{
						$sql1a = "SELECT * FROM wfp_chd_cam ORDER BY cam_plaq";
						$req1a = $mysqli->query($sql1a);
						while ($res1a = $req1a->fetch_assoc())
						{
							echo ("<li class=\"list-group-item\"><strong>".$res1a['cam_plaq']." : ".$res1a['cam_capa']."</strong> T / <strong>".$res1a['cam_vol']."</strong> m3</li>");
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
		  <a href="#collapseCardADM" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardADM">

            <h6 class="m-0 font-weight-bold text-success">
			  <i class="fas fa-fw fa-globe"></i> Admin Areas | Total:
			  <?php
				$sql1 = $mysqli->query("SELECT COUNT(adm_id) AS ID FROM wfp_chd_adminar")->fetch_array();
				echo $sql1['ID'];
			  ?>	
			</h6>
          </a>
		  <div class="collapse no-show" id="collapseCardADM">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" >					
				<ul class="list-group">
				  <?php
					if ($sql1['ID']==0)
					{
						echo("<div class=\"alert alert-danger\">Aucun Lieu enregistr&eacute; ...</div>") ;
					}
					else
					{
						$sql1a = "SELECT * FROM wfp_chd_adminar ORDER BY adm_lieu";
						$req1a = $mysqli->query($sql1a);
						while ($res1a = $req1a->fetch_assoc())
						{
							echo ("<li class=\"list-group-item\">".$res1a['adm_reg']." > ".$res1a['adm_dept']." > ".$res1a['adm_sp']." > <strong>".$res1a['adm_lieu']."</strong></li>");
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
		  <a href="#collapseCardDRV" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardDRV">

            <h6 class="m-0 font-weight-bold text-warning">
			  <i class="fas fa-fw fa-drivers-license"></i> Drivers | Total:
			  <?php
				$sql1 = $mysqli->query("SELECT COUNT(chauf_id) AS ID FROM wfp_chd_chauffeur")->fetch_array();
				echo $sql1['ID'];
			  ?>	
			</h6>
          </a>
		  <div class="collapse show" id="collapseCardDRV">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" >					
				<ul class="list-group">
				  <?php
					if ($sql1['ID']==0)
					{
						echo("<div class=\"alert alert-danger\">Aucun Driver enregistr&eacute; ...</div>") ;
					}
					else
					{
						$sql1a = "SELECT * FROM wfp_chd_chauffeur ORDER BY chauf_nom";
						$req1a = $mysqli->query($sql1a);
						while ($res1a = $req1a->fetch_assoc())
						{
							echo ("<li class=\"list-group-item\"><strong>".$res1a['chauf_nom']." ".$res1a['chauf_pnom']."</strong></li>");
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
