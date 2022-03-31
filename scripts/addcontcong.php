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
						<div align="right"><style type="text/css"> .btn{ width:200px; } </style>
							<button type="button" class="btn btn-info" onclick="document.location='addcontcongj.php'" title="Méthode de cumul"><i class="fa fa-calculator" fa-fw></i> Jours/Cong&eacute;s/Contrat</button>
							<button type="button" class="btn btn-success" onclick="document.location='addcontcongp.php'" title="Créer profil employé"><i class="fa fa-user" fa-fw></i> Profils</button>
							<button type="button" class="btn btn-warning" onclick="document.location='addcontcongjf.php'" title="Enregistrer jour férié"><i class="fa fa-calendar" fa-fw></i> Jours F&eacute;ri&eacute;s</button>
						</div><br />
					Ajouter Type de Cong&eacute;s </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="add2cong.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="lib">Libell&eacute; :</label>
						<div class="col-sm-5">
							<input type="text" id="lib" name="lib" placeholder="Renseigner le libellé..." class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="ft">FT :</label>
						<div class="col-sm-1">
							<select class="form-control" id="ft" name="ft" required>
								<option>O</option>
								<option>N</option>
							</select>
						</div>

						<label class="control-label col-sm-1" for="sc">SC :</label>
						<div class="col-sm-1">
							<select class="form-control" id="sc" name="sc" required>
								<option>O</option>
								<option>N</option>
							</select>
						</div>

						<label class="control-label col-sm-1" for="ssa">SSA :</label>
						<div class="col-sm-1">
							<select class="form-control" id="ssa" name="ssa" required>
								<option>O</option>
								<option>N</option>
							</select>
						</div>
					</div>

					<!--div class="form-group">
						<label class="control-label col-sm-3" for="jour">Jour :</label>
						<div class="col-sm-2">
							<input type="text" id="jour" name="jour" placeholder="Nombre de jour" class="form-control"/>
						</div>
						<label class="control-label col-sm-1" for="mois">Mois :</label>
						<div class="col-sm-2">
							<input type="text" id="mois" name="mois" placeholder="Par mois..." class="form-control"/>
						</div>
					</div-->
					<div class="form-group">
						<label class="control-label col-sm-3" for="desc">Description  :</label>
						<div class="col-sm-5">
							<textarea id="desc" name="desc" placeholder="Saisir une description..." class="form-control"></textarea>
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