<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>

<script language="javascript">
      function confirme( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment Annuler cette Demande ?" ) ;
		if( confirmation )
		{
			document.location.href = "delasksdr.php?id="+identifiant ;
		}
      }
</script>


		<br /><br /><br />
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						<div align="right">
							<?php
								include('connexion.php');
								$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
								$nopers = $exis['ID'];
								$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state=''")->fetch_array();		
								if($nb['nb']!=0)
								{
									echo ("<button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='vadjoummahask.php'\" title=\"Confirmer Demande de Cong&eacute;s\"><i class=\"fa fa-check\" fa-fw></i> Confirmer Demande</button>");
								}
								else
								{
									$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND (lv_state LIKE '%APPROUVE%' OR lv_state='') ")->fetch_array();		
									if($nb['nb']==0)
									{
										echo ("<button type=\"button\" class=\"btn btn-primary btn2\" onclick=\"document.location='djoummahask.php'\" title=\"Nouvelle Demande de Cong&eacute;s\"><i class=\"fa fa-edit\" fa-fw></i> Nouvelle Demande</button>");
									}
									$nb2 = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state='APPROUVE2'")->fetch_array();		
									if($nb2['nb']!=0)
									{
										echo (" <button type=\"button\" class=\"btn btn-danger btn2\" onclick=\"document.location='djoummahaskconf.php'\" title=\"Confirmer Reprise de Cong&eacute;s\"><i class=\"fa fa-bell\" fa-fw></i> Confirmer Reprise</button>");
									}
								}
							?>
						</div>
						Mes Demandes de Cong&eacute;s
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Liste des demandes 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
								<?php
								include('connexion.php');
								$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
								$nopers = $exis['ID'];
								$i=1;
								$exis = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state!='' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state!='' " ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>N&deg; Demande</th>
												<th>Du</th>
												<th>Au</th>
												<th>Nombre</th>
												<th>Statut</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										echo("<tbody><tr class=\"default\"><td>".$result['lv_id']."</td>");
										echo("<td>".$result['lv_deb']."</td>");
										echo("<td>".$result['lv_ret']."</td>");	
										echo("<td>".$result['lv_nombre']."</td>");
										echo("<td>".$result['lv_state']."</td>");
										if ($result['lv_state']=='ATTENTE')
										{
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle\" onclick=\"document.location='rejectdjoummah.php?id=".$result['lv_id']."'\" title=\"Annuler\"><i class=\"fa fa-reply\"></i></button></td>");
										}
										/*if ($result['lv_state']=='APPROUVE2')
										{
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle\" onclick=\"document.location='rejectdjoummah.php?id=".$result['lv_id']."'\" title=\"Annuler\"><i class=\"fa fa-reply\"></i></button></td>");
										}*/
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de Cong&eacute;s Enregistrée...<br />
											Une demande est enregistr&eacute;e que lorsque vous la <b>Confirmez</b> </div>") ;		
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
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

			<?php
				if ($pseudo=="zimbos")
				{
					echo("<div class=\"row\">
							<div class=\"col-lg-10\">
								<div class=\"panel panel-info\">
									<div class=\"panel-heading\">");
										echo ("Liste des demandes <i>(Nouvelle Version)</i> 
									</div>
								<!-- /.panel-heading -->
								<div class=\"panel-body\">
									<div class=\"table-responsive\">");
					
					$existe = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
					$nopers = $existe['ID'];
					$existe = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state!=''")->fetch_array();
					
					if($existe['ID'] != 0)
					{
						$sql1 = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state!=''" ;
						$requete1 = $mysqli->query( $sql1 ) ;
						
						//$vard 	= $mysqli->query("SELECT LEAST(lv_deb1, lv_deb2, lv_deb3) AS DMIN FROM wfp_chd_rqdjoummah WHERE (lv_sup='$nomoic,$pnomoic' AND lv_state='ATTENTE') OR (lv_oic='$nomoic,$pnomoic' AND lv_state='APPROUVE1') ")->fetch_array();		
						//$debut	= $vard['DMIN'];						
						
						echo("<table class=\"table\">
						<thead>
							<tr>
								<th>N&deg; Demande</th>
								<th>D&eacute;but</th>
								<th>Fin</th>
								<th>Reprise</th>
								<th>Type(s)</th>
								<th>Statut</th>
							</tr>
						</thead>");
					
						while( $result1 = $requete1->fetch_assoc()  )
						{	
							$id		= $result1['lv_id'];
							$varf 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4) AS DMAX FROM wfp_chd_rqdjoummah WHERE lv_id='$id' ")->fetch_array();		
							$fin	= $varf['DMAX'];
						
							echo("<tbody><tr class=\"default\"><td>".$result1['lv_id']."</td>");
							echo("<td>".date("d.m.Y",strtotime($result1['lv_deb1']))."</td>");
							echo("<td>".date("d.m.Y",strtotime($fin))."</td>");
							echo("<td>".date("d.m.Y",strtotime($result1['lv_rep']))."</td>");
							echo("<td>- ".$result1['lv_type1']." - ".$result1['lv_type2']." - ".$result1['lv_type3']." - ".$result1['lv_type4']." -</td>");
							echo("<td>".$result1['lv_state']."</td>");
							echo("<td><button type=\"button\" class=\"btn btn-success btn-circle\" onclick=\"document.location='detdjoummahdmd.php?id=".$result1['lv_id']."'\" title=\"Details\"><i class=\"fa fa-list\"></i></button></td>");							
							if ($result1['lv_state']=='ATTENTE')
							{
								echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle\" onclick=\"document.location='rejectdjoummah.php?id=".$result1['lv_id']."'\" title=\"Annuler\"><i class=\"fa fa-reply\"></i></button></td>");
							}
						}
					}
					else
					{
						echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de Cong&eacute;s Enregistrée...<br />
											Une demande est enregistr&eacute;e que lorsque vous la <b>Confirmez</b> </div>") ;				
					}								
							echo("</tr></tbody></table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					</div>
					<!-- /.col-lg-10 -->
					</div>");
				}
			?>
								
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>
