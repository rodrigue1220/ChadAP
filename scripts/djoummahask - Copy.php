<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>

<script type="text/javascript">
		<!--
		function verif_formulaire()
		{
			var hr = document.getElementById('heurr').value;
			var hd = document.getElementById('heurd').value;
			var mr = document.getElementById('minr').value;
			var md = document.getElementById('mind').value;
			
			if(hr < hd)  {
				alert("Veuillez choisir une bonne heure retour!");
				document.formulaire.heurr.focus();
				return false;
			}

			if(document.formulaire.oic.value == "Autorisé par...")  {
				alert("Veuillez choisir le Superviseur pour autorisation!");
				document.formulaire.oic.focus();
				return false;
			}
			
			if(hr == hd)  {
				if (mr < md)
				{
					alert("Veuillez revoir minute de retour!");
					document.formulaire.minr.focus();
					return false;
				}
			}
		}
//-->
</script>

		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<h1 class="page-header">
						<div align="right">
							<?php
								include('connexion.php');
								$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
								$nopers = $exis['ID'];
								$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state=''")->fetch_array();		
								if($nb['nb']!=0)
								{
									echo ("<button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='vadjoummahask.php'\" title=\"Confirmer Demande de Cong&eacute;s\"><i class=\"fa fa-check\" fa-fw></i> Confirmer Demande</button>");
								}
							?>
							<button type="button" class="btn btn-warning" onclick="document.location='djoummahatt.php'" title="Liste des Demandes de Cong&eacute;s"><i class="fa fa-list" fa-fw></i> Liste des Demandes</button>
						</div>
						Demande de Cong&eacute;s Annuel
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <form class="form-horizontal" name="formulaire" action="djoummahask2.php" method="post" onsubmit="return verif_formulaire()" >
					<div class="form-group">
						<label class="control-label col-sm-3" for="deb">Du :</label>
						<div class="col-sm-2">
							<input type="date" id="deb" name="deb" class="form-control" placeholder="mm/jj/aaaa" required />
						</div>
						<label class="control-label col-sm-1" for="ret">Au :</label>
						<div class="col-sm-2">
							<input type="date" id="ret" name="ret" class="form-control" placeholder="mm/jj/aaaa" required />
						</div>
					</div>
					<?php
						include('connexion.php');
						$exis	= $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
						$nopers	= $exis['ID'];
						$nb		= $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
						$dates	= $nb['DT'];
						$ldate 	= date("Y-m-d");
						$nombre = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
						$nbjour	= (strtotime($ldate)-strtotime($dates))/86400;
						if(($nbjour>=56) && ($nombre['nb']!=0))
						{
							echo("<div class=\"form-group\">
									<label class=\"control-label col-sm-3\">Inclure R&R :</label>");
								echo("<div class=\"col-sm-5\">
									<label class=\"radio-inline\"><input type=\"radio\" name=\"opt\" id=\"opt\" value=\"NON\">NON</label>
									<label class=\"radio-inline\"><input type=\"radio\" name=\"opt\" id=\"opt\" value=\"OUI\">OUI</label></div></div>");
						}				
					?>
					<div class="form-group">
						<label class="control-label col-sm-3" for="addr">Adresse (T&eacute;l&eacute;phone):</label>
						<div class="col-sm-5">
							<textarea id="addr" name="addr" class="form-control" placeholder="Veuillez Saisir l'adresse de Contact durant les congés..."></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="oic">Superviseur :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic" name="oic" required>
								<option></option>
								<option>SANOGO,Issa</option>
								<?php
									include('connexion.php');
									$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
									$requet = $mysqli->query( $sqle );
									$resulte = $requet->fetch_assoc();
									
									$unite	= $resulte['unite'];
									$nom	= $resulte['nom'];
									$prenom	= $resulte['prenom'];
									$sofo	= substr(stristr($unite, '/'), 1);
									
									if ($sofo != "CO NDJAMENA")
									{
										$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$sofo' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
										$requeteb = $mysqli->query( $sqlb ) ;

										while( $resultb = $requeteb->fetch_assoc() )
										{
											echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
										}										
									}
									$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
									}				
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="oic2">Chef d'unité (OIC) :</label>
						<div class="col-sm-5">
							<select class="form-control" id="oic2" name="oic2" required>
								<option>Approuvée par...</option>
								<option>SANOGO,Issa</option>
								<?php
									include('connexion.php');
									$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
									$requet = $mysqli->query( $sqle );
									$resulte = $requet->fetch_assoc();
									
									$unite	= $resulte['unite'];
									$nom	= $resulte['nom'];
									$prenom	= $resulte['prenom'];
									$sofo	= substr(stristr($unite, '/'), 1);
									
									if ($sofo != "CO NDJAMENA")
									{
										$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$sofo' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
										$requeteb = $mysqli->query( $sqlb ) ;

										while( $resultb = $requeteb->fetch_assoc() )
										{
											echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
										}										
									}
									$sqlb 	= "SELECT off_nom, off_pnom FROM wfp_chd_officer WHERE off_unit='$unite' AND off_nom !='$nom' AND off_pnom !='$prenom' ORDER BY off_nom" ;
									$requeteb = $mysqli->query( $sqlb ) ;

									while( $resultb = $requeteb->fetch_assoc() )
									{
										echo("<option> ".$resultb['off_nom'].",".$resultb['off_pnom']." </option>");
									}				
								?>
							</select>
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