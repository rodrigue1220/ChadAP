<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	$nbra 	= $mysqli->query("SELECT COUNT(lv_id) AS nb FROM wfp_chd_rqdjoummah WHERE lv_statetrt!='TRAITE' ")->fetch_array();
	$ntrt	= $nbra['nb'];
	$nbri 	= $mysqli->query("SELECT COUNT(lv_id) AS nb FROM wfp_chd_rqdjoummah WHERE lv_statetrt='TRAITE' ")->fetch_array();
	$trt	= $nbri['nb'];
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
<script language="javascript">
      function confirme( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment desactiver ce Compte ?" ) ;
		if( confirmation )
		{
			document.location.href = "desacpte.php?id="+identifiant ;
		}
      }
</script>

	<br /><br /><br />
    <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">            
				<h1 class="page-header">
				<div align="right">
					<button type="button" class="btn btn-primary" onclick="document.location='askleave.php'" title="Liste des demandes de congés"><i class="fa fa-list" fa-fw></i> Liste des Demandes</button>
				</div><br />
				Demandes des Cong&eacute;s Trait&eacute;es </h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						Demandes Trait&eacute;es : <strong><?php echo $trt; ?></strong><br />
						<a href="trtdjmrh.php">Demandes NON Trait&eacute;es : <strong><?php echo $ntrt; ?></strong></a>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">                    
							<?php

								$i=1;
								$exis = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_statetrt='TRAITE'")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT j.lv_id, j.lv_nopers, j.lv_deb, j.lv_ret, j.lv_nombre, j.lv_rep, j.lv_rr, j.lv_state,  p.rh_lname, p.rh_fname, p.rh_duty 
									FROM wfp_chd_personnel p
									INNER JOIN wfp_chd_rqdjoummah j
									ON j.lv_nopers = p.rh_nopers
									WHERE lv_statetrt='TRAITE'
									ORDER BY p.rh_lname ASC";
											
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>N&deg;</th>
												<th>Index</th>
												<th>Nom & Pr&eacute;nom</th>
												<th>Duty</th>
												<th>D&eacute;but</th>
												<th>Retour</th>
												<th>Nombre</th>
												<th>Reprise</th>
												<th>R&R </th>
												<th>Etat</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										/*$nopers	= $result['lv_nopers'];
										$sql2	= "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ";
										$req2	= $mysqli->query( $sql2 ) ;
										$result2= $req2->fetch_assoc();
										$nom	= $result2['rh_lname'];
										$pnom	= $result2['rh_fname'];
										$duty	= $result2['rh_duty'];
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nopers."</td>");
										echo("<td>".$nom." ".$pnom."</td>");											
										echo("<td>".$duty."</td>");*/	
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['lv_nopers']."</td>");
										echo("<td>".$result['rh_lname']." ".$result['rh_fname']."</td>");
										echo("<td>".$result['rh_duty']."</td>");
										echo("<td>".date("d.m.Y", strtotime($result['lv_deb']))."</td>");
										echo("<td>".date("d.m.Y", strtotime($result['lv_ret']))."</td>");
										echo("<td align=\"center\">".$result['lv_nombre']."</td>");
										echo("<td>".date("d.m.Y", strtotime($result['lv_rep']))."</td>");
										echo("<td>".$result['lv_rr']."</td>");
										echo("<td>".$result['lv_state']."</td>");
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-danger\">Aucune Demande de Cong&eacute;s Trait&eacute;e...</div>") ;		
								}
							?>				
							</tr></tbody></table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
    </div>
    <!-- /#page-wrapper -- echo("<td><button type=\"button\" class=\"btn btn-danger btn-circle btn-xs\" onclick=\"confirme('".$result['id']."')\" title=\"SUPPRIMER\"><i class=\"fa fa-remove\"></i></button></td>");
										>

<?php
	include("inc/ridjilene2.php");
?>