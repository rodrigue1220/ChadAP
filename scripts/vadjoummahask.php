<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
	include("inc/fonctionscalc.php");	
?>
		<br /><br /><br />
		<style type="text/css"> .btn{ width:125px; } </style>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						D&eacute;tails de (s) demande (s) de Cong&eacute;s NON Confirm&eacute;e (s)
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
			<?php			
				include('connexion.php');
				$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
				$nopers = $exis['ID'];
				$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='' " ;
				$requete = $mysqli->query( $sql ) ;
				while( $result = $requete->fetch_assoc()  )
				{
					$sol 	= $mysqli->query("SELECT leave_solde AS NB FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
					$soldex = $sol['NB'];
					$dsol 	= $mysqli->query("SELECT leave_ldate AS NB FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
					$dsoldav = $dsol['NB'];
					
					$wakit	= $result['lv_deb'];
					$ret	= $result['lv_ret'];
					$drep	= $result['lv_rep'];
					
					if ($wakit=="1970-01-01" || $ret=="1970-01-01" || $wakit=="0000-00-00" || $ret=="0000-00-00")
					{
						header('Location:oops5.php');
					}
	
					elseif (strtotime($wakit)<0  || strtotime($ret)<0 || strtotime($wakit)=="" || strtotime($ret)=="")
					{
						header('Location:oops5.php');
					}
					elseif (strtotime($ret)<=strtotime($wakit))
					{
						header('Location:oops6.php');
					}
					
					$firstday = getFinMois1($wakit);
					$lastday = getFinMois2($ret);
					$calcav		= getCalcJours($dsoldav,$firstday);
					$calcap		= getCalcJours($dsoldav,$lastday);
					$nbjour = $result['lv_nombre'];
					
					$soldav	= $soldex + $calcav;
					$soldap	= ($soldex+$calcap)-$nbjour;
					
					echo("
						<div class=\"col-lg-6\">
							<div class=\"table-responsive\">");			

					echo("<table class=\"table table-striped table-bordered table-hover\">
						<tbody>
							<tr><th>Cr&eacute;&eacute;e le</th><td>".$result['lv_date']."</td></tr>
							<tr><th>Du</th><td>".$result['lv_deb']."</td></tr>
							<tr><th>Au</th><td>".$result['lv_ret']."</td></tr>");
							if ($result['lv_rr']=="OUI")
							{
								echo("<tr><th>Nombre</th><td>".$nbjour." R&R INCLUS</td></tr>");
							}
							else
							{
								echo("<tr><th>Nombre</th><td>".$nbjour."</td></tr>");
							}
							echo("<tr><th>Adresse</th><td>".$result['lv_addr']."</td></tr>
							<tr><th>Superviseur</th><td>".$result['lv_sup']."</td></tr>
							<tr><th>OIC</th><td>".$result['lv_oic']."</td></tr>
							<tr><th>Solde Av. Cong&eacute;s au ".$firstday."</th><td>".$soldav."</td></tr>
							<tr><th>Solde Ap. Cong&eacute;s au ".$lastday."</th><td>".$soldap."</td></tr>
							<tr><th>Date de Reprise</th><td>".$drep."</td></tr>
						</tbody>");
					echo("</table>");
					echo(" <button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='validjoummah.php?id=".$result['lv_id']."'\" title=\"Confirmer la Demande\"><i class=\"fa fa-check-circle\" fa-fw></i> CONFIRMER</button>
						
						<button type=\"button\" class=\"btn btn-danger\" onclick=\"document.location='rejectdjoummah.php?id=".$result['lv_id']."'\" title=\"Supprimer la Demande\"><i class=\"fa fa-trash\" fa-fw></i> SUPPRIMER</button>
						<button type=\"button\" class=\"btn btn-warning\" onclick=\"document.location='modjoummah.php?id=".$result['lv_id']."'\" title=\"Modifier la Demande\"><i class=\"fa fa-edit\" fa-fw></i> MODIFIER</button>	");		
					echo("</div><!-- /.table-responsive --><br /></div>");
				}
			?>
			</div><!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>
