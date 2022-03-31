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
							<button type="button" class="btn btn-success" onclick="document.location='addcontcongp.php'" title="Créer profil employé"><i class="fa fa-user" fa-fw></i> Profils</button>
							<button type="button" class="btn btn-warning" onclick="document.location='addcontcongjf.php'" title="Enregistrer jour férié"><i class="fa fa-calendar" fa-fw></i> Jours F&eacute;ri&eacute;s</button>
						</div><br />
                    D&eacute;finir nombre de jour par Type de Cong&eacute;s / Contrat </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="add2congj.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="cont">Contrat :</label>
						<div class="col-sm-5">
							<select class="form-control" id="cont" name="cont" required />
								<option>FT</option>
								<option>SC</option>
								<option>SSA</option>

							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="cong">Cong&eacute;s :</label>
						<div class="col-sm-5">
							<select class="form-control" id="cong" name="cong" required>
								<?php
									include('connexion.php');
									$sqle	= "SELECT * FROM wfp_chd_contcong WHERE contcong_type='CONG' ";
									$requet = $mysqli->query( $sqle );
									
									while( $resultb = $requet->fetch_assoc() )
									{
										echo("<option> ".$resultb['contcong_nom']." </option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jour">Jour :</label>
						<div class="col-sm-2">
							<input type="text" id="jour" name="jour" placeholder="Nombre de jour" class="form-control"/>
						</div>
						<label class="control-label col-sm-1" for="mois">Mois :</label>
						<div class="col-sm-2">
							<input type="text" id="mois" name="mois" placeholder="Par mois..." class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Journ&eacute;e :</label>
						<div class="col-sm-1">
						<label class="radio-inline">
							<input type="radio" name="opt" value="ouv">Ouvr&eacute;e
						</label></div>
						<div class="col-sm1-1">
						<label class="radio-inline">
							<input type="radio" name="opt" value="cal">Calendaire
						</label></div>
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