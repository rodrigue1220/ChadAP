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
	
	if ($_GET["id"] == "")
	{
		header('Location:rechdjmrh.php');
	}
	
	$pivot	= $_GET["id"];
	$pers	= $_GET["nopers"];
	$page	= $_GET["page"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
	include("inc/fonctionscalcul.php");
	//include("inc/fonctionscalc.php");	
?>

<style type="text/css"> .btn3{ width:180px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de la demande de Cong&eacute;s n&deg; <font color="red"><i><?php echo $_GET["id"];?></i></font></h1>
	</div>
    <hr />   

	<!-- Content Row -->
    <div class="row">
		<?php	

			$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$pivot'" ;
			$requete = $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc(); 
			$nopers	= $result['lv_nopers'];
				
			$sqlp		= "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$nopers'";
			$requetep 	= $mysqli->query( $sqlp ) ;
			$resultp 	= $requetep->fetch_assoc(); 
			$contrat	= $resultp['rh_contrat'];
			$nom		= $resultp['rh_lname'];
			$prenom		= $resultp['rh_fname'];

			$wakit	= $result['lv_deb1'];
			$ret	= $result['lv_fin1'];
			$typ1	= $result['lv_type1'];
			$typ2	= $result['lv_type2'];
			$typ3	= $result['lv_type3'];
			$typ4	= $result['lv_type4'];
			$reprise= $result['lv_rep'];
			if ($typ2 =="")
				$typ2 = "N/A";
			if ($typ3 =="")
				$typ3 = "N/A";
			if ($typ4 =="")
				$typ4 = "N/A";
	
			echo("<div class=\"col-lg-auto\">
					<div class=\"table-responsive\">");			

			echo("<table class=\"table table-striped table-bordered table-hover\">
				<tbody>
					<tr><th>Cr&eacute;&eacute;e le</th><td>".$result['lv_date']."</td></tr>
					<tr><th>Demandeur</th><td>".$nom." ".$prenom."</td></tr>
					<tr><th>Duty</th><td>".$resultp['rh_duty']."</td></tr>
					<tr><th>Type de cong&eacute;: <i>".$typ1."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb1']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin1']))."</b>, Nombre : <b>".$result['lv_nbr1']."</b></td></tr>");
					if ($typ2 !="N/A")
					echo("<tr><th>Type de cong&eacute;: <i>".$typ2."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb2']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin2']))."</b>, Nombre : <b>".$result['lv_nbr2']."</b></td></tr>");
					if ($typ3 !="N/A")
						echo("<tr><th>Type de cong&eacute;: <i>".$typ3."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb3']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin3']))."</b>, Nombre : <b>".$result['lv_nbr3']."</b></td></tr>");
					if ($typ4 !="N/A")
						echo("<tr><th>Type de cong&eacute;: <i>".$typ4."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb4']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin4']))."</b>, Nombre : <b>".$result['lv_nbr4']."</b></td></tr>");
							
					echo("<tr><th>Adresse</th><td>".$result['lv_addr']."</td></tr>");
					echo("<tr><th>Demande sur Self Service</th><td>".$result['lv_selfs']."</td></tr>");
							
					echo("<tr><th>Date de Reprise</th><td>".date("d.m.Y",strtotime($reprise))."</td></tr>
						<tr><th>Statut</th><td>".$result['lv_state']."</td></tr>");
					if($result['lv_state']=='REJET1' || $result['lv_state']=='REJET2' || $result['lv_state']=='ANNULE')
					{
						if($result['lv_lib']== "")
							echo("<tr><th>Raison Annulation / Rejet</th><td>Non d&eacute;fini</td></tr>");
						else 
							echo("<tr><th>Raison Annulation / Rejet</th><td>".$result['lv_lib']."</td></tr>");
					}
							
				echo("<tr><th>Superviseur</th><td>".$result['lv_sup']."</td></tr>
					<tr><th>OIC</th><td>".$result['lv_oic']."</td></tr>
					<tr><th>Date Superviseur</th><td>".$result['lv_datesup']."</td></tr>
					<tr><th>Date OIC</th><td>".$result['lv_dateoic']."</td></tr>");
										
				echo("</tbody></table>");
				echo("</div><!-- /.table-responsive --></div>");
		?>
			
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
