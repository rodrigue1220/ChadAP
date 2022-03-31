<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Demandes de SDR Approuv&eacute;es</h1>
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
						$exis = $mysqli->query("SELECT reqsdr_id AS ID FROM wfp_chd_requestsdr WHERE reqsdr_state='VALIDE'")->fetch_array();
						
						if($exis['ID'] != 0)
						{
							$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_state='VALIDE'" ;
							$requete = $mysqli->query( $sql ) ;
							echo("<table class=\"table\">
								<thead>
									<tr>
										<th>#</th>
										<th>Demandeur</th>
										<th>Raison</th>
										<th>Salle</th>
										<th>Date</th>
										<th>Soumis le</th>
										<th>Approuv&eacute; le</th>
									</tr>
								</thead>");
		
							while( $result = $requete->fetch_assoc()  )
							{
								$demandeur	= $result['reqsdr_deman'];
								$sqlz = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
								$requetez	= $mysqli->query( $sqlz );
								$resultz	= $requetez->fetch_assoc();
								$nom		= $resultz["nom"];
								$prenom 	= $resultz["prenom"];
								
								echo("<tbody><tr class=\"default\"><td>".$i."</td>");
								echo("<td>".$nom." ".$prenom."</td>");
								echo("<td>".$result['reqsdr_raison']."</td>");
								echo("<td>".$result['reqsdr_salle']."</td>");	
								if ($result['reqsdr_mind'] < 10)
								{
									echo("<td>".$result['reqsdr_deb']." ".$result['reqsdr_heurd']."h 0".$result['reqsdr_mind']."mn</td>");
								}
								else
								{
									echo("<td>".$result['reqsdr_deb']." ".$result['reqsdr_heurd']."h ".$result['reqsdr_mind']."mn</td>");
								}
								echo("<td>".$result['reqsdr_date']."</td>");
								echo("<td>".$result['reqsdr_dateact']."</td>");
								echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle\" onclick=\"document.location='detailreqstsdr.php?id=".$result['reqsdr_id']."'\" title=\"DETAILS\"><i class=\"fa fa-list\"></i></button></td>
									<td><button type=\"button\" class=\"btn btn-warning btn-circle\" onclick=\"document.location='modasksdr.php?id=".$result['reqsdr_id']."'\" title=\"MODIFIER\"><i class=\"fa fa-reply\"></i></button></td>
									<td><button type=\"button\" class=\"btn btn-danger btn-circle\" onclick=\"document.location='rejectasksdr.php?id=".$result['reqsdr_id']."'\" title=\"REJETER\"><i class=\"fa fa-times\"></i></button></td>");
										
								$i++;
							}
						}
						else
						{
							echo("<div class=\"alert alert-info\">Aucune demande Approuv&eacute;e...</div>") ;		
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
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->