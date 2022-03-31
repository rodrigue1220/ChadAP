<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');;
	include('connexion.php');
	
	if ($_GET["cle"] == "FOURN")
	{
		header('Location:askfour.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script language="javascript"> 
	$(document).ready(function () {
    var theHREF;

    $(".confirmModalLink").click(function(e) {
        e.preventDefault();
        theHREF = $(this).attr("href");
        $("#confirmModal").modal("show");
    });

    $("#confirmModalNo").click(function(e) {
        $("#confirmModal").modal("hide");
    });

    $("#confirmModalYes").click(function(e) {
        window.location.href = theHREF;
    });
});
</script>
<style type="text/css"> .btn3{ width:180px; text-color: #ffffff;} </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" /> 
<style type="text/css"> .btn3{ width:160px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Nouvelle Demande | <?php echo("<font color=\"blue\">".$_GET["cle"]."</font>"); ?></h1>
	  <a href="askeqpmform.php?cle=IT" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-edit fa-sm text-black-75"></i> IT EQUIPMENT</a>				
      <a href="askeqpmform.php?cle=TC" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-75"></i> TC EQUIPMENT</a>				
      <a href="askeqpmform.php?cle=ELEC" class="d-none d-sm-inline-block btn btn3 btn-sm btn-danger shadow-sm"><i class="fas fa-edit fa-sm text-white-75"></i> ELECTRICAL</a>				
      <a href="askeqpmform.php?cle=CONSO" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-sm text-white-75"></i> CONSOMMABLES</a>				     
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
     <div class="col-lg-6">
      <form name="formulaire" action="askeqpmt2.php" method="post" onsubmit="return verif_formulaire()" >
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="item">Item Description :</label>
		  <div class="col-sm-8">
			<select class="form-control" id="item" name="item" required>
			  <option></option>
			  
			  <?php
				$cle	= $_GET["cle"];
				$sqlb 	= "SELECT * FROM wfp_chd_catart WHERE catart_lib='$cle' ORDER BY catart_nom" ;
				$requeteb = $mysqli->query( $sqlb ) ;

				while( $resultb = $requeteb->fetch_assoc() )
				{
					echo("<option> ".$resultb['catart_nom'].">".$resultb['catart_code']." </option>");
				}				
			  ?>
			</select>
		  </div>
		</div>
		<!--div class="form-group row">
		  <label class="control-label col-sm-4" for="otr">Autre  :</label>
		  <div class="col-sm-8">
			<input type="text" id="otr" name="otr" placeholder="Spécifier Si Autre..." class="form-control" />
		  </div>
		</div-->
		<div class="form-group row">
		  <label class="control-label col-sm-4" for="nbr">Quantit&eacute; :</label>
		  <div class="col-sm-8">
			<input type="text" id="nbr" name="nbr" class="form-control" required />
		  </div>
		</div>	      
					
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-12">
			<button type="submit" class="btn btn3 btn-success"><i class="fa fa-download fa-fw"></i> Enregistrer</button>
			<button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
		  </div>
		</div>
	  </form>
    </div>
    <!-- /.row -->
  
	<?php 

		$exist = $mysqli->query("SELECT COUNT(rqeqv_id) AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_dem='$pseudo' AND rqeqv_state='STDBY' AND rqeqv_type!='FOURN' ")->fetch_array();						
		if($exist['ID'] != 0)
		{
			echo("<hr /><div class=\"col-lg-auto\">");
			echo("<div class=\"card shadow mb-4\">
					<a href=\"#collapseReqEqSTDBY\" class=\"d-block card-header py-3\" data-toggle=\"collapse\" role=\"button\" aria-expanded=\"true\" aria-controls=\"collapseReqEqSTDBY\">
		    		  <h6 class=\"m-0 font-weight-bold text-primary\">Vous avez de (s) Demande (s) en attente de soumission</h6>
					</a>
					<div class=\"collapse no-show\" id=\"collapseReqEqSTDBY\">
						<div class=\"card-body\">");
			$sql3 = "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_dem='$pseudo' AND rqeqv_state='STDBY' AND rqeqv_type!='FOURN' " ;
			$requete3 = $mysqli->query( $sql3 ) ;
			echo("<table class=\"table\">
				<thead>
  				  <tr>
					<th>#</th>
					<th>Item Description</th>
					<th>Nombre</th>
					<th>Cat.</th>
					<th></th>
				  </tr>
				</thead>");		
					
			while( $result3 = $requete3->fetch_assoc()  )
			{
				$code 	= $result3['rqeqv_item'];
				$sql4 	= "SELECT * FROM wfp_chd_catart WHERE catart_code='$code' " ;
				$req4 	= $mysqli->query( $sql4 ) ;
				$res4 	= $req4->fetch_assoc(); 
				$nom	= $res4["catart_nom"];
				$type	= $res4["catart_lib"];
				
				echo("<tbody><tr><td>".$result3['rqeqv_id']."</td>");
				if($nom =="")
				{
					echo("<td>".$result3['rqeqv_item']."</td>");
					echo("<td>".$result3['rqeqv_nbr']."</td>");
					echo("<td>AUTRE</td>");
				}
				else
				{
					echo("<td>".$nom."</td>");
					echo("<td>".$result3['rqeqv_nbr']."</td>");
					echo("<td>".$type."</td>");
				}
				
				echo("<td><a href=\"demusersupp.php?id=".$result3['rqeqv_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-circle btn-sm\" title=\"SUPPRIMER\"><i class=\"fas fa-trash text-white\"></i></a></td></tr>");
				$ref = $result3['rqeqv_ref'];
			}								
			echo("</tbody></table>");
			echo("<hr /><center><a href=\"askeqpmconform.php?cle=".$ref."\" class=\"d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm\"><i class=\"fas fa-check fa-sm text-black-75\"></i> Soumettre</a></center>");
			echo("</div>
			</div>
		  </div>");
		echo("</div></div>
		<!-- /.row -->");	
	 }
	?>
		 </div>
    <!-- /.container-fluid -->	
	
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	</div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

	<!-- Dialog Modal-->
	<div class="modal fade fond" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	  <div class="modal-header">     
		<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
      </div>
      <div class="modal-body">
        Cliquez sur "OUI" pour confirmer votre choix
	  </div>
      <div class="modal-footer">
		<a href="askeqpmform.php?cle=IT" class="btn btn-danger" id="confirmModalNo">Non</a>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>

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