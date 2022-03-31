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
	
	if ($profil != "AdminSTDESK")
	{
		header('Location:simple.php');
	}
	 
	include("inc/taarikh.php");
	include("inc/headers.php");
?>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list"></i> Demandes d'&eacute;quipements</h1>
	  <a href="listaskeqpmtall.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Toutes les demandes</a>				     
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-12">
	  <div class="card shadow mb-8">
			<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des demandes d'&eacute;quipement NON trait&eacute;es / assign&eacute;es</h6>
          </div>
	  <?php
		$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_state='ATTENTE2' AND rqeqpmt_type!='FOURN' ")->fetch_array();
		          echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");				
		if($exis['ID'] != 0)
		{        
			$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_state='ATTENTE2' AND rqeqpmt_type!='FOURN' ORDER BY rqeqpmt_id DESC" ;
			$requete = $mysqli->query( $sql ) ;
			echo("<thead>
				<tr>
				  <th>#</th>
				  <th>Ref.</th>
				  <th>Demandeur</th>
				  <th>Initi&eacute;e le</th>
				  <th>Raison</th>
				  <th>OIC</th>
				  <th>Approuv&eacute;e le</th>
				  <th></th>
				</tr>
				</thead>");
	
			while( $result3 = $requete->fetch_assoc()  )
			{
				$init	= $result3['rqeqpmt_demand'];
				$sql 	= "SELECT * FROM user WHERE pseudo='$init' " ;
				$req 	= $mysqli->query( $sql );
				$res	= $req->fetch_assoc();
				$nom	= $res["nom"];
				$pnom	= $res["prenom"];
		
				echo("<tbody><tr><td>".$result3['rqeqpmt_id']."</td>");
				echo("<td>".$result3['rqeqpmt_ref']."</td>");
				echo("<td>".$nom." ".$pnom."</td>");
				echo("<td>".$result3['rqeqpmt_date']."</td>");
				echo("<td>".$result3['rqeqpmt_motif']."</td>");
				echo("<td>".$result3['rqeqpmt_oic']."</td>");
				echo("<td>".$result3['rqeqpmt_doic']."</td>");
				echo("<td><a href=\"listaskeqpmtdet.php?id=".$result3['rqeqpmt_ref']."\" class=\"btn btn-info btn-circle btn-sm\" title=\"DETAILLER LA DEMANDE\"><i class=\"fas fa-list text-white\"></i></a></td>");
			}
			echo("</tr></tbody>");
		}
		else
		{
			echo("<div class=\"alert alert-danger\">Aucune demande d'&eacute;quipement NON trait&eacute;e / assign&eacute;e...</div>") ;		
		}
	  ?>
		</table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card shadow -->
      </div>
      <!-- /.col-lg-12 -->
	</div>
	<!--row -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	  
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