<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("inc/fonctionscalc.php");

	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						Leaves System
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
									echo ("<button type=\"button\" class=\"btn btn-primary\" onclick=\"document.location='djoummahask.php'\" title=\"Nouvelle Demande de Cong&eacute;s\"><i class=\"fa fa-edit\" fa-fw></i> Nouvelle Demande</button>");
							    }
							?>
							<button type="button" class="btn btn-warning" onclick="document.location='djoummahatt.php'" title=" Liste des Demandes de Cong&eacute;s"><i class="fa fa-list" fa-fw></i> Liste des Demandes</button>
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
										
									$sqlz 		= "SELECT * FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' " ;
									$requetez	= $mysqli->query( $sqlz );
									$resultz	= $requetez->fetch_assoc();
									$solde		= $resultz["leave_solde"];
									$ldate		= $resultz["leave_ldate"];
									$wakit		= $_POST["wakit"];
									if (strtotime($wakit)<strtotime($ldate))
									{
										echo("<div class=\"alert alert-danger\">Date pr&eacute;visionnelle incorrecte...</div>") ;		
										
										echo("<tbody><tr class=\"default\"><td>".$nopers."</td>");
										echo("<td>".$solde."</td>");
										echo("<td>".$ldate."</td></tr></tbody>");
										echo("</table>");
									}
									else 
									{
										$nbjourcong = getEstimCalc($ldate,$wakit);
										$total		= $nbjourcong+$solde;
									
										echo("<tbody><tr class=\"default\"><td>".$nopers."</td>");
										echo("<td>".$total."</td>");
										echo("<td>".$wakit."</td></tr></tbody>");
										echo("</table>");
									}
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Votre Index n'est pas Assign&eacute; &agrave; votre Compte Ou Staff NON NATIONAL...</div>") ;		
								}
							?>
                               
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
						
						<form class="form-horizontal" name="formulaire" action="estimdjoummah.php" method="post" onsubmit="return verif_formulaire()" >					
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
			</div>
            <!-- /.row -->			
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>