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
								$mois= $_GET["cle"];
								echo("<button type=\"button\" class=\"btn btn-warning\" onclick=\"document.location='factchaharfinance.php?cle=".$mois." '\" title=\"Facture Finance\"><i class=\"fa fa-money\" fa-fw></i> FACTURE FINANCE</button>");
								echo(" <button type=\"button\" class=\"btn btn-info\" onclick=\"document.location='rapplist.php?cle=".$mois." '\" title=\"Liste des Rappels\"><i class=\"fa fa-spinner\" fa-fw></i> LISTE RAPPEL</button>");
								echo(" <button type=\"button\" class=\"btn btn-danger\" onclick=\"document.location='rechfactnidenpm.php?cle=".$mois." '\" title=\"Liste NON IDENTIFIE\"><i class=\"fa fa-money\" fa-fw></i> NON IDENTIFIE ".$mois."</button>");								
							?>
						</div>
						<br />Facture (s) identifi&eacute; (s) de : <?php echo ("<font color=\"red\">".$_GET["cle"]."</font>"); ?>
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							Liste de (s) facture (s) Identifi&eacute;e (s)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
								
								<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');
								
								$mois= $_GET["cle"];
								$i=1;
								
								$exis = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp WHERE MONTH='$mois' AND STATE='IDENTIFIE' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Utilisateur</th>
												<th>Num&eacute;ro</th>
												<th>Etat Facture</th>
												<th colspan=\"3\" align=\"center\">Actions</th>
											</tr>
										</thead>");
											
									$sql = "SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp WHERE MONTH='$mois' AND STATE='IDENTIFIE' ORDER BY MSISDN_NO " ;
									$requete = $mysqli->query( $sql ) ;
									while( $result = $requete->fetch_assoc()  )
									{	
										$phone		= $result['MSISDN_NO'];
										$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ";
										$requetep	= $mysqli->query( $sqlp );
										$resultp 	= $requetep->fetch_assoc();
										$nom  		= $resultp['nom'];
										$pnom 		= $resultp['prenom'];
										
										$exisf		 = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' ")->fetch_array();
										
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nom." ".$pnom."</td>");
										echo("<td>".$phone."</td>");
										if ($exisf['ID'] != 0)
										{
											echo("<td><font color=\"green\">GENEREE</font></td>");
										}
										else 
										{
											echo("<td><font color=\"red\">NON GENEREE</font></td>");
										}
										echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle btn-xs\" onclick=\"document.location='factchahar2.php?cle=".$mois."&tel=".$phone." '\" title=\"Facture\"><i class=\"fa fa-list\"></i></button></td>");
										
										$exist = $mysqli->query("SELECT COUNT(his_id) AS ID FROM wfp_chd_tarikh WHERE his_lib2='$mois' AND his_lib1='IMPRIME' ")->fetch_array();						
										if($exist['ID'] == 0)
										{
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle btn-xs\" onclick=\"document.location='gaboulouiden.php?cle=".$mois."&tel=".$phone." '\" title=\"Annuler Identification\"><i class=\"fa fa-reply\"></i></button></td>");
										}
										echo("<td><button type=\"button\" class=\"btn btn-success btn-circle btn-xs\" onclick=\"document.location='gouroussfactfin.php?chahar=".$mois."&tel=".$phone." '\" title=\"End Identification\"><i class=\"fa fa-check\"></i></button></td>");
										$i++;
									}
									echo("</tr></tbody></table>");
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Aucune Facture Disponible...</div>") ;	
								}
							?>
								
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
			</div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>