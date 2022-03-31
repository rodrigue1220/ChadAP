<?php
	include('connexion.php');
	$sqle		= $mysqli->query("SELECT unite AS UN FROM user WHERE pseudo='$pseudo' ")->fetch_array();									
	$unite		= $sqle['UN'];
	$sofo		= substr(stristr($unite, '/'), 1);
?>
<div class="row">
    <div class="col-lg-12">            
        <h1 class="page-header">Demandes de Transport en Attente</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liste des demandes
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">                    
					<?php
						include('connexion.php');
							
						$i=1;
						$exis = $mysqli->query("SELECT reqst_id AS ID FROM wfp_chd_request WHERE reqst_statoic='AUTORISE' AND reqst_state='ATTENTE' AND reqst_sens='$sofo'")->fetch_array();
						
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