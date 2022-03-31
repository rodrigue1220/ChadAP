<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	include("inc/taarikh.php");
	include('inc/headers.php');
?>
<style type="text/css"> .btn3{ width:160px; } </style>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar-plus-o"></i> Demande HS</h1>
		<?php				
			$sql 	= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
			$requete= $mysqli->query( $sql );
			$result = $requete->fetch_assoc();
			$nom 	= $result["nom"];
			$prenom = $result["prenom"];
								
			$exist = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' AND cto_statut='APPROUVE' ")->fetch_array();
			if($exist['ID'] != 0)
			{	
				echo("<a href=\"va2compenscto.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm\"><i class=\"fa fa-calendar-check-o\" fa-fw></i> Submit HS</a>");
			}
			$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='ATTENTE' ")->fetch_array();
			if($approver['ID'] != 0)
			{	
				echo("<a href=\"vacompenscto.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm\"><i class=\"fa fa-check\" fa-fw></i> Approuver HS</a>");
			}
			$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom' AND cto_statut='EFFECTUE' ")->fetch_array();
			if($approver['ID'] != 0)
			{	
				echo("<a href=\"vacompenscto2.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-danger shadow-sm\"><i class=\"fa fa-legal\" fa-fw></i> Certifier HS</a>");
			}
								
			$approver = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_approver='$nom,$prenom'")->fetch_array();
			if($approver['ID'] != 0)
			{	
				echo ("<a href=\"compensctotout.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm\"><i class=\"fa fa-list-alt\" fa-fw></i> Aper&ccedil;u HS</a>");
			}
		?>
		<a href="compensatt.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-list fa-sm text-white-75"></i> Mes Demandes HS</a>				
        <!--a href="compensfich.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-tasks fa-sm text-white-75"></i> Fiche Mensuelle</a-->
    </div>
	<hr />
    <!-- Content Row -->
    <div class="row">
      <div class="col-lg-12">
        <form name="formulaire" action="hsuppask2.php" method="post" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="deb">Date :</label>
			<div class="col-sm-4">
			  <input type="date" id="deb" name="deb" class="form-control" placeholder="mm/jj/aaaa" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="heurd">D&eacute;but Estim&eacute; :</label>
			<div class="col-sm-2">
			  <select class="form-control" id="heurd" name="heurd" required>
				<option>HH</option><option> 00 </option><option> 01 </option><option> 02 </option>
				<option> 03 </option><option> 04 </option><option> 05 </option><option> 06 </option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
				<option> 19 </option><option> 20 </option><option> 21 </option><option> 22 </option><option> 23 </option>
			  </select>
			</div>			
			<div class="col-sm-2">
			  <select class="form-control" id="mind" name="mind" required>
				<option>mn</option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>	
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="heurr">Fin Estim&eacute;e :</label>
			<div class="col-sm-2">
			  <select class="form-control" id="heurr" name="heurr" required>
				<option>HH</option><option> 00 </option><option> 01 </option><option> 02 </option>
				<option> 03 </option><option> 04 </option><option> 05 </option><option> 06 </option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
				<option> 19 </option><option> 20 </option><option> 21 </option><option> 22 </option><option> 23 </option>
			  </select>
			</div>
			<div class="col-sm-2">
			  <select class="form-control" id="minr" name="minr" required>
				<option>mn</option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="lib">T&acirc;ches &agrave; effectuer :</label>
			<div class="col-sm-4">
			  <textarea id="lib" name="lib" class="form-control" placeholder="renseigner les tâches à effectuer..."> </textarea>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3">Type de Compensation :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="opt" name="opt" required>
				<option></option>
				<option> CASH </option><option> CTO </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="oic">Demandeur de Service / OIC :</label>
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
					
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
			  <button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
			</div>
		  </div>
		</form>
      </div>
      <!-- /.col-lg -->
            
	</div>
    <!-- /.row -->
            
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