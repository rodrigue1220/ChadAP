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
                <div class="col-lg-12">
                    <h1 class="page-header">
						<div align="right">
							<?php 
								echo("<button type=\"button\" class=\"btn btn-primary\" onclick=\"document.location='addprofil.php'\" title=\"Ajouter Profil\"><i class=\"fa fa-plus fa-fw\"></i> Enregistrer nouveau Profil</button>");
								echo("&nbsp;<button type=\"button\" class=\"btn btn-info\" onclick=\"document.location='assprofil.php'\" title=\"Assigner Profil\"><i class=\"fa fa-asterisk fa-fw\"></i> Assigner Profil</button>");		
							?>
						</div>
						D&eacute;sactiver Compte Utilisateur 
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="desacompte2.php" method="post" onsubmit="return verif_formulaire()" >
					<input type="hidden" id="choix" name="choix" value="DESC" />
					<div class="form-group">
						<label class="control-label col-sm-3" for="nom">Utilisateur :</label>
						<div class="col-sm-5">
							<select class="form-control" id="nom" name="nom" required>
								<option>Choisir..</option>
								<?php
									include('connexion.php');
									$sqlb 	= "SELECT * FROM user WHERE state='ACTIF' ORDER BY nom " ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['nom'].",".$resultb['prenom']."</option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-3">
							<input type="submit" class="btn btn-default" value="D&eacute;sactiver">
							<button type="reset" class="btn btn-danger">Annuler</button>
						</div>
					</div>
				</form>
            </div>
            <!-- /.row -->
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
						Activer Compte Utilisateur
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="desacompte2.php" method="post" onsubmit="return verif_formulaire()" >
					<input type="hidden" id="choix" name="choix" value="ACT" />
					<div class="form-group">
						<label class="control-label col-sm-3" for="nom">Utilisateur :</label>
						<div class="col-sm-5">
							<select class="form-control" id="nom" name="nom" required>
								<option>Choisir..</option>
								<?php
									include('connexion.php');
									$sqlb 	= "SELECT * FROM user WHERE state='INACTIF' ORDER BY nom " ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['nom'].",".$resultb['prenom']."</option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-3">
							<input type="submit" class="btn btn-default" value="Activer">
							<button type="reset" class="btn btn-danger">Annuler</button>
						</div>
					</div>
				</form>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>