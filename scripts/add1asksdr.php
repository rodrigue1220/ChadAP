<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');;
	include('connexion.php');

	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Demande de Salle de R&eacute;union</h1>
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-12">
        <form class="form-horizontal" name="formulaire" action="add2asksdr2.php" method="post" onsubmit="return verif_formulaire()" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="deb">Du :</label>
			<div class="col-sm-2">
			  <input type="date" id="deb" name="deb" class="form-control" required />
			</div>
			<label class="control-label col-sm-1" for="fin">Au :</label>
			<div class="col-sm-2">
			  <input type="date" id="fin" name="fin" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="heurd">De :</label>
			<div class="col-sm-1">
			  <select class="form-control" id="heurd" name="heurd" required>
				<option>HH</option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
			  </select>
			</div>
			<div class="col-sm-1">
			  <select class="form-control" id="mind" name="mind" required>
				<option>mn</option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>					
			<label class="control-label col-sm-1" for="heurf">A :</label>
			<div class="col-sm-1">
			  <select class="form-control" id="heurf" name="heurf" required>
				<option>HH</option>
				<option> 07 </option><option> 08 </option><option> 09 </option><option> 10 </option>
				<option> 11 </option><option> 12 </option><option> 13 </option><option> 14 </option>
				<option> 15 </option><option> 16 </option><option> 17 </option><option> 18 </option>
			  </select>
			</div>
			<div class="col-sm-1">
			  <select class="form-control" id="minf" name="minf" required>
				<option>mn</option>
				<option> 00 </option><option> 05 </option><option> 10 </option><option> 15 </option>
				<option> 20 </option><option> 25 </option><option> 30 </option><option> 35 </option>
				<option> 40 </option><option> 45 </option><option> 50 </option><option> 55 </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="motif">Raison :</label>
			<div class="col-sm-5">
			  <input type="text" id="motif" name="motif" placeholder="Renseigner le motif" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="actv">Activit&eacute; Concern&eacute;e :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="actv" name="actv" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT gesdr_lib1 FROM wfp_chd_gesdr WHERE gesdr_cat='ACTV' ORDER BY gesdr_lib1" ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['gesdr_lib1']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>    
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nbr">Nombre de Participant :</label>
			<div class="col-sm-5">
			  <input type="text" id="nbr" name="nbr" placeholder="Renseigner le nombre de participant" class="form-control" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sdr">Salle :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="sdr" name="sdr" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT gesdr_lib1 FROM wfp_chd_gesdr WHERE gesdr_cat='SDR' ORDER BY gesdr_lib1" ;
					$requeteb = $mysqli->query( $sqlb ) ;
					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['gesdr_lib1']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>	      
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3">Equipements Multim&eacute;dia :</label>
			<?php
				$sqlb 	= "SELECT gesdr_lib1 FROM wfp_chd_gesdr WHERE gesdr_cat='EQPMT' ORDER BY gesdr_lib1" ;
				$requeteb = $mysqli->query( $sqlb );
				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<label class=\"checkbox-inline control-label col-sm-2\">
						<input type=\"checkbox\"  name=\"eqpmt[]\" value=".$resultb['gesdr_lib1']." /> ".$resultb['gesdr_lib1']." </label>");
				}				
			?>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="otreq"></label>
			<div class="col-sm-5">
			  <input type="text" id="otreq" name="otreq" placeholder="Si Autre, à préciser..." class="form-control" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3">Pause-Caf&eacute; :</label>
			<?php
				$sqlb 	= "SELECT gesdr_lib1 FROM wfp_chd_gesdr WHERE gesdr_cat='PC' ORDER BY gesdr_lib1" ;
				$requeteb = $mysqli->query( $sqlb ) ;
				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<label class=\"checkbox-inline control-label col-sm-2\">
						<input type=\"checkbox\"  name=\"pc[]\" value=".$resultb['gesdr_lib1']." /> ".$resultb['gesdr_lib1']." </label>");
				}				
			?>
		  </div>
		
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="otrpc"></label>
			<div class="col-sm-5">
			  <input type="text" id="otrpc" name="otrpc" placeholder="Si Autre, à préciser..." class="form-control"  />
			</div>
		  </div>
		  
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-5">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
			  <button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
			</div>
		  </div>
		</form>
      </div> 
      <!-- /.row -->
 </div>
 
 <!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
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