<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminBILLING")
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
                    <h1 class="page-header">
						<div align="right">
							<?php 
								echo("<button type=\"button\" class=\"btn btn-danger\" onclick=\"document.location='factnidenpm.php'\" title=\"Liste NON IDENTIFIE\"><i class=\"fa fa-money\" fa-fw></i> NON IDENTIFIE</button>");
								echo(" <button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='factidenpm.php'\" title=\"Liste IDENTIFIE\"><i class=\"fa fa-money\" fa-fw></i> IDENTIFIE</button>")						
							?>
						</div>
						Rappels Identifications 
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row echo("<td><button type=\"button\" class=\"btn btn-info btn-circle btn-xs\" onclick=\"document.location='factprint.php?cle=".$result['rec_mois']."&tel=".$result['rec_phone']." '\" title=\"Editer Facture\"><i class=\"fa fa-print\"></i></button></td>");
										-->
			<div class="row">
				<div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							<?php 
								$nombre = $mysqli->query("SELECT COUNT(his_id) AS nb FROM wfp_chd_tarikh WHERE his_lib1='RAPPEL IDENTIFICATION' ")->fetch_array();
								$nbr=$nombre["nb"];
								echo ("Liste des rappels d'identification envoy&eacute;s <br />Total : <strong>".$nbr."</strong>"); 
							?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');
								
								$i=1;

								$exis = $mysqli->query("SELECT his_id AS ID FROM wfp_chd_tarikh WHERE his_lib1='RAPPEL IDENTIFICATION' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Utilisateur</th>
												<th>Mois</th>
												<th>Num&eacute;ro</th>
												<th>Date Rappel</th>
												<th>Etat</th>
											</tr>
										</thead>");
											
									$sql = "SELECT * FROM wfp_chd_tarikh WHERE his_lib1='RAPPEL IDENTIFICATION' ORDER BY his_lib2 " ;
									$requete = $mysqli->query( $sql ) ;
									while( $result = $requete->fetch_assoc()  )
									{	
										$pseudo		= $result['his_lib2'];
										$mois		= $result['his_user'];
										$sqlz		= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
										$requetez	= $mysqli->query( $sqlz ) ;
										$resultz	= $requetez->fetch_assoc();
										
										$phone 		= $resultz['tel'];
										$phone2 	= $resultz['tel2'];
										$statu		= $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' ")->fetch_array();

										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$resultz['nom']." ".$resultz['prenom']."</td>");
										echo("<td>".$result['his_user']."</td>");
										if ($phone!='NULL') 
										{
											echo("<td>".$phone."</td>");
										}
										else
										{
											echo("<td>".$phone2."</td>");
										}
										echo("<td>".$result['his_date']."</td>");
										if ($statu['nb']==0) 
										{
											echo("<td bgcolor=\"#FF0000\">NON IDENTIFIE</td>");
										}
										else
										{
											echo("<td bgcolor=\"#00FF00\">IDENTIFIE</td>");
										}
										$i++;
									}
									echo("</tr></tbody></table>");
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Aucun Rappel envoy&eacute; ...</div>") ;	
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
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>