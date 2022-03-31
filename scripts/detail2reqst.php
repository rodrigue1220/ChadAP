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
						$id = $_GET["id"];
						echo $id;
						echo("<br /> <button type=\"button\" class=\"btn btn-warning\" onclick=\"document.location='modvalidask.php?id=".$id." '\" title=\"Modifier\"><i class=\"fa fa-edit\" fa-fw></i> MODIFIER</button>");
								
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
								<tr><th>D&eacute;part Pr&eacute;vu</th><td>".$result['reqst_dep'].", ".$result['reqst_heurd']."h".$result['reqst_mind']."mn</td></tr>
								<tr><th>Retour Pr&eacute;vu</th><td>".$result['reqst_ret'].", ".$result['reqst_heurr']."h".$result['reqst_minr']."mn</td></tr>
								<tr><th>OIC / Autorisation</th><td>".$result['reqst_oic']." / ".$result['reqst_dateactionoic']."</td></tr>
								<tr><th>Approbation FM</th><td>".$result['reqst_dateaction']."</td></tr>
								<tr><th>Chauffeur</th><td>".$result['reqst_chauf']."</td></tr>
								<tr><th>Mobile</th><td>".$result['reqst_vehicle']."</td></tr>
							</tbody>");

						echo("</table>");
					?>
                </div>
                <!-- /.table-responsive --></div>
				
			<div class="col-lg-6"">
                <form class="form-horizontal" name="formulaire" action="clotureask.php" method="post" onsubmit="return verif_formulaire()" >
					<?php echo "<input type=\"hidden\" name=\"id\" id=\"id\" value=".$_GET["id"]." \>"; ?>
					<div class="form-group">
						<label class="control-label col-sm-3" for="heur">D&eacute;part Effectif</label>
						<div class="col-sm-2">
							<select class="form-control" id="heurd" name="heurd" >
								<option>HH</option>
								<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
								<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
								<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
							</select>
						</div>
						<div class="col-sm-2">
							<select class="form-control" id="mind" name="mind" >
								<option>mm</option>
								<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
								<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
								<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="heur">Retour Effectif</label>
						<div class="col-sm-2">
							<select class="form-control" id="heurr" name="heurr" >
								<option>HH</option>
								<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
								<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
								<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
							</select>
						</div>
						<div class="col-sm-2">
							<select class="form-control" id="minr" name="minr" >
								<option>mm</option>
								<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
								<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
								<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-3">
							<input type="submit" class="btn btn-primary" value="Cloturer Demande" />
						</div>
					</div>
				</form>
            </div>
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>
