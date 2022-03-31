<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$prof2 = $result["profil2"];
	$unite = $result["unite"];
				
	if($prof2!="AdminSU" AND $unite!="ADMIN-FINANCE/CO NDJAMENA")
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
							<button type="button" class="btn btn-warning" onclick="document.location='stockvarfourn.php'" title="ENTREES / SORTIES STOCK"><i class="fa fa-sign-in" fa-fw></i> Variations Stock <i class="fa fa-sign-out" fa-fw></i></button>
						</div><br />
						Demandes de fournitures 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Liste des demandes de fourniture en attente d'approbation du OIC / ADMIN
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
								<?php
								include('connexion.php');
								
								$i=1;
								$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_state='ADMINATT' AND rqeqpmt_type='FOURN' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_type='FOURN' AND rqeqpmt_state='ADMINATT' " ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Demandeur</th>
												<th>Item Description</th>
												<th>Raison</th>
												<th>Nombre</th>
												<th>En Stock</th>
												<th colspan=\"2\">Action</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										$demandeur	= $result['rqeqpmt_demand'];
										$item		= $result['rqeqpmt_item'];
										$sqlz 		= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
										$requetez	= $mysqli->query( $sqlz );
										$resultz	= $requetez->fetch_assoc();
										$nom		= $resultz["nom"];
										$prenom 	= $resultz["prenom"];
										
										$sqlw 		= "SELECT * FROM wfp_chd_sandouk WHERE stock_item='$item' " ;
										$requetew	= $mysqli->query( $sqlw );
										$resultw	= $requetew->fetch_assoc();
										$nombre		= $resultw["stock_nbr"];
										
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nom." ".$prenom."</td>");
										echo("<td>".$result['rqeqpmt_item']."</td>");
										echo("<td>".$result['rqeqpmt_motif']."</td>");
										echo("<td>".$result['rqeqpmt_nbr']."</td>");	
										
										if ($nombre > 0)
										{
											if ($result['rqeqpmt_nbr']>$nombre)
											{
												echo("<td bgcolor=\"#FF0000\">".$nombre."</td>");
											}
											else
											{
												echo("<td bgcolor=\"#00FF00\">".$nombre."</td>");
											}
										}
										else
										{
											echo("<td>N/D</td>");
										}
										echo("<td><a href=\"autoaskfour.php?id=".$result['rqeqpmt_id']."\"><button type=\"button\" class=\"btn btn-success btn-circle btn-xs\" title=\"APPROUVER\"><i class=\"fa fa-check\"></i></button></a></td>");
										echo("<td><a href=\"rejectaskfour.php?id=".$result['rqeqpmt_id']."\"><button type=\"button\" class=\"btn btn-danger btn-circle btn-xs\" title=\"REJETER\"><i class=\"fa fa-remove\"></i></button></a></td></tr>");
										
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-danger\">Aucune demande de fourniture en attente d'approbation par OIC / ADMIN...</div>") ;		
								}
							?>
								
								</tbody></table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
		   
		   
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>