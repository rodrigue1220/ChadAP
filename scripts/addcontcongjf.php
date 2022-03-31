<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
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
						<style type="text/css"> .btn{ width:200px; } </style>
						<div align="right">
							<button type="button" class="btn btn-primary" onclick="document.location='addcontcong.php'" title="Ajouter type de congés"><i class="fa fa-edit" fa-fw></i> Cong&eacute;s</button>
							<button type="button" class="btn btn-info" onclick="document.location='addcontcongj.php'" title="Méthode de cumul"><i class="fa fa-calculator" fa-fw></i> Jours/Cong&eacute;s/Contrat</button>
							<button type="button" class="btn btn-success" onclick="document.location='addcontcongp.php'" title="Créer profil employé"><i class="fa fa-user" fa-fw></i> Profils</button>
						</div><br />
                    D&eacute;finir jour de F&ecirc;te / jour F&eacute;ri&eacute; </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="add2congjf.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="jferie">Date :</label>
						<div class="col-sm-5">
							<input type="date" id="jferie" name="jferie" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="lib">Libell&eacute; :</label>
						<div class="col-sm-5">
							<textarea id="lib" name="lib" placeholder="Saisir la fête" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<input type="submit" class="btn btn-default" value="Enregistrer">
							<button type="reset" class="btn btn-danger">Effacer</button>
						</div>
					</div>
				</form>
            </div>
            <!-- /.row -->
            

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene2.php");
?>