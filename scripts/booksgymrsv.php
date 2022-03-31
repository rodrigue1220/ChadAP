<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("inc/fonctionscalc.php");
	include('connexion.php');
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
        <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">            
				<h1 class="page-header">Mes R&eacute;servations</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		
        <div class="row">
			<div class="col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Liste de mes r&eacute;servations
					</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">                    
						<?php
							
							$i=1;
							$alyom = date("Y-m-d");
							$exis = $mysqli->query("SELECT pgymrv_id AS ID FROM wfp_chd_progymrv WHERE pgymrv_user='$pseudo' ")->fetch_array();
						
							if($exis['ID'] != 0)
							{
								$sql = "SELECT * FROM wfp_chd_progymrv WHERE pgymrv_user='$pseudo' ORDER BY pgymrv_date" ;
								$requete = $mysqli->query( $sql ) ;
								echo("<table class=\"table\">
									<thead><tr>
										<th>#</th>
										<th>Jour</th>
										<th>Equipe</th>
										<th></th>
									</tr> </thead>");
		
								while( $result = $requete->fetch_assoc()  )
								{
									echo("<tbody><tr class=\"default\"><td>".$i."</td>");
									echo("<td>".$result['pgymrv_jour']."</td>");
									echo("<td>".$result['pgymrv_eqp']."</td>");
									
									if (strtotime($result['pgymrv_jour'])>strtotime($alyom))
									{
										echo("<td><button class=\"btn btn-warning btn-circle\" onclick=\"document.location='#'\" title=\"ANNULER\"><i class=\"fa fa-reply\"></i></button></td></tr>");
									}
									else
									{
										echo("<td></td></tr>");
									}
									$i++;
								}
							}
							else
							{
								echo("<div class=\"alert alert-info\">Aucune reservation...</div>") ;		
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