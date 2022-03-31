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
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-plus"></i> <i class="fas fa-fw fa-globe"></i>  Zone Administrative / Warehouse</h1>
	  <a href="gestflotte.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-8">
        <form class="form-horizontal" name="formulaire" action="addadmin2.php" method="post">
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="reg">R&eacute;gion :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="reg" name="reg" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="dept">D&eacute;partement :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="dept" name="dept" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sp">Sous-pr&eacute;fecture :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="sp" name="sp" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="area">Nom :</label>
			<div class="col-sm-5">
			  <input type="text" class="form-control" id="area" name="area" placeholder="Nom du lieu ou du Warehouse..." required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="typezone">Type :</label>
			<div class="col-sm-5">
			  <select class="form-control" id="typezone" name="typezone" required>
				<option></option>
				<option>ZONE</option>
				<option>WAREHOUSE</option>
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