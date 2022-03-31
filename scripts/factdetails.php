<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$phone	= $_GET["tel"];
	$opt 	= $_GET["opt"];
	$mois 	= $_GET["cle"];
	$page 	= $_GET["page"];
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	$numero	= $mysqli->query("SELECT tel AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phone2	= $numero["num"];
	
	$numer2	= $mysqli->query("SELECT tel2 AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phon2	= $numer2["num"];
	
	if (($profil != "AdminBILLING") && (($phone2 != $phone) && ($phon2 != $phone)))
	{
		header('Location:gouroussphone.php');
	}

	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails des Appels T&eacute;l&eacute;phoniques et SMS</h1>
	  <?php
		if ($opt=="archv")
		{
			echo("<a href=\"factchar_archv.php?tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm\" title=\"Retour Factures\"><i class=\"fa fa-reply fa-sm text-white-75\"></i> Retour</a>");
	  	}
		else
		{
			echo("<a href=\"rechfactnidenpm.php?cle=".$mois."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm\" title=\"Retour Factures\"><i class=\"fa fa-reply fa-sm text-white-75\"></i> Retour</a>");
	  	}
	  ?>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-12">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo ("Mois: ".$_GET["cle"]." | Num&eacute;ro: ".$_GET["tel"]); ?></h6>
          </div>	
		  <?php
			echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");
			
			$i=1;					
			if ($opt=="archv")
			{
				$exis = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp_archv WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699' AND STATE!='ANNULE' AND STATE!='STANDBY' ")->fetch_array();
			}
			else
			{
				$exis = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699' AND STATE!='ANNULE' AND STATE!='STANDBY'")->fetch_array();
			}
			
			if($exis['ID'] != 0)
			{
				echo("<thead><tr>
					<th>#</th>
					<th>Num&eacute;ro App&eacute;l&eacute;</th>
					<th>Date et Heure</th>
					<th>Dur&eacute;e (s)</th>
					<th>Type</th>
					<th>Terminaison</th>
					<th>Montant (FCFA)</th>
				</tr></thead>");
				
				if ($opt=="archv")
				{		
					$sql = "SELECT * FROM wfp_chd_bilpp_archv WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699' AND STATE!='ANNULE' ORDER BY START_TIME" ;
				}
				else
				{		
					$sql = "SELECT * FROM wfp_chd_bilpp WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699' AND STATE!='ANNULE' ORDER BY START_TIME" ;
				}
				
				$requete = $mysqli->query( $sql ) ;
				while( $result = $requete->fetch_assoc()  )
				{		
					$id = $result['ID'];
					echo("<tbody><tr><td>".$i."</td>");
					echo("<td>".$result['CALLED_NO']."</td>");
					echo("<td>".$result['START_TIME']."</td>");	 
					echo("<td>".$result['CALL_DURATION']."</td>");
					echo("<td>".$result['ORIGINAL_CALL_TYPE']."</td>");
					echo("<td>".$result['TERMINATING_COUNTRY']."</td>");
					echo("<td>".$result['CHARGABLE_AMOUNT']."</td>");
					$i++;
				}
				echo("</tr></tbody>");
			}
			else
			{
				echo("<div class=\"alert alert-warning\">Aucun D&eacute;tail...</div>") ;	
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