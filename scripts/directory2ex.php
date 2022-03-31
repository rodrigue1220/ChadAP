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
			<style type="text/css"> .btn2{ width:200px; } </style>
            <div class="col-lg-12">
               <h1 class="page-header">
				<div align="right">
					<button type="button" class="btn btn2 btn-default" onclick="document.location='gestgourouss.php'" title="Rechercher factures"><i class="fa fa-search" fa-fw></i> RECHERCHER</button>
					<button type="button" class="btn btn2 btn-info" onclick="document.location='rapplistall.php'" title="Liste des Rappels"><i class="fa fa-spinner" fa-fw></i> LISTE RAPPEL</button>
					<button type="button" class="btn btn2 btn-danger" onclick="document.location='factallfinance.php'" title="Facture Finance"><i class="fa fa-money" fa-fw></i> FACTURE GLOBALE FIN</button>
					<button type="button" class="btn btn2 btn-warning" onclick="\" title="Rappeler Identification en Attente"><i class="fa fa-envelope" fa-fw></i> RAPPEL IDENTIFICATION</button>
				</div><br />
					Annuaire Informations G&eacute;n&eacute;rales...
				</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						Liste des Utilisateurs ACTIFS
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">                    
							<?php
							
								$i=1;
								$exis = $mysqli->query("SELECT id AS ID FROM user WHERE pseudo!='administrateur' AND state='ACTIF' ")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM user WHERE pseudo!='administrateur' AND state='ACTIF' ORDER BY nom " ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Nom et Pr&eacute;nom</th>
												<th>Unit&eacute;</th>
												<th>Tel 1</th>
												<th>Tel 2</th>
												<th>Ext.</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['nom']." ".$result['prenom']."</td>");	
										echo("<td>".$result['unite']."</td>");
										echo("<td>".$result['tel']."</td>");
										echo("<td>".$result['tel2']."</td>");
										echo("<td>".$result['ext']."</td>");										
										echo("<td><button type=\"button\" class=\"btn btn-warning btn-circle btn-xs\" onclick=\"document.location='dirmod.php?ide=".$result['id']."'\" title=\"MODIFIER\"><i class=\"fa fa-edit\"></i></button></td>");
										echo("<td><button type=\"button\" class=\"btn btn-success btn-circle btn-xs\" onclick=\"document.location='dirdet.php?ide=".$result['id']."'\" title=\"DETAILLER\"><i class=\"fa fa-list\"></i></button></td>");
							
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-info\">Aucun Compte Utilisateur...</div>") ;		
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
    <!-- /#page-wrapper -- echo("<td><button type=\"button\" class=\"btn btn-danger btn-circle btn-xs\" onclick=\"confirme('".$result['id']."')\" title=\"SUPPRIMER\"><i class=\"fa fa-remove\"></i></button></td>");
										>

<?php
	include("inc/ridjilene2.php");
?>