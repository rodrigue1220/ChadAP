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
                <div class="col-lg-12">
                    <h1 class="page-header">Modification Infos Utilisateur</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php

				include('connexion.php');
				$id = $_GET["ide"];

				$sql = "SELECT * FROM user WHERE id='$id'" ;
				$requete = $mysqli->query( $sql ) ;
				$result = $requete->fetch_assoc();
			 ?>
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="dirmod2.php" method="post">
					<?php echo("<input type=\"hidden\" id=\"cle\" name=\"cle\" value=".$_GET["ide"]." />"); ?>
					<div class="form-group">
						<label class="control-label col-sm-3" for="nom">Nom :</label>
						<div class="col-sm-5">
							<input type="text" id="nom" name="nom" class="form-control" value="<?php echo $result['nom']; ?>" disabled />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="pnom">Pr&eacute;nom :</label>
						<div class="col-sm-5">
							<input type="text" id="pnom" name="pnom" class="form-control" value="<?php echo $result['prenom']; ?>" disabled />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="mail">Email :</label>
						<div class="col-sm-5">
							<input type="text" id="mail" name="mail" class="form-control" value="<?php echo $result['email']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="tel">T&eacute;l&eacute;phone 1 :</label>
						<div class="col-sm-5">
							<input type="text" id="tel" name="tel" class="form-control" value="<?php echo $result['tel']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="tel2">T&eacute;l&eacute;phone 2 :</label>
						<div class="col-sm-5">
							<input type="text" id="tel2" name="tel2" class="form-control" value="<?php echo $result['tel2']; ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="ext">Extension :</label>
						<div class="col-sm-5">
							<input type="text" id="ext" name="ext" class="form-control" value="<?php echo $result['ext']; ?>" required />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<input type="submit" class="btn btn-default" value="Modifier">
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