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
        <div id="page-wrapper">
			
			<br /><br /><br />
           <center>
			<!--div class="alert alert-warning">Choisir la Cat&eacute;gorie de l'equipement...</div><br /-->
			<style type="text/css"> .btn{ width:300px; } </style>
			<button type="button" class="btn btn-info btn-lg" onclick="document.location='askeqpmform.php?cle=IT'" title="Matériels Informatiques"><i class="fa fa-edit" fa-fw></i> IT EQUIPMENT</button>
            <button type="button" class="btn btn-primary btn-lg" onclick="document.location='askeqpmform.php?cle=TC'" title="Matériels Télécoms"><i class="fa fa-edit" fa-fw></i> TC EQUIPMENT</button><br /><br />
            <button type="button" class="btn btn-danger btn-lg" onclick="document.location='askeqpmform.php?cle=ELEC'" title="Matériels Electriques"><i class="fa fa-edit" fa-fw></i> ELECTRICAL</button>
			<button type="button" class="btn btn-secondary btn-lg" onclick="document.location='askeqpmform.php?cle=CONSO'" title="Consommables Divers et Tonners"><i class="fa fa-edit" fa-fw></i> CONSOMMABLES</button><br /><br /><br /><br />
            </center>
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