<?php
	include('connexion.php');
	$sqle		= $mysqli->query("SELECT unite AS UN FROM user WHERE pseudo='$pseudo' ")->fetch_array();									
	$unite		= $sqle['UN'];
	$sofo		= substr(stristr($unite, '/'), 1);
?>

<br /><br /><br />
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tableau de bord</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-up fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> 
										<?php 
											include('connexion.php'); 
											$nba = $mysqli->query("SELECT COUNT(*) AS nba FROM wfp_chd_request WHERE reqst_statoic='AUTORISE' AND reqst_state='VALIDE' AND reqst_sens='$sofo' ")->fetch_array();
											$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='VALIDE' ")->fetch_array(); 
											$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' ")->fetch_array(); 
											$nbe = $mysqli->query("SELECT COUNT(*) AS nbeq FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state='TRAITE' ")->fetch_array();
											echo $nbt['nb']+$nbs['nbe']+$nba['nba']+$nbe['nbeq'];
										?>
									</div>
                                    <div>Approuv&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='details1approuv.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hand-o-right fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php 
											include('connexion.php'); 
											$nba = $mysqli->query("SELECT COUNT(*) AS nba FROM wfp_chd_request WHERE reqst_statoic='AUTORISE' AND reqst_state='ATTENTE'  AND reqst_sens='$sofo' ")->fetch_array();
											$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='ATTENTE' ")->fetch_array(); 
											$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE' ")->fetch_array(); 
											$nbe = $mysqli->query("SELECT COUNT(*) AS nbeq FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='ATTENTE' OR rqeqpmt_state LIKE '%APPROUV%') ")->fetch_array();
											echo $nbt['nb']+$nbs['nbe']+$nba['nba']+$nbe['nbeq'];
										?>
									</div>	
                                    <div>En attente</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='details1attente.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-down fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php 
											include('connexion.php'); 
											$nba = $mysqli->query("SELECT COUNT(*) AS nba FROM wfp_chd_request WHERE reqst_state='REJET'  AND reqst_sens='$sofo'")->fetch_array();
											$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='REJET' OR reqst_statoic='REJET') ")->fetch_array(); 
											$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='REJET' ")->fetch_array(); 
											$nbe = $mysqli->query("SELECT COUNT(*) AS nbeq FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='ANNULE' OR rqeqpmt_state LIKE '%REJET%') ")->fetch_array();
											echo $nbt['nb']+$nbs['nbe']+$nba['nba']+$nbe['nbeq'];
										?>
									</div>
                                    <div>Rejet&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='details1rejet.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php 
											include('connexion.php'); 
											$nba = $mysqli->query("SELECT COUNT(*) AS nba FROM wfp_chd_request WHERE reqst_state='EFFECTUE'  AND reqst_sens='$sofo'")->fetch_array();
											echo $nba['nba'];
										?>
									</div>
                                    <div>Effectu&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='detailseffectue.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Demandes de Transport en Attente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
								<?php
								include('connexion.php');
								
								$i=1;
								$exis = $mysqli->query("SELECT reqst_id AS ID FROM wfp_chd_request WHERE reqst_statoic='AUTORISE' AND reqst_state='ATTENTE' AND reqst_sens='$sofo' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_request WHERE reqst_statoic='AUTORISE' AND reqst_state='ATTENTE' AND reqst_sens='$sofo'" ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Demandeur</th>
												<th>Motif</th>
												<th>Destination</th>
												<th>D&eacute;part</th>
												<th>Retour</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										$demandeur	= $result['reqst_nom'];
										$sqlz = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
										$requetez	= $mysqli->query( $sqlz );
										$resultz	= $requetez->fetch_assoc();
										$nom		= $resultz["nom"];
										$prenom 	= $resultz["prenom"];
										
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nom." ".$prenom."</td>");
										echo("<td>".$result['reqst_motif']."</td>");
										echo("<td>".$result['reqst_dest']."</td>");	

										if ($result['reqst_mind'] < 10)
										{
											echo("<td>".$result['reqst_dep']." ".$result['reqst_heurd']."h 0".$result['reqst_mind']."mn</td>");
										}
										else
										{
											echo("<td>".$result['reqst_dep']." ".$result['reqst_heurd']."h ".$result['reqst_mind']."mn</td>");
										}
										
										if ($result['reqst_minr'] < 10)
										{
											echo("<td>".$result['reqst_ret']." ".$result['reqst_heurr']."h 0".$result['reqst_minr']."mn</td>");
										}
										else
										{
											echo("<td>".$result['reqst_ret']." ".$result['reqst_heurr']."h ".$result['reqst_minr']."mn</td>");
										}
										echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle\" onclick=\"document.location='detailreqst.php?id=".$result['reqst_id']."'\" title=\"DETAILS\"><i class=\"fa fa-list\"></i></button></td>
											<td><button type=\"button\" class=\"btn btn-success btn-circle\" onclick=\"document.location='validask.php?id=".$result['reqst_id']."'\" title=\"VALIDER\"><i class=\"fa fa-check\"></i></button></td>
											<td><button type=\"button\" class=\"btn btn-danger btn-circle\" onclick=\"document.location='rejectask.php?id=".$result['reqst_id']."'\" title=\"REJETER\"><i class=\"fa fa-times\"></i></button></td>");
										
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-info\">Aucune demande en attente de traitement...</div>") ;		
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
				include("connexion.php");
				$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
				$requete = $mysqli->query( $sql );
				$result = $requete->fetch_assoc();
				$nom = $result["nom"];
				$prenom = $result["prenom"];
				$i=1;
				
				$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom'")->fetch_array();
				if($oic['ID'] != 0)
				{					
					echo("<div class=\"row\">
							<div class=\"col-lg-12\">
								<div class=\"panel panel-default\">
									<div class=\"panel-heading\">");
										echo ("Demandes de Transport &agrave; Autoriser
									</div>
									<!-- /.panel-heading -->
								<div class=\"panel-body\">
									<div class=\"table-responsive\">");
					
					$existe = $mysqli->query("SELECT reqst_id AS ID FROM wfp_chd_request WHERE reqst_oic='$nom,$prenom' AND reqst_statoic='ATTENTE' AND reqst_state='ATTENTE'")->fetch_array();
					if($existe['ID'] != 0)
					{
						$sql1 = "SELECT * FROM wfp_chd_request WHERE reqst_oic='$nom,$prenom' AND reqst_statoic='ATTENTE' AND reqst_state='ATTENTE'" ;
						$requete1 = $mysqli->query( $sql1 ) ;
						echo("<table class=\"table\">
						<thead>
							<tr>
								<th>#</th>
								<th>Demandeur</th>
								<th>Motif</th>
								<th>Destination</th>
								<th>D&eacute;part</th>
								<th>Retour</th>
							</tr>
						</thead>");
					
						while( $result1 = $requete1->fetch_assoc()  )
						{
							$demandeur	= $result1['reqst_nom'];
							$sqlz = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
							$requetez	= $mysqli->query( $sqlz );
							$resultz	= $requetez->fetch_assoc();
							$nom		= $resultz["nom"];
							$prenom 	= $resultz["prenom"];
							
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$nom." ".$prenom."</td>");
							echo("<td>".$result1['reqst_motif']."</td>");
							echo("<td>".$result1['reqst_dest']."</td>");	
							if ($result1['reqst_mind'] < 10)
							{
								echo("<td>".$result1['reqst_dep']." ".$result1['reqst_heurd']."h 0".$result1['reqst_mind']."mn</td>");
							}
							else
							{
								echo("<td>".$result1['reqst_dep']." ".$result1['reqst_heurd']."h ".$result1['reqst_mind']."mn</td>");
							}
						
							if ($result1['reqst_minr'] < 10)
							{
								echo("<td>".$result1['reqst_ret']." ".$result1['reqst_heurr']."h 0".$result1['reqst_minr']."mn</td>");
							}
							else
							{
								echo("<td>".$result1['reqst_ret']." ".$result1['reqst_heurr']."h ".$result1['reqst_minr']."mn</td>");
							}	
							echo("<td><a href=\"auto1ask.php?id=".$result1['reqst_id']."\"><button type=\"button\" class=\"btn btn-info btn-xs\" title=\"AUTORISER\">AUTORISER</button></a></td>");
							echo("<td><a href=\"rejectaskoic.php?id=".$result1['reqst_id']."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" title=\"REJETER\">REJETER</button></a></td>");
							$i++;
						}
					}
					else
					{
						echo("<div class=\"alert alert-info\">Aucune demande &agrave; autoriser...</div>") ;		
					}								
							echo("</tr></tbody></table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
					</div>");
				}				
			?>
			
			
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Liste des Chauffeurs
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');
								
								$i=1;
								$exis = $mysqli->query("SELECT chauf_id AS ID FROM wfp_chd_chauffeur WHERE chauf_sens='$sofo' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_chauffeur WHERE chauf_sens='$sofo'" ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table table-striped table-bordered table-hover\">
										<thead>
											<tr>
												<th>#</th>
												<th>Noms</th>
												<th>Pr&eacute;noms</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['chauf_nom']."</td>");
										echo("<td>".$result['chauf_pnom']."</td>");	 
										$i++;
									}
									echo("</tr></tbody></table>");
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Aucun enregistrement...</div>") ;		
								}
							?>
                               
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Liste des V&eacute;hicules
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
								<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');
								
								$i=1;
								$exis = $mysqli->query("SELECT flot_id AS ID FROM wfp_chd_flotte WHERE flot_sens='$sofo'")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_flotte WHERE flot_sens='$sofo'" ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table table-striped table-bordered table-hover\">
										<thead>
											<tr>
												<th>#</th>
												<th>Immatriculation</th>
												<th>Marques</th>
												<th>D&eacute;tails</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['flot_immat']."</td>");
										echo("<td>".$result['flot_marq']."</td>");
										echo("<td>".$result['flot_det']."</td>");										
										$i++;
									}
									echo("</tr></tbody></table>");
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Aucun enregistrement...</div>") ;		
								}
							?>
							
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