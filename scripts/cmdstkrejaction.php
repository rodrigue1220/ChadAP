<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("connexion.php");

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminSTOCK" && $profil != "AdminFOURN")
	{
		header('Location:simple.php');
	}
	
	$cle	= $_GET["id"];
	$ref	= $_GET["refer"];
	$choix	= $_GET["cx"];
	
	$sql	= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_id='$cle' " ;
	$req 	= $mysqli->query( $sql ) ;
	$res	= $req->fetch_assoc();

	$code	= $res["rqeqv_item"];
	$init	= $res["rqeqv_dem"];
	
	$art	= $mysqli->query("SELECT catart_nom AS NOM FROM wfp_chd_catart WHERE catart_code='$code'")->fetch_array();
	$item	= $art["NOM"];
	
	if($item =="")
	{
		$item = $code;
	}
	
	$article= $item." ".$code;
	
	$sqld 	= "SELECT * FROM user WHERE pseudo='$init' " ;
	$reqd 	= $mysqli->query( $sqld );
	$resd	= $reqd->fetch_assoc();
	$nome	= $resd["nom"];
	$pnom	= $resd["prenom"];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <?php
		if ($choix =="ADJ")
		{
			echo ("<h1 class=\"h3 mb-0 text-gray-800\"><i class=\"fas fa-balance-scale fa-sm\"></i> Ajuster la quantit&eacute; de la Demande | Gest. Stock TEC</h1>");
		}
		elseif ($choix =="REJ")
		{
			echo ("<h1 class=\"h3 mb-0 text-gray-800\"><i class=\"fas fa-close fa-sm\"></i> Rejet Demande | Gest. Stock TEC</h1>");
		}
		echo("<a href=\"listdeqpmtdet.php?id=".$ref."\" class=\"d-none d-sm-inline-block btn btn-sm btn-info shadow-sm\"><i class=\"fa fa-reply fa-sm text-black-75\"></i> Retour Demande</a>"); 
	  ?>
	</div>
	<hr />   
    
	<!--row -->
    <div class="row">
	 <div class="col-lg-8">
      <form name="formulaire" action="cmdstkrejaction2.php" method="post">
		<input type="hidden" name="keys" id="keys" value="<?php echo $cle; ?>" />
		<input type="hidden" name="cx" id="cx" value="<?php echo $choix; ?>" />
		<input type="hidden" name="ref" id="ref" value="<?php echo $res["rqeqv_ref"]; ?>" />
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="nom">Demandeur :</label>
		  <div class="col-sm-8">
			<input type="text" id="nom" name="nom" value="<?php echo $nome." ".$pnom; ?>" class="form-control" disabled="disabled" required />
		  </div>
		</div>
		
		<div class="form-group row">
        	<label class="control-label col-sm-4" for="nif">Item Description :</label>
			<div class="col-sm-8">
			  <?php
				if ($choix =="ADJ")
				{
					echo("<select class=\"form-control\" id=\"item\" name=\"item\" required>");
					
					if ($profil=="AdminSTOCK")
					{
						$sqlb 	= "SELECT * FROM wfp_chd_catart WHERE catart_lib!='FOURN' ORDER BY catart_nom" ;
					}
					{
						$sqlb 	= "SELECT * FROM wfp_chd_catart WHERE catart_lib='FOURN' ORDER BY catart_nom" ;
					}
					$requeteb = $mysqli->query( $sqlb ) ;
					echo("<option> ".$item.">".$code." </option>");
					while( $resultb = $requeteb->fetch_assoc() )
					{
						echo("<option> ".$resultb['catart_nom'].">".$resultb['catart_code']."</option>");
					}
					
					echo("</select>");
				}
				elseif ($choix =="REJ")
				{
					echo ("<input type=\"text\" id=\"item\" name=\"item\" value=".$article." class=\"form-control\" disabled=\"disabled\" required />");
				}
			  ?>
			
			</div>
		</div>
		
		<div class="form-group row">
			<label class="control-label col-sm-4" for="nbr">Quantit&eacute; :</label>
			<div class="col-sm-8">
			<?php
				if ($choix =="ADJ")
				{
					echo("<input type=\"text\" id=\"nbr\" name=\"nbr\" value=".$res["rqeqv_nbr"]." class=\"form-control\" required />");
				}
				elseif ($choix =="REJ")
				{
					echo("<input type=\"text\" id=\"nbr\" name=\"nbr\" value=".$res["rqeqv_nbr"]." class=\"form-control\" disabled=\"disabled\" required />");
				}
			?>
			</div>
		</div>
		
		<div class="form-group row">
			<label class="control-label col-sm-4" for="comm">Commentaire :</label>
			<div class="col-sm-8">
				<textarea id="comm" name="comm" class="form-control" required> </textarea>
			</div>
		</div>
		
		<div class="form-group row">
		  <div class="col-sm-offset-2 col-sm-12">
			<?php
				if ($choix =="ADJ")
				{
					echo ("<button type=\"submit\" class=\"btn btn3 btn-success\"><i class=\"fa fa-balance-scale fa-fw\"></i> Ajuster</button>");
				}
				elseif ($choix =="REJ")
				{
					echo ("<button type=\"submit\" class=\"btn btn3 btn-danger\"><i class=\"fas fa-close fa-fw\"></i> Rejeter</button>");
				}
			?>
		  </div>
		</div>
	  </form>
	 </div>
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
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>