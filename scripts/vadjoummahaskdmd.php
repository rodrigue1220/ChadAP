<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	include("inc/fonctionscalcul.php");
	
	include("inc/taarikh.php");
	include('inc/headers.php');
?>
<script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
<script src="http://10.109.87.10:8080/scripts/js/bootstrap.min.js"></script>

<script language="javascript"> 
	$(document).ready(function () {
    var theHREF;

    $(".confirmModalLink").click(function(e) {
        e.preventDefault();
        theHREF = $(this).attr("href");
        $("#confirmModal").modal("show");
    });

    $("#confirmModalNo").click(function(e) {
        $("#confirmModal").modal("hide");
    });

    $("#confirmModalYes").click(function(e) {
        window.location.href = theHREF;
    });
});
</script>
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de (s) demande (s) de Cong&eacute;s NON Confirm&eacute;e (s)</h1>
	</div>
	<hr />
    <!-- Content Row -->
    <div class="row">
	  <?php	
		
		$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
		$nopers = $exis['ID'];
		
		$test = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='' ")->fetch_array();
		if($test['ID'] != 0)
		{
			$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='' " ;
			$requete = $mysqli->query( $sql ) ;
			while( $result = $requete->fetch_assoc()  )
			{
				$nopers	= $result['lv_nopers'];				
				$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$nopers'")->fetch_array();
				$contrat= $cpt["CONT"];
					
				$lvid	= $result['lv_id'];
				$wakit	= $result['lv_deb1'];
				$ret	= $result['lv_fin1'];
				$typ1	= $result['lv_type1'];
				$typ2	= $result['lv_type2'];
				$typ3	= $result['lv_type3'];
				$typ4	= $result['lv_type4'];
				$dselfs	= $result['lv_dselfs'];
				if ($typ2 =="")
					$typ2 = "N/A";
				if ($typ3 =="")
					$typ3 = "N/A";
				if ($typ4 =="")
					$typ4 = "N/A";
			
				$var 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4, lv_dselfs) AS DMAX FROM wfp_chd_rqdjoummah WHERE lv_id='$lvid' ")->fetch_array();		
				$retour	= $var['DMAX'];
				if ($retour==$dselfs)
				{
					$reprise = $dselfs;
				}
				else
				{
					$reprise = getDateRep($retour);
					$reprise = getJoursFerie($reprise);
				}
					
				$sqlrep = "UPDATE wfp_chd_rqdjoummah SET lv_rep='$reprise' WHERE lv_id='$lvid' ";					
				$mysqli->query($sqlrep) or die( $mysqli->connect_errno()) ;
					
				if ($wakit=="1970-01-01" || $ret=="1970-01-01" || $wakit=="0000-00-00" || $ret=="0000-00-00")
				{
					header('Location:oops666khalatt.php?cle=DDCTO');
					exit();
				}
				elseif (strtotime($wakit)<0  || strtotime($ret)<0 || strtotime($wakit)=="" || strtotime($ret)=="")
				{
					header('Location:oops666khalatt.php?cle=DDCTO');
					exit();
				}
				elseif (strtotime($ret)<=strtotime($wakit))
				{
					header('Location:oops666khalatt.php?cle=DSCTO');
					exit();
				}

				echo("<div class=\"col-lg-7\">
					<div class=\"table-responsive\">");			

				echo("<table class=\"table table-striped table-bordered table-hover\">
					<tbody>
					<tr><th>Cr&eacute;&eacute;e le</th><td>".$result['lv_date']."</td></tr>
					<tr><th>Type de cong&eacute;: <i>".$typ1."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb1']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin1']))."</b>, Nombre : <b>".$result['lv_nbr1']."</b></td></tr>");
				if ($typ2 !="N/A")
					echo("<tr><th>Type de cong&eacute;: <i>".$typ2."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb2']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin2']))."</b>, Nombre : <b>".$result['lv_nbr2']."</b></td></tr>");
				if ($typ3 !="N/A")
					echo("<tr><th>Type de cong&eacute;: <i>".$typ3."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb3']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin3']))."</b>, Nombre : <b>".$result['lv_nbr3']."</b></td></tr>");
				if ($typ4 !="N/A")
					echo("<tr><th>Type de cong&eacute;: <i>".$typ4."</i></th><td>Du <b>".date("d.m.Y",strtotime($result['lv_deb4']))."</b> au <b>".date("d.m.Y",strtotime($result['lv_fin4']))."</b>, Nombre : <b>".$result['lv_nbr4']."</b></td></tr>");
			
				echo("<tr><th>Adresse</th><td>".$result['lv_addr']."</td></tr>
					<tr><th>Superviseur</th><td>".$result['lv_sup']."</td></tr>
					<tr><th>OIC</th><td>".$result['lv_oic']."</td></tr>");
	
				if ($contrat != "SC" && $contrat != "SS")
				{
					echo("<tr><th>Demande sur Self Service</th><td>".$result['lv_selfs']."</td></tr>");
				}							
				echo("<tr><th>Date de Reprise Effective</th><td>".date("d.m.Y",strtotime($reprise))."</td></tr>");
				echo("</tbody></table>");
				echo("<a href=\"validjoummahdmdft.php?id=".$result['lv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success\" title=\"Confirmer la Demande\"><i class=\"fa fa-check-circle\" fa-fw></i> CONFIRMER</a>			
					<a href=\"rejectdjoummahdmd.php?id=".$result['lv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger\" title=\"Supprimer la Demande\"><i class=\"fa fa-trash\" fa-fw></i> SUPPRIMER</a>");		
				echo("</div><!-- /.table-responsive --><br /></div>");
			}
		?>		
	  
		<div class="col-lg-5">
			<div class="alert alert-warning">Assurez-vous que les informations saisies/affich&eacute;es 
				sont bien correctes avant de <b>CONFIRMER</b>!!!<br /><br /> 
				Sinon <b>SUPPRIMER</b> et bien saisir les informations (surtout le format des dates).
			</div>
		</div>
      <!-- /.col-lg-6 -->
	  <?php 
		}
		else 
		{
			echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de Cong&eacute;s NON Confirm&eacute;e (s)...<br /></div>") ;		
		}
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

	<!-- Dialog Modal-->
	<div class="modal fade fond" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	  <div class="modal-header">     
		<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
      </div>
      <div class="modal-body">
        Cliquez sur "OUI" pour confirmer votre choix
	  </div>
      <div class="modal-footer">
		<a href="vadjoummahaskdmd.php" class="btn btn-danger" id="confirmModalNo">Non</a>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>

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
