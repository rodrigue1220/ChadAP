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

<style type="text/css"> .btn3{ width:180px; } </style>
	<!-- Page Heading -->
    
      <?php
		if ($pseudo=="administrateur")
		{
			echo("<div class=\"d-sm-flex align-items-center justify-content-between mb-4\">");
			echo("<a href=\"sugcommentlist.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-danger shadow-sm\" title=\"Liste des Suggestions & Commentaires\"><i class=\"fa fa-list fa-sm text-white-75\"></i> Voir les Sug/Comm</a>");
			echo("</div><hr />");
		}
	  ?>
	
	<div class="alert alert-primary" >
		Pour am&eacute;liorer la qualit&eacute; du service fourni, rien de plus efficace que d’utiliser le feedback des utilisateurs. 
		Vos feedbacks permettront &agrave; l’&eacute;quipe de mieux comprendre vos besoins afin de pouvoir y répondre. Laissez-vous entendre...
	</div>
	
    <!-- Content Row -->
    <div class="row">
	  <div class="col-lg-12">
		<form class="form-horizontal" name="formulaire" action="sugcomment2.php" method="post" >
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="mod">Module :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="mod" name="mod" required>
				<option> Structure G&eacute;n&eacute;rale</option>
				<option> Demande des Transports </option><option> Demande des SDR </option>
				<option> Demande Equipements </option><option> Demande Fournitures </option>
				<option> Billing System </option><option> Leaves System </option>
			  </select>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="rq">Remarques :</label>
			<div class="col-sm-5">
			  <textarea id="rq" name="rq" rows="5" class="form-control" onclick="this.value=''" >Saisir vos remarques... </textarea>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="prop">Propositions :</label>
			<div class="col-sm-5">
			  <textarea id="prop" name="prop" rows="5" class="form-control" onclick="this.value=''" >Renseigner les améliorations souhaitées </textarea>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3">Voulez-vous &ecirc;tre contacter :</label>
 			<div class="col-sm-7">
  			  <label class="radio-inline"><input type="radio" name="opt" id="opt" value="OUI">OUI</label>
			  <label class="radio-inline"><input type="radio" name="opt" id="opt" value="NON" checked="checked">NON</label>
			</div>
		  </div>
		  
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-5">
			  <button type="submit" class="btn btn3 btn-success"><i class="fa fa-check fa-fw"></i> Soumettre</button>
			  <button type="reset" class="btn btn3 btn-secondary"><i class="fa fa-remove fa-fw"></i> Effacer</button>
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