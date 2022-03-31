<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('connexion.php');
	require_once('verifications.php');
	
	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nomoic = $result["nom"];
	$pnomoic = $result["prenom"];
			
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic'")->fetch_array();
	if($oic['ID'] == 0)
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include('inc/headers.php');
?>

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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-check"></i> <i class="fas fa-fw fa-calendar-o"></i> <i class="fas fa-fw fa-hourglass-half"></i> Approbation des Cong&eacute;s / HS</h1>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row-lg-auto">
		<div class="card shadow mb-4">
			<a href="#collapseCardHSAprv" class="d-block card-header py-3" data-toggle="collapse" title="Derouler" role="button" aria-expanded="true" aria-controls="collapseCardHSAprv">
				<h6 class="m-0 font-weight-bold text-primary">Liste des demandes HS en ATTENTE d'approbation </h6>
			</a>
        
		<?php
			$sql	 = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
			$requete = $mysqli->query( $sql );
			$result	 = $requete->fetch_assoc();
			$nom 	 = $result["nom"];
			$prenom  = $result["prenom"];
								
			$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='ATTENTE'")->fetch_array();				
			if($approver['ID'] != 0)
			{
				echo("<div class=\"collapse show\" id=\"collapseCardHSAprv\">
				<div class=\"card-body\">
					<table class=\"table\">");
					
				$sql = "SELECT * FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='ATTENTE'" ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>N&deg;</th>
					<th>Demandeur</th>											
					<th>Date pr&eacute;vue</th>
					<th>Heure d&eacute;but E/T</th>
					<th>Heure fin E/T</th>
					<th>Dur&eacute;e</th>
					<th>Raison</th>
					<th>Type</th>
					<th colspan=\"2\">Actions</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					$h1			= strtotime($result['cto_hfin']);
					$h2			= strtotime($result['cto_hdeb']);
					$dure 		= gmdate('H:i:s',$h1-$h2);
					$demandeur	= $result['cto_dem'];
					$sqld	 	= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
					$requeted 	= $mysqli->query( $sqld );
					$resultd	= $requeted->fetch_assoc();
					$dnom 		= $resultd["nom"];
					$dprenom  	= $resultd["prenom"];
										
					echo("<tbody><tr><td>".$result['cto_id']."</td>");
					echo("<td>".$dnom." ".$dprenom."</td>");
					echo("<td>".$result['cto_deb']."</td>");
					echo("<td>".$result['cto_hdeb']."</td>");	
					echo("<td>".$result['cto_hfin']."</td>");
					echo("<td>".$dure."</td>");
					echo("<td>".$result['cto_raison']."</td>");
					echo("<td>".$result['cto_choix']."</td>");
					
					echo("<td><a href=\"traitehs.php?id=".$result['cto_id']."&cx=OK\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-sm-inline-block btn btn-sm btn btn-success\" title=\"Approuver\"><i class=\"fa fa-check\"></i></a></td>
						 <td><a href=\"traitehs.php?id=".$result['cto_id']."&cx=RJ\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-sm-inline-block btn btn-sm btn btn-danger\" title=\"Rejeter\"><i class=\"fa fa-times\"></i></a></td></tr></tbody>");
				}
			}
			else
			{
				echo("<div class=\"collapse no-show\" id=\"collapseCardHSAprv\">
				<div class=\"card-body\">
					<table class=\"table\">");
					
				echo("<div class=\"alert alert-danger\">Il n'y a aucune demande d'heures suppl&eacute;mentaires en attente de votre approbation...<br /></div>") ;		
			}
		?>
			</table>
			</div>
            <!-- /.card-body -->
          </div>
          <!-- /.collapse -->
        </div>
        <!-- /.card shadow -->	 
	</div>
	<hr />
	
	<div class="row-lg-auto">
		<div class="card shadow mb-4">
			<a href="#collapseCardHSCert" class="d-block card-header py-3" data-toggle="collapse" title="Derouler"  role="button" aria-expanded="true" aria-controls="collapseCardHSCert">
				<h6 class="m-0 font-weight-bold text-primary">Liste des demandes HS en ATTENTE de certification</h6>
			</a>

		  <?php
			
			$sql	 = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
			$requete = $mysqli->query( $sql );
			$result	 = $requete->fetch_assoc();
			$nom 	 = $result["nom"];
			$prenom  = $result["prenom"];	
			  
			$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='EFFECTUE'")->fetch_array();				
			if($approver['ID'] != 0)
			{
				echo("<div class=\"collapse show\" id=\"collapseCardHSCert\">
				<div class=\"card-body\">
					<table class=\"table\">");
					
				$sql = "SELECT * FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='EFFECTUE'" ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>N&deg;</th>
					<th>Demandeur</th>											
					<th>Date Eff</th>
					<th>Heure d&eacute;but Eff</th>
					<th>Heure fin Eff</th>
					<th>Dur&eacute;e</th>
					<th>Raison</th>
					<th>Type</th>
					<th colspan=\"2\">Actions</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					$demandeur	= $result['cto_dem'];
					$sqld	 	= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
					$requeted 	= $mysqli->query( $sqld );
					$resultd	= $requeted->fetch_assoc();
					$dnom 		= $resultd["nom"];
					$dprenom  	= $resultd["prenom"];
										
					echo("<tbody><tr><td>".$result['cto_id']."</td>");
					echo("<td>".$dnom." ".$dprenom."</td>");
					echo("<td>".$result['cto_deb2']."</td>");
					echo("<td>".$result['cto_hdeb2']."</td>");	
					echo("<td>".$result['cto_hfin2']."</td>");
					echo("<td>".$result['cto_dure']."</td>");
					echo("<td>".$result['cto_raison']."</td>");
					echo("<td>".$result['cto_choix']."</td>");
										
					echo("<td><a href=\"traite2hsadj.php?id=".$result['cto_id']."\" class=\"btn btn-success btn-sm d-sm-inline-block\" onclick=\"document.location='traite2hsadj.php?id=".$result['cto_id']."'\" title=\"Certifier\"><i class=\"fa fa-legal\"></i></button></td>
						<td><a href=\"traitehs2.php?id=".$result['cto_id']."&cx=RJ\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-sm btn-danger d-sm-inline-block\" title=\"Rejeter\"><i class=\"fa fa-times\"></i></button></td></tr></tbody>");
				}
			}
			else
			{
				echo("<div class=\"collapse no-show\" id=\"collapseCardHSCert\">
				<div class=\"card-body\">
					<table class=\"table\">");
				echo("<div class=\"alert alert-danger\">Il n'y a aucune demande d'heures suppl&eacute;mentaires en attente de votre Certification...<br /></div>") ;		
			}
		  ?>
		  </table>
			</div>
            <!-- /.card-body -->
          </div>
          <!-- /.collapse -->
        </div>
        <!-- /.card shadow -->	  
	</div>
	<!--row -->
	<hr />
	<?php
		$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
		$requete = $mysqli->query( $sql );
		$result = $requete->fetch_assoc();
		$nomoic = $result["nom"];
		$pnomoic = $result["prenom"];
		
			echo("<div class=\"row-lg-auto\">
				<div class=\"card shadow mb-4\">
					<a href=\"#collapseCardCong\" class=\"d-block card-header py-3\" data-toggle=\"collapse\" title=\"Derouler\"  role=\"button\" aria-expanded=\"true\" aria-controls=\"collapseCardCong\">
						<h6 class=\"m-0 font-weight-bold text-primary\">Demandes de cong&eacute;s &agrave; Approuver</h6>
					</a>");
						
		$existe = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE (lv_sup='$nomoic,$pnomoic' AND lv_state='ATTENTE') OR (lv_oic='$nomoic,$pnomoic' AND lv_state='APPROUVE1') ")->fetch_array();
		$ident	= $existe['ID'];
		if($ident != 0)
		{
			echo("<div class=\"collapse show\" id=\"collapseCardCong\">
				<div class=\"card-body\">
					<table class=\"table\">");
					
			$sql1 = "SELECT * FROM wfp_chd_rqdjoummah WHERE (lv_sup='$nomoic,$pnomoic' AND lv_state='ATTENTE') OR (lv_oic='$nomoic,$pnomoic' AND lv_state='APPROUVE1')  " ;
								$requete1 = $mysqli->query( $sql1 ) ;          
						
			echo("<thead><tr>
				<th>#</th>
				<th>Demandeur</th>
				<th>D&eacute;but</th>
				<th>Fin</th>
				<th>Reprise</th>
				<th>Soumis le</th>
				<th align=\"center\" colspan=\"3\">Actions</th>
			</tr></thead>");
			
			echo ("<tfoot><tr>
				<th>#</th>
				<th>Demandeur</th>
				<th>D&eacute;but</th>
				<th>Fin</th>
				<th>Reprise</th>
				<th>Soumis le</th>
				<th align=\"center\" colspan=\"3\">Actions</th>
			</tr></tfoot>");
					
			while( $result1 = $requete1->fetch_assoc()  )
			{
				$ident 	= $result1["lv_id"];
				$dselfs	= $result1["lv_dselfs"];
				$varf 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4, lv_dselfs) AS DMAX FROM wfp_chd_rqdjoummah WHERE (lv_id='$ident' AND lv_sup='$nomoic,$pnomoic' AND lv_state='ATTENTE') OR (lv_id='$ident' AND lv_oic='$nomoic,$pnomoic' AND lv_state='APPROUVE1') ")->fetch_array();		
				$fin	= $varf['DMAX'];
							
				if ($fin==$dselfs)
				{
					$fin = mktime(0,0,0,substr($fin,5,2),substr($fin,8,2)-1,substr($fin,0,4));
					$fin = date("Y-m-d",$fin);
				}
						
				$demandeur	= $result1['lv_nopers'];
				$sqlz 		= "SELECT * FROM user WHERE indexid='$demandeur' " ;
				$requetez	= $mysqli->query( $sqlz );
				$resultz	= $requetez->fetch_assoc();
				$nom		= $resultz["nom"];
				$prenom 	= $resultz["prenom"];
							
				echo("<tbody><tr><td>".$result1['lv_id']."</td>");
				echo("<td>".$nom." ".$prenom."</td>");
				echo("<td>".date("d.m.Y",strtotime($result1['lv_deb1']))."</td>");
				echo("<td>".date("d.m.Y",strtotime($fin))."</td>");
				echo("<td>".date("d.m.Y",strtotime($result1['lv_rep']))."</td>");
				echo("<td>".date("d.m.Y H:m:s",strtotime($result1['lv_date']))."</td>");
							
				echo("<td><a onclick=\"document.location='detdjoummah.php?id=".$result1['lv_id']."'\" title=\"DETAILLER\" class=\"btn btn-info btn-sm d-sm-inline-block\"><i class=\"fas fa-info-circle text-white\"></i></a></td>");
				echo("<td><a href=\"auto1askdjoummah.php?id=".$result1['lv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success btn-sm d-sm-inline-block\" title=\"Approuver la Demande\"><i class=\"fas fa-check-circle text-white\"></i></a></td>");
				echo("<td><a href=\"confrejdjdmd.php?id=".$result1['lv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-sm d-sm-inline-block\" title=\"Rejeter la Demande\"><i class=\"fas fa-trash text-white\"></i></a></td></tr>");
			}
		}
		else
		{
			echo("<div class=\"collapse no-show\" id=\"collapseCardCong\">
				<div class=\"card-body\">
				<table class=\"table\">");
			echo("<div class=\"alert alert-danger\">Aucune demande de cong&eacute;s &agrave; approuver...</div>") ;		
		}								
		echo("</tbody></table>");
						
		echo("</div>
			</div>
		</div></div>"); 
	?>
	
	
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
		<a href="djoummahapprv.php" class="btn btn-danger" id="confirmModalNo">Non</a>
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
