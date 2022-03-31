<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	if ($pseudo != "administrateur")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
<script language="javascript">
      function confirme( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment desactiver ce Compte ?" ) ;
		if( confirmation )
		{
			document.location.href = "desacpte.php?id="+identifiant ;
		}
      }
</script>

	<br /><br /><br />
    <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">            
				<h1 class="page-header">
				<!--div align="right">
					<a href="Liste_Employes.csv"><button type="button" class="btn btn-default" title="Exporter la liste des employés"><i class="fa fa-file-excel-o" fa-fw></i> Export CSV</button></a>
				</div-->
				Suggestions & Commentaires Utilisateurs</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						Liste des Suggestions & Commentaires
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">                    
							<?php

								$i=1;
								$exis = $mysqli->query("SELECT sgc_id AS ID FROM wfp_chd_sugcom")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_sugcom ORDER BY sgc_date" ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												
												<th>N&deg;</th>
												<th>Nom et Pr&eacute;nom</th>
												<th>Module</th>
												<th>Remarque</th>
												<th>Proposition</th>
												<th>Date</th>
												<th>Contacter</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										$user = $result['sgc_user'];
										$sqlz = "SELECT * FROM user WHERE pseudo='$user' " ;
										$requetez	= $mysqli->query( $sqlz );
										$resultz	= $requetez->fetch_assoc();
										$nom		= $resultz["nom"];
										$prenom 	= $resultz["prenom"];
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nom." ".$prenom."</td>");
										echo("<td>".$result['sgc_module']."</td>");											
										echo("<td>".$result['sgc_rq']."</td>");
										echo("<td>".$result['sgc_propos']."</td>");	
										echo("<td>".$result['sgc_date']."</td>");	
										echo("<td>".$result['sgc_choix']."</td>");	
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-danger\">Aucun Profil Employ&eacute; Actif...</div>") ;		
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