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
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	$mois= $_GET["cle"];
	$tot=$mysqli->query("SELECT SUM(rec_totpriv) AS TOT FROM wfp_chd_recapbil WHERE rec_mois='$mois' AND rec_statefin='NOPRINT' ")->fetch_array();
	$total=$tot['TOT'];
	$totn=$mysqli->query("SELECT COUNT(rec_phone) AS TOT FROM wfp_chd_recapbil WHERE rec_mois='$mois' AND rec_statefin='NOPRINT' ")->fetch_array();
	$totaln=$totn['TOT'];
								
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<script type="text/javascript" src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="http://10.109.87.10:8080/scripts/js/bootstrap.min.js"></script>

<style type="text/css"> .btn3{ width:200px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-fw fa-money"></i> Facturation T&eacute;l&eacute;phonique </h1>
	  <?php 
		$mois= $_GET["cle"];
		$exist = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_mois='$mois' AND rec_statefin='NOPRINT' ")->fetch_array();						
		if($exist['ID'] != 0)
		{
			echo("<a href=\"imprfact.php?cle=".$mois."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm\"><i class=\"fa fa-print fa-sm text-black-75\"></i> Imprimer Facture</a>");
			echo("<a href=\"validfact.php?cle=".$mois."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm\"><i class=\"fa fa-check fa-sm text-black-75\"></i> Valider Impression</a>");
		}
	  ?>
	</div>
	<hr />   
	
	<!--row -->
	<div class="row-lg-auto"> 
	<div class="alert alert-success" size="-2">Une fois l'impression validée, il n'y aura plus de FACTURE disponible</div>
		

	  <div class="col-lg-auto">
		<div class="card shadow mb-4">
		  <div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				<?php 
					echo ("Facture pour Unit&eacute; Finance  <br />Nombre num&eacute;ros: <strong>".$totaln."</strong><br />P&eacute;riode: <strong>".$mois."</strong>, Total : <strong>".number_format($total,2,',','.')." FCFA</strong>"); 
				?>
			</h6>
		  </div>
		  <div class="card-body">
			<div class="table-responsive">
							
			  <?php
				$i=1;

				$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_mois='$mois' AND rec_statefin='NOPRINT'")->fetch_array();
						
				if($exis['ID'] != 0)
				{
					echo("<table class=\"table\">
						<thead><tr>
							<th>#</th>
							<th>Cl&eacute;</th>
							<th>Utilisateur</th>
							<th>Num&eacute;ro</th>
							<th>Montant (FCFA)</th>
						</tr></thead>");
											
					$sql = "SELECT * FROM wfp_chd_recapbil WHERE rec_mois='$mois' AND rec_statefin='NOPRINT' ORDER BY rec_phone " ;
					$requete = $mysqli->query( $sql ) ;
					while( $result = $requete->fetch_assoc()  )
					{	
						$phone		= $result['rec_phone'];
						$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ORDER BY nom ";
						$requetep	= $mysqli->query( $sqlp );
						$resultp 	= $requetep->fetch_assoc();
						$nom  		= $resultp['nom'];
						$pnom 		= $resultp['prenom'];
								
						echo("<tbody><tr class=\"default\"><td>".$i."</td>");
						echo("<td>".$result['rec_id']."</td>");
						echo("<td>".$nom." ".$pnom."</td>");
						echo("<td>".$result['rec_phone']."</td>");	 
						echo("<td>".number_format($result['rec_totpriv'],2,',','.')."</td>");
						$i++;
					}
					echo("</tr></tbody></table>");
				}
				else
				{
					echo("<div class=\"alert alert-warning\">Aucune Facture Disponible...</div>") ;	
				}
			  ?>
 </div>
	      </div>
		</div>
      </div>
	</div>
		
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