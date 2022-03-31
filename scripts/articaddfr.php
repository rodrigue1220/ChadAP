<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminFOURN")
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
							<button type="button" class="btn btn-primary" onclick="document.location='stockaddfourn.php'" title="ENTREE STOCK"><i class="fa fa-sign-in" fa-fw></i> Entr&eacute;es</button>
							<button type="button" class="btn btn-info" onclick="document.location='stocksortfourn.php'" title="SORTIE STOCK"><i class="fa fa-sign-out" fa-fw></i> Sorties</button>
							<button type="button" class="btn btn-success" onclick="document.location='listdemfourn.php'" title="Liste des demandes de fourniture"><i class="fa fa-pencil-square" fa-fw></i> Demandes</button>
						</div><br />
						Cr&eacute;er un Nouvel Article
                    </h1><br />
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="articadd2fr.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="item">Item Description :</label>
						<div class="col-sm-5">
							<input type="text" id="item" name="item" class="form-control" placeholder="Saisir le nom de l'article " required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="seuil">Seuil Alerte :</label>
						<div class="col-sm-5">
							<input type="text" id="seuil" name="seuil" class="form-control" placeholder="Renseigner le nombre du seuil d'alerte " required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="desc">Description :</label>
						<div class="col-sm-5">
							<textarea id="desc" name="desc" class="form-control"></textarea>
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