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
						Facturation T&eacute;l&eacute;phonique 
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row echo("<td><button type=\"button\" class=\"btn btn-info btn-circle btn-xs\" onclick=\"document.location='factprint.php?cle=".$result['rec_mois']."&tel=".$result['rec_phone']." '\" title=\"Editer Facture\"><i class=\"fa fa-print\"></i></button></td>");
										-->
			<div class="row">
				<div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							<?php 
								$tot=$mysqli->query("SELECT SUM(rec_totpriv) AS TOT FROM wfp_chd_recapbil")->fetch_array();
								$total=$tot['TOT'];
								
								$totn=$mysqli->query("SELECT COUNT(DISTINCT rec_phone) AS TOT FROM wfp_chd_recapbil")->fetch_array();
								$totaln=$totn['TOT'];
								
								echo ("Facture pour Unit&eacute; Finance  <br />Nombre num&eacute;ros: <strong>".$totaln."</strong><br />P&eacute;riode: ");
								
								$sql = "SELECT DISTINCT rec_mois FROM wfp_chd_recapbil" ;
								$requete = $mysqli->query( $sql ) ;
								while( $result = $requete->fetch_assoc()  )
								{
								  echo ("<strong>".$result['rec_mois']."</strong>, ");
								}
								echo (" Total : <strong>".number_format($total,2,',','.')." FCFA</strong>");
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

								$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Cl&eacute;</th>
												<th>Utilisateur</th>
												<th>Num&eacute;ro</th>
												<th>Montant (FCFA)</th>
												<th>Mois</th>
											</tr>
										</thead>");
											
									$sql = "SELECT * FROM wfp_chd_recapbil ORDER BY rec_phone " ;
									$requete = $mysqli->query( $sql ) ;
									while( $result = $requete->fetch_assoc()  )
									{	
										$phone		= $result['rec_phone'];
										$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ORDER BY nom ";
										$requetep	= $mysqli->query( $sqlp );
										$resultp 	= $requetep->fetch_assoc();
										$nom  		= $resultp['nom'];
										$pnom 		= $resultp['prenom'];
										
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['rec_id']."</td>");
										echo("<td>".$nom." ".$pnom."</td>");
										echo("<td>".$result['rec_phone']."</td>");	 
										echo("<td>".number_format($result['rec_totpriv'],2,',','.')."</td>");
										echo("<td>".$result['rec_mois']."</td>");
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
                <!-- /.col-lg-6 -->
			</div>
            <!-- /.row -->
			
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>