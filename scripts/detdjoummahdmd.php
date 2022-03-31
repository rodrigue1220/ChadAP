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
	
	$pivot	= $_GET["id"];
	$sqlpiv	= $mysqli->query("SELECT lv_nopers AS NOP FROM wfp_chd_rqdjoummah WHERE lv_id='$pivot'")->fetch_array();
	$nopers	= $sqlpiv['NOP'];
	
	$indx	= $mysqli->query("SELECT indexid AS IND FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$pers	= $indx["IND"];
	
	if ($pers!=$nopers)
	{
		header('Location:djoummahatt.php');
	}
	
	include("inc/taarikh.php");
	include('inc/headers.php');
?>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> D&eacute;tails de la demande de Cong&eacute;s</h1>
	  <a href="djoummahatt.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				     
    </div>
    <hr />   
    
	<!-- Content Row -->
    <div class="row">
		<?php			
				
			$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$nopers'")->fetch_array();
			$contrat= $cpt["CONT"];
				
				/*$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
				$requetet	= $mysqli->query( $sqlt );
				$resultt	= $requetet->fetch_assoc();
				$nom		= $resultt["nom"];
				$prenom 	= $resultt["prenom"];*/
			
			$sql 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$pivot'" ;
			$requete= $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc(); 

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
		
			echo("<div class=\"col-lg-8\">
					<div class=\"table-responsive\">");			
			echo("<table class=\"table table-striped table-bordered table-hover\"><tbody>
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
	
				/*if ($contrat != "SC" && $contrat != "SS")
				{*/
					echo("<tr><th>Demande sur Self Service</th><td>".$result['lv_selfs']."</td></tr>");
				//}							
			echo("<tr><th>Date de Reprise</th><td>".date("d.m.Y",strtotime($reprise))."</td></tr>
				<tr><th>Statut</th><td>".$result['lv_state']."</td></tr>");
			if($result['lv_state']=='REJET1' || $result['lv_state']=='REJET2' || $result['lv_state']=='ANNULE')
			{
				if($result['lv_lib']== "")
					echo("<tr><th>Raison Annulation / Rejet</th><td>Non d&eacute;fini</td></tr>");
				else 
					echo("<tr><th>Raison Annulation / Rejet</th><td>".$result['lv_lib']."</td></tr>");
			}
			echo("</tbody></table>");
			if ($result['lv_state']=='ATTENTE')
			{
				echo("<a href=\"rejectdjoummah.php?id=".$result['lv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn3 btn-warning\" title=\"Annuler la Demande\"><i class=\"fa fa-reply\" fa-fw></i> ANNULER</a>");
			}
			if ($result['lv_state']=='APPROUVE2')
			{
				echo("<a href=\"confdjoumrepftdmd.php?id=".$result['lv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success\" title=\"Confirmer la Reprise\"><i class=\"fa fa-check-circle\" fa-fw></i> CONFIRMER REPRISE</a>");									
			}
			echo("</div><!-- /.table-responsive --><br /></div>");
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
		<?php echo("<a href=\"detdjoummahdmd.php?id=".$pivot."\" class=\"btn btn-warning\" id=\"confirmModalNo\">Non</a>");?>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>
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
