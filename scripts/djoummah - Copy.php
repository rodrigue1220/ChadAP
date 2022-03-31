<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("inc/fonctionscalc.php");
	include('connexion.php');
	
	$indx	= $mysqli->query("SELECT indexid AS IND FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$pers	= $indx["IND"];
	$cpt	= $mysqli->query("SELECT rh_statut AS PROF FROM wfp_chd_personnel WHERE rh_nopers='$pers'")->fetch_array();
	$etapro	= $cpt["PROF"];
	
	if ($etapro != "ACTIF")
	{
		header('Location:oops33.php');
	}
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
				<style type="text/css"> .btn2{ width:180px; } </style>
                    <h1 class="page-header">
						Leaves System
						<div align="right">
							<?php
								
								$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
								$nopers = $exis['ID'];
								$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state=''")->fetch_array();		
								if($nb['nb']!=0)
								{
									echo ("<button type=\"button\" class=\"btn btn-success btn2\" onclick=\"document.location='vadjoummahask.php'\" title=\"Confirmer Demande de Cong&eacute;s\"><i class=\"fa fa-check\" fa-fw></i> Confirmer Demande</button>");
								}
								else
								{
									$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state LIKE '%APPROUVE%'")->fetch_array();		
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
								/*if($pseudo=="zimbos" || $pseudo=="tsaringarti")
								{
									echo (" <button type=\"button\" class=\"btn btn-info btn2\" onclick=\"document.location='compenscto.php'\" title=\"Heures Supp et CTO\"><i class=\"fa fa-money\" fa-fw></i> Compensations</button>");
								}*/
							?>
							<button type="button" class="btn btn-info btn2" onclick="document.location='compenscto.php'" title="Heures Supp et CTO"><i class="fa fa-money" fa-fw></i> Compensations</button>
							<button type="button" class="btn btn-warning btn2" onclick="document.location='djoummahatt.php'" title="Liste des Demandes de Cong&eacute;s"><i class="fa fa-list" fa-fw></i> Liste des Demandes</button>
						</div>
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							Cong&eacute;s Annuel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');

								$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
								$nopers = $exis['ID'];
								
								if($nopers != "N/D")
								{
									echo("<table class=\"table table-striped table-bordered table-hover\">
										<thead>
											<tr>
												<th>Index</th>
												<th>Solde</th>
												<th>Au</th>
											</tr>
										</thead>");
										
									$sqlz 		= "SELECT * FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='AL' " ;
									$requetez	= $mysqli->query( $sqlz );
									$resultz	= $requetez->fetch_assoc();
									$solde		= $resultz["leave_solde"];
									$wakit		= $resultz["leave_ldate"];
									$ldate 		= date("Y-m-d");
									
									if ($ldate <= $wakit)
									{
										echo("<tbody><tr class=\"default\"><td>".$nopers."</td>");
										echo("<td>".$solde."</td>");
										echo("<td>".$wakit."</td></tr></tbody>");
									}
									else
									{
										$nbjourcong = getEstimCalc($ldate,$wakit);
										$total		= $nbjourcong+$solde;
									
										echo("<tbody><tr class=\"default\"><td>".$nopers."</td>");
										echo("<td>".$total."</td>");
										echo("<td>".$ldate."</td></tr></tbody>");
									}
									echo("</table>");
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Votre Index n'est pas Assign&eacute; &agrave; votre Compte ...</div>") ;		
								}
							?>
                               
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
						
						<form class="form-horizontal" name="formulaire" action="estimdjoummah.php" method="post" >					
							<div class="form-group">
								<label class="control-label col-sm-5" for="wakit">Date pr&eacute;visionnelle :</label>
								<div class="col-sm-5">
									<input type="text" id="wakit" name="wakit" placeholder="aaaa-mm-jj OU mm/jj/aaaa" class="form-control" required />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-5">
									<input type="submit" class="btn btn-success" value="Estimer" />
									<input type="reset" class="btn btn-danger" value="Effacer" />
								</div>
							</div>
						</form>						
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
				<div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							R & R
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');

								$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
								$nopers = $exis['ID'];
								
								if($nopers != "N/D")
								{
									$exist	= $mysqli->query("SELECT leave_id AS ID FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();
									$test	= $exist['ID'];
									
									if($test != 0)
									{
										echo("<table class=\"table table-striped table-bordered table-hover\">
											<thead>
												<tr>
													<th>Dernier R&R</th>
													<th>Solde</th>
													<th>Au</th>
												</tr>
											</thead>");
										
										$sqlz 		= "SELECT * FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' " ;
										$requetez	= $mysqli->query( $sqlz );
										while ($resultz	= $requetez->fetch_assoc())
										{
											$solde		= $resultz["leave_solde"];
											$wakit		= $resultz["leave_ldate"];
											$ldate 		= date("Y-m-d");
											$nbjour		= (strtotime($ldate)-strtotime($wakit))/86400;
											echo("<tbody><tr class=\"default\"><td>".$wakit."</td>");
											if ($nbjour>=56)
											{
												echo("<td>4</td>");
											}
											else 
											{
												echo("<td>0</td>");
											}
											echo("<td>".$ldate."</td></tr></tbody>");
										}
										echo("</table>");
										echo("</div><!-- /.table-responsive -->
											</div><!-- /.panel-body -->
												<form class=\"form-horizontal\" name=\"formulaire\" action=\"#\" method=\"post\" >					
												<div class=\"form-group\">
													<label class=\"control-label col-sm-5\" for=\"wakit\">Date pr&eacute;visionnelle :</label>
													<div class=\"col-sm-5\">
														<input type=\"text\" id=\"wakit\" name=\"wakit\" placeholder=\"aaaa-mm-jj OU mm/jj/aaaa\" class=\"form-control\" required />
													</div>
												</div>
												<div class=\"form-group\">
													<div class=\"col-sm-offset-4 col-sm-5\">
														<input type=\"submit\" class=\"btn btn-success\" value=\"Estimer\" />
														<input type=\"reset\" class=\"btn btn-danger\" value=\"Effacer\" />
													</div>
												</div>
												</form>");	
									}
									else
									{
										echo("<div class=\"alert alert-warning\">Vous n'avez pas droit au R & R ...</div>") ;		
									}
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Votre Index n'est pas Assign&eacute; &agrave; votre Compte ...</div>") ;		
								}
							?>					
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