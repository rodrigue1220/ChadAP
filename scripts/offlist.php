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
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-institution"></i> Bureaux RBD Chad</h1>
	  <a href="add1user.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm" title="Nouvel Utilisateur"><i class="fas fa-user-plus fa-fw"></i> Nouvel User</a>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-8">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des bureaux et effectifs enregistr&eacute;s</h6>
          </div>
		  <?php
			echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");
			
			$i=1;
			$exis = $mysqli->query("SELECT goffu_id AS ID FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ")->fetch_array();
			if($exis['ID'] != 0)
			{
				$sql = "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ORDER BY goffu_type" ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>#</th>
					<th>Type</th>
					<th>Lieu</th>
					<th>Description</th>
					<th>Effectif</th>
					<th></th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					$nom		= $result['goffu_offlieu'];
					$nb 		= $mysqli->query("SELECT COUNT(*) AS nb FROM user WHERE unite LIKE '%$nom%' ")->fetch_array(); 
					$effectif	= $nb['nb'];
					echo("<tbody><tr><td>".$i."</td>");
					echo("<td>".$result['goffu_type']."</td>");	
					echo("<td>".$result['goffu_offlieu']."</td>");
					echo("<td>".$result['goffu_details']."</td>");
					echo("<td>".$effectif."</td>");
					echo("<td><a href=\"userlistoff.php?id=".$nom."\" title=\"DETAILS\" class=\"d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm\"><i class=\"fa fa-list\"></i></a></td></tr></tbody>");
									
					$i++;
				}
			}
			else
			{
				echo("<div class=\"alert alert-info\">Aucun enregistrement...</div>") ;		
			}
		  ?>				
 </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card shadow -->
      </div>
      <!-- /.col-lg-12 -->
	</div>
	<!--row -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	  
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