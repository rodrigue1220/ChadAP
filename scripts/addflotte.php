<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminFLEET")
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
                    <h1 class="page-header">Flotte</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="add2flotte.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="marq">Marque :</label>
						<div class="col-sm-5">
							<input type="text" id="marq" name="marq" placeholder="Entrer la Marque, Modele" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="immat">Immatriculation  :</label>
						<div class="col-sm-5">
							<input type="text" id="immat" name="immat" placeholder="Entrer le numero plaque" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="det">D&eacute;tails :</label>
						<div class="col-sm-5">
							<textarea id="det" name="det" class="form-control"></textarea>
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