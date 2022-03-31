<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$indx	= $mysqli->query("SELECT indexid AS IND FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$pers	= $indx["IND"];
	$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$pers'")->fetch_array();
	$contrat= $cpt["CONT"];
	if ($contrat == "SC" || $contrat == "SS")
	{
		header('Location:djoummahaskconf.php');
	}

	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						D&eacute;tails du Cong&eacute;s Pris
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
			<?php			
				include('connexion.php');
				include("inc/fonctionscalc.php");
				$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
				$nopers = $exis['ID'];
				$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='APPROUVE2' " ;
				$requete = $mysqli->query( $sql ) ;
				while( $result = $requete->fetch_assoc()  )
				{	
					$daterep = $result['lv_rep'];
					$nombre = $result['lv_nombre'];
					$jour	 = date("Y-m-d");
					/*$nbjour	= (strtotime($jour)-strtotime($daterep))/86400;
					
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
					echo("
						<div class=\"col-lg-8\">
							<div class=\"table-responsive\">");			

					echo("<table class=\"table table-striped table-bordered table-hover\">
						<tbody>
							<tr><th>Cr&eacute;&eacute;e le</th><td>".$result['lv_date']."</td></tr>
							<tr><th>Type de Cong&eacute;</th><td>".$result['lv_type']."</td></tr>
							<tr><th>Du</th><td>".$result['lv_deb']."</td></tr>
							<tr><th>Au</th><td>".$result['lv_ret']."</td></tr>");
							echo("<tr><th>Nombre</th><td>".$result['lv_nombre']."</td></tr>");
							echo("<tr><th>Adresse</th><td>".$result['lv_addr']."</td></tr>
							<tr><th>Superviseur</th><td>".$result['lv_sup']."</td></tr>
							<tr><th>OIC</th><td>".$result['lv_oic']."</td></tr>
							<tr><th>Demande sur Self Service</th><td>".$result['lv_rr']."</td></tr>
							<tr><th>Date de Reprise Pr&eacute;vue </th><td>".$result['lv_rep']."</td></tr>
						</tbody>");
					echo("</table>");
					echo(" <button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='confdjoumrepft.php?id=".$result['lv_id']."'\" title=\"Confirmer la Reprise\"><i class=\"fa fa-check-circle\" fa-fw></i> CONFIRMER REPRISE</button>");									
					echo("</div><!-- /.table-responsive --><br /></div>");
				}
			?>
			</div><!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>
