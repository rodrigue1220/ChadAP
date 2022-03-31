<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

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
							<?php echo ("Facture de ".$_GET["tel"]." mois de ".$_GET["cle"]); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php
								require_once('config.php');
								require_once('verifications.php');
								include('connexion.php');
								
								$phone= $_GET["tel"];
								$mois = $_GET["cle"];
								$i=1;
								
								$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Officiels</th>
												<th>Priv&eacute;s</th>
												<th>Officiel (FCFA)</th>
												<th>Priv&eacute; (FCFA)</th>
												<th></th>
											</tr>
										</thead>");
											
									$sql = "SELECT * FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' " ;
									$requete = $mysqli->query( $sql ) ;
									while( $result = $requete->fetch_assoc()  )
									{		
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['rec_offtot']."</td>");	 
										echo("<td>".$result['rec_privtot']."</td>");
										echo("<td>".$result['rec_totoff']."</td>");
										echo("<td>".$result['rec_totpriv']."</td>");
										echo("<td><button type=\"button\" class=\"btn btn-success btn-circle btn-xs\" onclick=\"document.location='factdetails.php?cle=".$result['rec_mois']."&tel=".$result['rec_phone']." '\" title=\"Details Facture\"><i class=\"fa fa-list\"></i></button></td>");
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