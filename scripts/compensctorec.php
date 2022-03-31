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
        var confirmation = confirm( "Voulez vous vraiment supprimer cette Demande ?" ) ;
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
				<style type="text/css"> .btn2{ width:200px; } </style>
                    <h1 class="page-header">
						<div align="right">
							<?php
								include('connexion.php');
								$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
								$requete = $mysqli->query( $sql );
								$result = $requete->fetch_assoc();
								$nom = $result["nom"];
								$prenom = $result["prenom"];
								
								$exist = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='APPROUVE' ")->fetch_array();
								if($exist['ID'] != 0)
								{	
									echo ("<button type=\"button\" class=\"btn btn-info btn2\" onclick=\"document.location='va2compenscto.php'\" title=\"Soumettre fiche mensuelle d'heures suppl&eacute;mentaires\"><i class=\"fa fa-calendar-check-o\" fa-fw></i> Submit HS</button>");
								}
								$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='ATTENTE' ")->fetch_array();
								if($approver['ID'] != 0)
								{	
									echo (" <button type=\"button\" class=\"btn btn-success btn2\" onclick=\"document.location='vacompenscto.php'\" title=\"Approuver Demande d'heures suppl&eacute;mentaires\"><i class=\"fa fa-check\" fa-fw></i> Approuver Demande HS</button>");
								}

									$totalcash	= $mysqli->query("SELECT SEC_TO_TIME( SUM(TIME_TO_SEC(cto_dure)) ) AS CUM FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='EFFECTUE' AND cto_choix='CASH' ")->fetch_array();
									$totalcto	= $mysqli->query("SELECT SEC_TO_TIME( SUM(TIME_TO_SEC(cto_dure)) ) AS CUM FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='EFFECTUE' AND cto_choix='CTO' ")->fetch_array();
									$totalcash	= $totalcash['CUM'];
									$totalcto	= $totalcto['CUM'];
									if ($totalcash=="NULL")
									{
										$totalcash = "00:00:00";
									}
									if ($totalcto=="")
									{
										$totalcto = "00:00:00";
									}
							?>
							<button type="button" class="btn btn-primary btn2" onclick="document.location='compenscto.php'" title="Nouvelle demande d'heures suppl&eacute;mentaires"><i class="fa fa-edit" fa-fw></i> Nouvelle Demande HS</button>
						</div><br />
						R&eacute;capitulatif des d'heures suppl&eacute;mentaires EFFECTUEES
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Total CTO = <?php echo $totalcto; ?><br />Total CASH = <?php echo $totalcash; ?> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
								<?php
								
								$exis = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='EFFECTUE' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='EFFECTUE' " ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>N&deg;</th>
												<th>Soumis le</th>
												<th>Date Effective</th>
												<th>Heure d&eacute;but</th>
												<th>Heure fin</th>
												<th>Dur&eacute;e</th>
												<th>Type</th>
											</tr>
										</thead>");
									
									while( $result = $requete->fetch_assoc()  )
									{
										/*if ($result['cto_choix']=="CTO")
										{
											$totalcto	= $totalcto+strtotime($result['cto_dure']);
										}
										else if ($result['cto_choix']=="CASH")
										{
											$totalcash	= $totalcash+strtotime($result['cto_dure']);
										}*/
										
										echo("<tbody><tr class=\"default\"><td>".$result['cto_id']."</td>");
										echo("<td>".$result['cto_date']."</td>");
										echo("<td>".$result['cto_deb2']."</td>");
										echo("<td>".$result['cto_hdeb2']."</td>");	
										echo("<td>".$result['cto_hfin2']."</td>");
										echo("<td>".$result['cto_dure']."</td>");
										echo("<td>".$result['cto_choix']."</td>");
									}
								}
								else
								{
									echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande d'heures suppl&eacute;mentaires En attente de Soumission...<br /></div>") ;		
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
			
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>
