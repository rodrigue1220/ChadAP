<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	include('connexion.php');
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');			
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-edit fa-fw"></i> Modification Demande de SDR</h1>
	<hr />
	<div class="row">
	  <div class="col-lg-12">
	  <?php
		$id		= $_GET['id'];
		$sql	= "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_id='$id'" ;
		$req 	= $mysqli->query($sql);
		$result = $req->fetch_assoc();
	  ?>
        <form class="form-horizontal" name="formulaire" action="modif1asksdr2.php" method="post">
		  <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />					
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="deb">Du :</label>
			<div class="col-sm-2">
			  <input type="date" id="deb" name="deb" class="form-control" value="<?php echo $result['reqsdr_deb']; ?>" required />
			</div>
			<label class="control-label col-sm-1" for="fin">Au :</label>
			<div class="col-sm-2">
			  <input type="date" id="fin" name="fin" class="form-control" value="<?php echo $result['reqsdr_fin']; ?>" required />
			</div>
		  </div>	
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="heurd">De :</label>
			<div class="col-sm-1">
			  <input type="text"  id="heurd" name="heurd" class="form-control" value="<?php echo $result['reqsdr_heurd']; ?>" required />
			</div>
			<div class="col-sm-1">
			  <input type="text" id="mind" name="mind" class="form-control" value="<?php echo $result['reqsdr_mind']; ?>" required />
			</div>
			<label class="control-label col-sm-1" for="heurf">A :</label>
			<div class="col-sm-1">
			  <input type="text" id="heurf" name="heurf" class="form-control" value="<?php echo $result['reqsdr_heurf']; ?>" required />
			</div>
			<div class="col-sm-1">
			  <input type="text" id="minf" name="minf" class="form-control" value="<?php echo $result['reqsdr_minf']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="motif">Raison :</label>
			<div class="col-sm-5">
			  <input type="text" id="motif" name="motif" class="form-control" value="<?php echo $result['reqsdr_raison']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="nbr">Nombre de Participant :</label>
			<div class="col-sm-5">
			  <input type="text" id="nbr" name="nbr" class="form-control" value="<?php echo $result['reqsdr_nbr']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="sdr">Salle :</label>
			<div class="col-sm-5">
			  <input type="text" id="sdr" name="sdr" class="form-control" value="<?php echo $result['reqsdr_salle']; ?>" required />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="otreq">Equipements Multim&eacute;dia :</label>
			<div class="col-sm-5">
			  <input type="text" id="otreq" name="otreq" class="form-control" value="<?php echo $result['reqsdr_mmedia']; ?>" />
			</div>
		  </div>
		  
		  <div class="form-group row">
			<label class="control-label col-sm-3" for="otrpc">Pause-Caf&eacute; :</label>
			<div class="col-sm-5">
			  <input type="text" id="otrpc" name="otrpc" class="form-control" value="<?php echo $result['reqsdr_pc']; ?>" />
			</div>
		  </div>
					
		  <div class="form-group row">
			<div class="col-sm-offset-2 col-sm-12">
			  <button type="submit" class="btn btn3 btn-warning"><i class="fa fa-edit fa-fw"></i> Modifier</button>
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
