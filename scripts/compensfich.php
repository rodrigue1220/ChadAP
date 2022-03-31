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
								$nopers = $result["indexid"];
								
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
								$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='EFFECTUE' ")->fetch_array();
								if($approver['ID'] != 0)
								{	
									echo (" <button type=\"button\" class=\"btn btn-danger btn2\" onclick=\"document.location='vacompenscto2.php'\" title=\"Certifier Demande d'heures suppl&eacute;mentaires\"><i class=\"fa fa-legal\" fa-fw></i> Certifier Demande HS</button>");
								}
								/*$exist2 = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='EFFECTUE' ")->fetch_array();
								if($exist2['ID'] != 0)
								{	
									echo (" <button type=\"button\" class=\"btn btn-success btn2\" onclick=\"document.location='compensctorec.php'\" title=\"Soumettre fiche mensuelle de demande d'heures suppl&eacute;mentaires\"><i class=\"fa fa-sign-out\" fa-fw></i> Fiche Mensuelle</button>");
								}*/
							?>
							<button type="button" class="btn btn-primary btn2" onclick="document.location='compenscto.php'" title="Nouvelle demande d'heures suppl&eacute;mentaires"><i class="fa fa-edit" fa-fw></i> Nouvelle Demande HS</button>
							<button type="button" class="btn btn-warning btn2" onclick="document.location='compensatt.php'" title="Liste des Demandes d'heures Supp"><i class="fa fa-list" fa-fw></i> Mes Demandes HS</button>
						</div><br />
						R&eacute;capitulatif d'heures suppl&eacute;mentaires
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Cumul par mois
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
								<?php
								include('connexion.php');

								$exis = $mysqli->query("SELECT rcto_id AS ID FROM wfp_chd_recapcto WHERE rcto_dem='$nopers' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_recapcto WHERE rcto_dem='$nopers' " ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>Mois</th>
												<th>Total H / CTO</th>
												<th>Total H / CASH</th>
												<th></th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										echo("<tbody><tr class=\"default\"><td>".$result['rcto_mois']."</td>");
										echo("<td>".$result['rcto_durcto']."</td>");
										echo("<td>".$result['rcto_durcash']."</td>");
										echo("<td><button type=\"button\" class=\"btn btn-success btn-circle\" onclick=\"document.location='compensdet.php?id=".$result['rcto_id']."'\" title=\"Détails\"><i class=\"fa fa-list\"></i></button></td>");
										
										/*if ($result['lv_state']=='ATTENTE')
										{
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle\" onclick=\"document.location='rejectdjoummah.php?id=".$result['lv_id']."'\" title=\"Annuler\"><i class=\"fa fa-reply\"></i></button></td>");
										}
										/*if ($result['lv_state']=='APPROUVE2')
										{
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle\" onclick=\"document.location='rejectdjoummah.php?id=".$result['lv_id']."'\" title=\"Annuler\"><i class=\"fa fa-reply\"></i></button></td>");
										}*/
									}
								}
								else
								{
									echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande d'heures suppl&eacute;mentaires Traitée...<br /></div>") ;		
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
