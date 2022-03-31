<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	
	/*if ($pseudo != "administrateur")
	{
		header('Location:simple.php');
	}*/
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nouveau Site d'intervention</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="add2officeope.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="nom">Nom :</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="nom" name="nom" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="lieu">Lieu  :</label>
						<div class="col-sm-5">
							<select class="form-control" id="lieu" name="lieu" required>
								<option>Choisir..</option>
								<option> ABECHE </option><option> AMDJARASS </option><option> ATI </option><option> BAGA-SOLA </option><option> BOL </option>
								<option> FARCHANA </option><option> GORE </option><option> GOZ-BEIDA </option><option> GUEREDA </option><option> IRIBA </option>
								<option> MAO </option><option> MONGO </option><option> MOUSSORO </option><option> NDJAMENA </option>
							</select>
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