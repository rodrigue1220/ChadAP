<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminFLEET")
	{
		header('Location:simple.php');
	}
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">D&eacute;tails de la demande n&deg;
					<?php 
						echo $_GET["id"];
						echo("<br /> <button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='validask.php?id=".$_GET['id']."'\" title=\"VALIDER\">VALIDER</button>
							<button type=\"button\" class=\"btn btn-danger\" onclick=\"document.location='rejectask.php?id=".$_GET['id']."'\" title=\"REJETER\">REJETER</button>");
					?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-lg-6">
                <div class="table-responsive">			
					<?php
						include('connexion.php');
						$id=$_GET["id"];
								
						$sql = "SELECT * FROM wfp_chd_request WHERE reqst_id='$id'" ;
						$requete = $mysqli->query( $sql ) ;
						$result = $requete->fetch_assoc();
							
						$nprenom = $result['reqst_nom'];
							
						$sql2 = "SELECT * FROM user WHERE pseudo='$nprenom' OR nom LIKE '%$nprenom%' OR prenom LIKE '%$nprenom%' " ;
						$requete2 = $mysqli->query( $sql2 ) ;
						$result2 = $requete2->fetch_assoc();
									
						echo("<table class=\"table table-striped table-bordered table-hover\">
							<tbody>
								<tr><th>Soumise le</th><td>".$result['reqst_date']."</td></tr>
								<tr><th>Demandeur</th><td>".$result2['nom']." ".$result2['prenom']."</td></tr>
								<tr><th>Passager (s)</th><td>".$result['reqst_passag']."</td></tr>
								<tr><th>Motif</th><td>".$result['reqst_motif']."</td></tr>
								<tr><th>Destination</th><td>".$result['reqst_dest']."</td></tr>
								<tr><th>D&eacute;part</th><td>".$result['reqst_dep'].", ".$result['reqst_heurd']."h".$result['reqst_mind']."mn</td></tr>
								<tr><th>Retour</th><td>".$result['reqst_ret'].", ".$result['reqst_heurr']."h".$result['reqst_minr']."mn</td></tr>
								<tr><th>OIC / Autorisation</th><td>".$result['reqst_oic']." / ".$result['reqst_dateactionoic']."</td></tr>
							</tbody>");

						echo("</table>");
					?>
                </div>
                <!-- /.table-responsive --></div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>
