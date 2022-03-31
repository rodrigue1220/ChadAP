<?php
/**
* @author Zaki IZZO <izzo.z@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');;
	include('connexion.php');

	$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$pseudo' ")->fetch_array();
	$nopers = $exis['ID'];
	/* if ($pseudo !="zimbos")
	{
		header('Location:simple.php');
	}
	 */
	$existe = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND (lv_state LIKE 'APPROUVE%' OR lv_state='ATTENTE' OR lv_state='ATTENTERH') ")->fetch_array();
	$ident	= $existe['ID'];
	if ($ident!="")
	{
		header('Location:djoummah.php');
	}
	
	include("inc/taarikh.php");
	include('inc/headers.php');
?>
	<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Demande de Cong&eacute;s</h1>
	</div>
	
		<b>PL</b>: Cong&eacute; de Paternit&eacute;, <b>ML</b>: Cong&eacute; de Maternit&eacute;, 
			<b>R&R </b>: Cong&eacute; de Recuperation, <b>CTO</b>: Cong&eacute; de Compensation
<br /><hr />   
   <!-- Content Row -->
    <div class="row">		 
      <div class="col-lg-10">
		
		<form name="formulaire" action="djoummahdmd2.php" method="post" onsubmit="return verif_formulaire()" >
		<div class="form-group row">
			<label class="control-label col-sm-4" for="ltyp">Type de Cong&eacute;s:</label>
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
			<div class="col-lg-3">
				<input type="date" id="deb" name="deb" class="form-control" placeholder="Du" required />
			</div>
			<div class="col-sm-3">
				<input type="date" id="ret" name="ret" class="form-control" placeholder="Au" required />
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-4" for="ltyp2"></label>
			<div class="col-sm-2">
				<select class="form-control" id="ltyp2" name="ltyp2">
					<option></option>
					<?php							
						$sqlb 		= "SELECT leave_type FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type!='R&R' AND leave_statu='' ORDER BY leave_type" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;
						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['leave_type']." </option>");
						}				
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<input type="date" id="deb2" name="deb2" class="form-control" />
			</div>
			<div class="col-sm-3">
				<input type="date" id="ret2" name="ret2" class="form-control" />
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-4" for="ltyp3"></label>
			<div class="col-sm-2">
				<select class="form-control" id="ltyp3" name="ltyp3">
					<option></option>
					<?php		
						$sqlb 		= "SELECT leave_type FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type!='R&R' AND leave_statu='' ORDER BY leave_type" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;
						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['leave_type']." </option>");
						}				
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<input type="date" id="deb3" name="deb3" class="form-control"/>
			</div>
			<div class="col-sm-3">
				<input type="date" id="ret3" name="ret3" class="form-control"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-4" for="ltyp4"></label>
			<div class="col-sm-2">
				<select class="form-control" id="ltyp4" name="ltyp4">
					<option></option>
					<?php		
						$sqlb 		= "SELECT leave_type FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type!='R&R' AND leave_statu='' ORDER BY leave_type" ;
						$requeteb 	= $mysqli->query( $sqlb ) ;
						while( $resultb = $requeteb->fetch_assoc() )
						{
							echo("<option> ".$resultb['leave_type']." </option>");
						}				
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<input type="date" id="deb4" name="deb4" class="form-control"/>
			</div>
			<div class="col-sm-3">
				<input type="date" id="ret4" name="ret4" class="form-control"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-4" for="addr">Adresse (T&eacute;l&eacute;phone):</label>
			<div class="col-sm-6">
				<input type="text" id="addr" name="addr" class="form-control" placeholder="Veuillez Saisir l'adresse de Contact durant les congés..." required />
			</div>
		</div>
		<div class="form-group row">
			<label class="control-label col-sm-4" for="oic">Superviseur :</label>
			<div class="col-sm-6">
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
		<div class="form-group row">
			<label class="control-label col-sm-4" for="oic2">OIC / Chef de Bureau :</label>
			<div class="col-sm-6">
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
		<?php
			/*$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$nopers'")->fetch_array();
			$contrat= $cpt["CONT"];
	
			if ($contrat != "SC" && $contrat != "SS" && $nopers!="0")
			{*/
				echo("<div class=\"form-group row\">
					<label class=\"control-label col-sm-4\">Self Service?</label>
					<div class=\"col-sm-8\">
						<label class=\"radio-inline\"><input type=\"radio\" name=\"opt\" id=\"opt\" value=\"NON\" checked=\"checked\"> NON</label>
						<label class=\"radio-inline\"><input type=\"radio\" name=\"opt\" id=\"opt\" value=\"OUI\"> OUI</label>
					</div>
				</div>");
						
				echo("<div class=\"form-group row\">
					<label class=\"control-label col-sm-4\" for=\"drep\">Date de Reprise:</label>
					<div class=\"col-sm-6\">
						<input type=\"date\" id=\"drep\" name=\"drep\" class=\"form-control\" />
					</div>
				</div>");
			//}
		?>
		<div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
				<button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
				<button type="reset" class="btn btn3 btn-danger"><i class="fa fa-remove fa-fw"></i> Effacer</button>
			</div>
		</div>
		</form>
	  </div>
	</div>
    <!-- Content Row -->
	
	
			</div>
        <!-- /.container-fluid -->	
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="http://10.109.87.10:8080/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://10.109.87.10:8080/js/demo/chart-area-demo.js"></script>
  <script src="http://10.109.87.10:8080/js/demo/chart-pie-demo.js"></script>

</body>

</html>