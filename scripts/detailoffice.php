<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	
	if ($pseudo != "administrateur")
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
			<div class="col-lg-10">            
				<h1 class="page-header">Bureaux RBD Chad</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Liste personnel enregistr&eacute;
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">                    
							<?php
								include('connexion.php');
							
								$i=1;
								$exis = $mysqli->query("SELECT goffu_id AS ID FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_gestoffu WHERE goffu_type!='UNITE' ORDER BY goffu_type" ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Type</th>
												<th>Lieu</th>
												<th>Description</th>
												<th>Effectif</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										$nom		= $result['goffu_offlieu'];
										$nb 		= $mysqli->query("SELECT COUNT(*) AS nb FROM user WHERE unite LIKE '%$nom%' ")->fetch_array(); 
										$effectif	= $nb['nb'];
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['goffu_type']."</td>");	
										echo("<td>".$result['goffu_offlieu']."</td>");
										echo("<td>".$result['goffu_details']."</td>");
										echo("<td>".$effectif."</td>");
										echo("<td><button type=\"button\" class=\"btn btn-primary btn-circle\" onclick=\"document.location='userlistoff.php?id=".$nom."'\" title=\"DETAILS\"><i class=\"fa fa-list\"></i></button></td></tr>");
									
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-info\">Aucun enregistrement...</div>") ;		
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
			<!-- /.col-lg-6 -->
		</div>
		<!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>