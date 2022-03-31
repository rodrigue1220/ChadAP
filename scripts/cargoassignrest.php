<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}
	
	$id		= $_GET["ide"] ;
	$page	= $_GET["page"] ;

	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
	
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Assigner un Camion / Chauffeur</h1>
		<a href="gestcharge.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm"><i class="fas fa-cogs fa-sm text-black-75"></i> Gest. Cargaisons</a>
		<a href="gestdmd.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des Demandes</a>	
	</div>
	<hr /> 
	
	<?php
		$sql 	 = "SELECT * FROM wfp_chd_cargodem WHERE cargodem_id='$id'" ;
		$requete = $mysqli->query( $sql ) ;
		$result  = $requete->fetch_assoc();
	?>
		
	<!--row -->
	<div class="row">
      <div class="col-lg-12">
        <form class="form-horizontal" name="formulaire" action="cargoassign2.php" method="post">
		  <?php 
			echo("<input type=\"hidden\" id=\"id\" name=\"id\" value=".$id." />"); 
			echo("<input type=\"hidden\" id=\"page\" name=\"page\" value=".$page." />");
		  ?>
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="dmde">N&deg; Demande :</label>
			<div class="col-sm-4">
			  <input type="text" id="dmde" name="dmde" class="form-control" value="<?php echo $result['cargodem_number']; ?>" disabled="disabled" />
			</div>

			<label class="control-label col-sm-2" for="dmd">Demandeur :</label>
			<div class="col-sm-4">
			  <input type="text" id="dmd" name="dmd" class="form-control" value="<?php echo $result['cargodem_dem']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="orig">Origine :</label>
			<div class="col-sm-4">
			  <input type="text" id="orig" name="orig" class="form-control" value="<?php echo $result['cargodem_depart']; ?>" disabled="disabled" />
			</div>

			<label class="control-label col-sm-2" for="desti">Destination :</label>
			<div class="col-sm-4">
			  <input type="text" id="desti" name="desti" class="form-control" value="<?php echo $result['cargodem_desti']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="natcar">Nature Cargaison :</label>
			<div class="col-sm-4">
			  <input type="text" id="orig" name="orig" class="form-control" value="<?php echo $result['cargodem_nat']; ?>" disabled="disabled" />
			</div>
			
			<label class="control-label col-sm-2" for="proj">Projet :</label>
			<div class="col-sm-4">
			  <input type="text" id="proj" name="proj" class="form-control" value="<?php echo $result['cargodem_proj']; ?>" disabled="disabled" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="tonne">Tonnage :</label>
			<div class="col-sm-4">
			  <input type="text" id="orig" name="orig" class="form-control" value="<?php echo $result['cargodem_tonne']; ?>" disabled="disabled" />			
			</div>

			<label class="control-label col-sm-2" for="vol">Volume :</label>
			<div class="col-sm-4">
			  <input type="text" id="vol" name="vol" class="form-control" value="<?php echo $result['cargodem_vol']; ?>" disabled="disabled" />			
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="tonne">Tonnage Assign&eacute; :</label>
			<div class="col-sm-4">
			  <input type="text" id="orig" name="orig" class="form-control" value="<?php echo $result['cargodem_tonnecharge']; ?>" disabled="disabled" />			
			</div>

			<label class="control-label col-sm-2" for="vol">Volume Assign&eacute;:</label>
			<div class="col-sm-4">
			  <input type="text" id="vol" name="vol" class="form-control" value="<?php echo $result['cargodem_volcharge']; ?>" disabled="disabled" />			
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="vehi">V&eacute;hicule :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="vehi" name="vehi" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_cam ORDER BY cam_plaq " ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option>".$resultb['cam_plaq']."</option>");
					}				
				?>
			  </select>
			</div>

			<label class="control-label col-sm-2" for="driver">Driver :</label>
			<div class="col-sm-4">
			  <select class="form-control" id="driver" name="driver" required>
				<option></option>
				<?php
					$sqlb 	= "SELECT * FROM wfp_chd_chauffeur ORDER BY chauf_nom " ;
					$requeteb = $mysqli->query( $sqlb ) ;

					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['chauf_nom'].",".$resultb['chauf_pnom']."</option>");
					}				
				?>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-2" for="tonnch">Tonnage :</label>
			<div class="col-sm-4">
			  <input type="number" id="tonnch" name="tonnch" class="form-control" placeholder="Tonnage &agrave; charger" />			
			</div>

			<label class="control-label col-sm-2" for="volch">Volume :</label>
			<div class="col-sm-4">
			  <input type="number" id="volch" name="volch" class="form-control" placeholder="Volume &agrave; charger"/>			
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-info"><i class="fa fa-edit fa-fw"></i> Assigner</button>
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
  <script type="text/javascript" src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>