<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	include("inc/fonctionscalc.php");
	
	$indx	= $mysqli->query("SELECT indexid AS IND FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$pers	= $indx["IND"];
	/*$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$pers'")->fetch_array();
	$contrat= $cpt["CONT"];
	if ($contrat == "SC" || $contrat == "SS")
	{
		header('Location:djoummahaskconf.php');
	}*/

	include("inc/taarikh.php");
	include('inc/headers.php');
?>
<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails du Cong&eacute;s pris</h1>
	  <a href="djoummahatt.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				     
    </div>
    <hr />   
    
	<!-- Content Row -->
    <div class="row">
		<?php			

			$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
			$nopers = $exis['ID'];
			$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$nopers'")->fetch_array();
			$contrat= $cpt["CONT"];
			$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='APPROUVE2' " ;
			$requete = $mysqli->query( $sql ) ;
			while( $result = $requete->fetch_assoc()  )
			{	
				$daterep = $result['lv_rep'];
				/*$nombre = $result['lv_nbre3'];
				$jour	 = date("Y-m-d");
				$nbjour	= (strtotime($jour)-strtotime($daterep))/86400;
					
				if ($nbjour<0)
				{
					$diffj 	 = getJours($jour,$daterep);
					$diffj   = getJours2($jour,$daterep,$diffj)-1;
					$nombre  = $nombre-$diffj;
				}
				else if ($nbjour>0)
				{
					$diffj 	 = getJours($daterep,$jour);
					$diffj   = getJours2($daterep,$jour,$diffj)-1;
					$nombre  = $nombre+$diffj;
				}
				else
				{
					$diffj 	 = 0;
				}*/
				echo("<div class=\"col-lg-8\">
					<div class=\"table-responsive\">");			

				echo("<table class=\"table table-striped table-bordered table-hover\"><tbody>
					<tr><th>Cr&eacute;&eacute;e le</th><td>".$result['lv_date']."</td></tr>
					<tr><th>Type de cong&eacute;: <i>".$result['lv_type1']."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb1']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin1']))."</b>, Nombre : <b>".$result['lv_nbr1']."</b></td></tr>");
					if ($result['lv_type2'] !="")
						echo("<tr><th>Type de cong&eacute;: <i>".$result['lv_type2']."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb2']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin2']))."</b>, Nombre : <b>".$result['lv_nbr2']."</b></td></tr>");
					if ($result['lv_type3'] !="")
						echo("<tr><th>Type de cong&eacute;: <i>".$result['lv_type3']."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb3']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin3']))."</b>, Nombre : <b>".$result['lv_nbr3']."</b></td></tr>");
					if ($result['lv_type4'] !="")
						echo("<tr><th>Type de cong&eacute;: <i>".$result['lv_type4']."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb4']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin4']))."</b>, Nombre : <b>".$result['lv_nbr4']."</b></td></tr>");
					echo("<tr><th>Adresse</th><td>".$result['lv_addr']."</td></tr>
						<tr><th>Superviseur</th><td>".$result['lv_sup']."</td></tr>
						<tr><th>OIC</th><td>".$result['lv_oic']."</td></tr>");
	
					if ($contrat != "SC" && $contrat != "SS")
					{
						echo("<tr><th>Demande sur Self Service</th><td>".$result['lv_selfs']."</td></tr>");
					}							
					echo("<tr><th>Date de Reprise Pr&eacute;vue</th><td>".date("d.m.Y",strtotime($result['lv_rep']))."</td></tr>
					</tbody>");
					echo("</table>");
					echo(" <button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='confdjoumrepdmd.php?id=".$result['lv_id']."'\" title=\"Confirmer la Reprise\"><i class=\"fa fa-check-circle\" fa-fw></i> CONFIRMER REPRISE</button>");									
					echo("</div><!-- /.table-responsive --><br /></div>");
			}
		?>
			</div><!-- /.row -->
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
