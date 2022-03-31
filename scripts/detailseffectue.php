<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
	include('connexion.php');
	$sqle		= $mysqli->query("SELECT unite AS UN FROM user WHERE pseudo='$pseudo' ")->fetch_array();									
	$unite		= $sqle['UN'];
	$sofo		= substr(stristr($unite, '/'), 1);
?>
		<br /><br /><br />
		<div id="page-wrapper">

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Demandes de Transport Effectu&eacute;es</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->			
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                Liste des demandes
            </div>
            <!-- /.panel-heading -->
			<div class="panel-body">
                <div class="table-responsive">
                    <?php
						include('connexion.php');
								
						$i=1;
						$exis = $mysqli->query("SELECT reqst_id AS ID FROM wfp_chd_request WHERE reqst_state='EFFECTUE' AND reqst_sens='$sofo'")->fetch_array();
						
						if($exis['ID'] != 0)
						{
							$sql = "SELECT * FROM wfp_chd_request WHERE reqst_state='EFFECTUE' AND reqst_sens='$sofo'" ;
							$requete = $mysqli->query( $sql ) ;
							echo("<table class=\"table\">
								<thead>
									<tr>
										<th>#</th>
										<th>Demandeur</th>
										<th>Motif</th>
										<th>Destination</th>
										<th>D&eacute;part</th>
										<th>Chauffeur</th>
										<th>Mobile</th>
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
								echo("<td>".$result['reqst_chauf']."</td>");
								echo("<td>".$result['reqst_vehicle']."</td>");
								echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle\" onclick=\"document.location='detail2reqst2.php?id=".$result['reqst_id']."'\" title=\"DETAILS\"><i class=\"fa fa-list\"></i></button></td>");
									
								$i++;
							}
						}
						else
						{
							echo("<div class=\"alert alert-info\">Aucune demande Effectu&eacute;e...</div>") ;		
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
</div>
<?php
	include("inc/ridjilene2.php");
?>