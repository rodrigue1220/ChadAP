<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminSTOCK" AND $profil != "AdminFOURN")
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
			<style type="text/css"> .btn2{ width:160px; } </style>
                <div class="col-lg-12">
					<h1 class="page-header">
						<div align="right">
							<button type="button" class="btn btn2 btn-danger" onclick="document.location='catadd.php'" title="NOUVELLE CATEGORIE"><i class="fa fa-plus" fa-fw></i> Nouvelle Cat&eacute;gorie</button>
							<button type="button" class="btn btn2 btn-primary" onclick="document.location='stockadd.php'" title="ENTREE STOCK"><i class="fa fa-sign-in" fa-fw></i> Entr&eacute;es</button>
							<button type="button" class="btn btn2 btn-info" onclick="document.location='stocksort.php'" title="SORTIE STOCK"><i class="fa fa-sign-out" fa-fw></i> Sorties</button>
							<button type="button" class="btn btn2 btn-success" onclick="document.location='listdeqpmt.php'" title="Liste des demandes équipements"><i class="fa fa-pencil-square" fa-fw></i> Demandes</button>
						</div><br />
						Cr&eacute;er un Nouvel Article
                    </h1><br />
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="articadd2.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="item">Item Description :</label>
						<div class="col-sm-5">
							<input type="text" id="item" name="item" class="form-control" placeholder="Saisir le nom de l'article " required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="cat">Cat&eacute;gorie :</label>
						<div class="col-sm-5">
							<select class="form-control" id="cat" name="cat" required>
								<?php
									include('connexion.php');

									$sqlb 	= "SELECT catart_nom FROM wfp_chd_catart WHERE catart_type='CAT' ORDER BY catart_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['catart_nom']." </option>");
									}				
								?>
							</select>
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