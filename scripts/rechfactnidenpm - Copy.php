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
								echo("<button type=\"button\" class=\"btn btn-info\" onclick=\"document.location='rapplist.php?cle=".$mois." '\" title=\"Liste des Rappels\"><i class=\"fa fa-spinner\" fa-fw></i> LISTE RAPPEL</button>");
								echo(" <button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='rechfactidenpm.php?cle=".$mois." '\" title=\"Liste IDENTIFIE\"><i class=\"fa fa-money\" fa-fw></i> IDENTIFIE ".$mois."</button>");
								
							?>
						</div>
						<br />Recherche de (s) facture (s) non identifi&eacute; (s) de : <?php echo ("<font color=\"red\">".$_GET["cle"]."</font>"); ?>
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							Liste de (s) facture (s) en Attente d'Identification
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
								
								if (substr($mois, -1)=="9")
								{
									$exis = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp WHERE MONTH='$mois' AND STATE='ATTENTE' ")->fetch_array();
								}
								else
								{
									$exis = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp_archv WHERE MONTH='$mois' AND STATE='ATTENTE' ")->fetch_array();
								}
								if($exis['ID'] != 0)
								{
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Utilisateur</th>
												<th>Num&eacute;ro</th>
												<th colspan=\"3\" align=\"center\">Actions</th>
											</tr>
										</thead>");
											
									if (substr($mois, -1)=="9")
									{
										$sql = "SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp WHERE MONTH='$mois' AND STATE='ATTENTE' ORDER BY MSISDN_NO " ;
									}
									else
									{
										$sql = "SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp_archv WHERE MONTH='$mois' AND STATE='ATTENTE' ORDER BY MSISDN_NO " ;
									}
										
									$requete = $mysqli->query( $sql ) ;
									while( $result = $requete->fetch_assoc()  )
									{	
										$phone		= $result['MSISDN_NO'];
										$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ";
										$requetep	= $mysqli->query( $sqlp );
										$resultp 	= $requetep->fetch_assoc();
										$nom  		= $resultp['nom'];
										$pnom 		= $resultp['prenom'];
										
											echo("<tbody><tr class=\"default\"><td>".$i."</td>");
											echo("<td>".$nom." ".$pnom."</td>");
											echo("<td>".$phone."</td>");	 
											echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle btn-xs\" onclick=\"document.location='factdetails.php?cle=".$mois."&tel=".$phone." '\" title=\"Details Facture\"><i class=\"fa fa-list\"></i></button></td>");
											echo("<td><button type=\"button\" class=\"btn btn-success btn-circle btn-xs\" onclick=\"document.location='gouroussfactforc.php?cle=".$mois."&tel=".$phone." '\" title=\"Forcer Generation Facture\"><i class=\"fa fa-check\"></i></button></td>");								
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle btn-xs\" onclick=\"document.location='inc/rissalarapindiv.php?cle=".$mois."&tel=".$phone." '\" title=\"Rappel Email\"><i class=\"fa fa-envelope\"></i></button></td>");
											echo("<td><button type=\"button\" class=\"btn btn-danger btn-circle btn-xs\" onclick=\"document.location='delfact.php?cle=".$mois."&tel=".$phone." '\" title=\"Supprimer Details Identification\"><i class=\"fa fa-remove\"></i></button></td></tr>");

										$i++;
									}
									
									/*$sql2 = "SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp_archv WHERE MONTH='$mois' AND STATE='ATTENTE' ORDER BY MSISDN_NO " ;
									$requete2 = $mysqli->query( $sql ) ;
									while( $result2 = $requete2->fetch_assoc()  )
									{	
										$phone		= $result2['MSISDN_NO'];
										$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ";
										$requetep	= $mysqli->query( $sqlp );
										$resultp 	= $requetep->fetch_assoc();
										$nom  		= $resultp['nom'];
										$pnom 		= $resultp['prenom'];
										
											echo("<tbody><tr class=\"default\"><td>".$i."</td>");
											echo("<td>".$nom." ".$pnom."</td>");
											echo("<td>".$phone."</td>");	 
											echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle btn-xs\" onclick=\"document.location='factdetails.php?opt=archv&cle=".$mois."&tel=".$phone." '\" title=\"Details Facture\"><i class=\"fa fa-list\"></i></button></td>");
											echo("<td><button type=\"button\" class=\"btn btn-success btn-circle btn-xs\" onclick=\"document.location='gouroussfactforc.php?opt=archv&cle=".$mois."&tel=".$phone." '\" title=\"Forcer Generation Facture\"><i class=\"fa fa-check\"></i></button></td>");								
											echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle btn-xs\" onclick=\"document.location='inc/rissalarapindiv.php?opt=archv&cle=".$mois."&tel=".$phone." '\" title=\"Rappel Email\"><i class=\"fa fa-envelope\"></i></button></td>");
											echo("<td><button type=\"button\" class=\"btn btn-danger btn-circle btn-xs\" onclick=\"document.location='delfact.php?opt=archv&cle=".$mois."&tel=".$phone." '\" title=\"Supprimer Details Identification\"><i class=\"fa fa-remove\"></i></button></td></tr>");

										$i++;
									}*/
									
									echo("</tbody></table>");
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