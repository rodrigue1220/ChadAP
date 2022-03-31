<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	header('Location:djoummahdmd.php');
	$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
	$nopers = $exis['ID'];
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
<br /><br /><br />
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
				<!--div align="right">
					<?php
						/*
						$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_state=''")->fetch_array();		
						if($nb['nb']!=0)
						{
							echo ("<button type=\"button\" class=\"btn btn-success\" onclick=\"document.location='vadjoummahask.php'\" title=\"Confirmer Demande de Cong&eacute;s\"><i class=\"fa fa-check\" fa-fw></i> Confirmer Demande</button>");
						}*/
					?>
					<button type="button" class="btn btn-warning" onclick="document.location='djoummahatt.php'" title="Liste des Demandes de Cong&eacute;s"><i class="fa fa-list" fa-fw></i> Liste des Demandes</button>
				</div-->
				Demande de Cong&eacute;s 
			</h1>
			<b>PL</b>: Cong&eacute; de Paternit&eacute;, <b>ML</b>: Cong&eacute; de Maternit&eacute;, 
			<b>R&R </b>: Cong&eacute; de Recuperation, <b>CTO</b>: Cong&eacute; de Compensation
		</div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row --><br /><br />
    <div class="row">
        <form class="form-horizontal" name="formulaire" action="djoummahaskft2.php" method="post" onsubmit="return verif_formulaire()" >
			<input type="hidden" id="nopers" name="nopers" value="<?php echo $nopers; ?>" />
		<div class="form-group">
			<label class="control-label col-sm-3" for="addr">Type de Cong&eacute;s:</label>
			<div class="col-sm-2">
				<select class="form-control" id="ltyp" name="ltyp" required>
					<option></option>
					<?php			
						$sqlb 		= "SELECT leave_type FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_statu='' ORDER BY leave_type" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;
						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['leave_type']." </option>");
						}				
					?>
				</select>
			</div>
			<div class="col-sm-2">
				<input type="date" id="deb" name="deb" class="form-control" placeholder="Du" required />
			</div>
			<div class="col-sm-2">
				<input type="date" id="ret" name="ret" class="form-control" placeholder="Au" required />
			</div>
		</div>
		<!--div class="form-group">
			<label class="control-label col-sm-3" for="addr"></label>
			<div class="col-sm-2">
				<select class="form-control" id="ltyp2" name="ltyp2">
					<option></option>
					<php							
						$sqlb 		= "SELECT leave_type FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_statu='' ORDER BY leave_type" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;
						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['leave_type']." </option>");
						}				
					?>
				</select>
			</div>
			<div class="col-sm-2">
				<input type="date" id="deb2" name="deb2" class="form-control" />
			</div>
			<div class="col-sm-2">
				<input type="date" id="ret2" name="ret2" class="form-control" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="addr"></label>
			<div class="col-sm-2">
				<select class="form-control" id="ltyp3" name="ltyp3">
					<option></option>
					<php		
						$sqlb 		= "SELECT leave_type FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_statu='' ORDER BY leave_type" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;
						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['leave_type']." </option>");
						}				
					?>
				</select>
			</div>
			<div class="col-sm-2">
				<input type="date" id="deb3" name="deb3" class="form-control"/>
			</div>
			<div class="col-sm-2">
				<input type="date" id="ret3" name="ret3" class="form-control"/>
			</div>
		</div-->
		<div class="form-group">
			<label class="control-label col-sm-3" for="addr">Adresse (T&eacute;l&eacute;phone):</label>
			<div class="col-sm-6">
				<input type="text" id="addr" name="addr" class="form-control" placeholder="Veuillez Saisir l'adresse de Contact durant les congés..." required />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="oic">Superviseur :</label>
			<div class="col-sm-4">
				<select class="form-control" id="oic" name="oic" required>
					<option></option>
					<?php
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
			<label class="control-label col-sm-3" for="oic2">OIC / HoSO :</label>
			<div class="col-sm-4">
				<select class="form-control" id="oic2" name="oic2" required>
					<option></option>
					<?php
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
			<label class="control-label col-sm-3">Aviez-vous initi&eacute; une demande sur Self Service?:</label>
			<div class="col-sm-5">
				<label class="radio-inline"><input type="radio" name="opt" id="opt" value="NON">NON</label>
				<label class="radio-inline"><input type="radio" name="opt" id="opt" value="OUI">OUI</label>
			</div>
		</div>
						
		<div class="form-group">
			<label class="control-label col-sm-3" for="drep">Date de Reprise:</label>
			<div class="col-sm-2">
				<input type="date" id="drep" name="drep" class="form-control" required />
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
</div>
<!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>