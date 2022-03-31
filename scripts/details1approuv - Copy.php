<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<style type="text/css"> .btn3{ width:180px; } </style>

	<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-thumbs-up fa-fw"></i> Mes Demandes Approuv&eacute;es / Trait&eacute;es</h1>
	<hr />
	<div class="row-lg-auto">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liste des demandes d'&eacute;quipement / fourniture </h6>
          </div>
                                
		<?php
			echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");
			  
		    $i=1;
			$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state='TRAITE'")->fetch_array();
						
			if($exis['ID'] != 0)
			{
				$sql = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state='TRAITE'" ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>#</th>
					<th>Item Description</th>
					<th>Nombre</th>
					<th>Raison</th>
					<th>Approbation OIC</th>
					<th>Approbation ICT / Stock</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					echo("<tbody><tr><td>".$i."</td>");
					echo("<td>".$result['rqeqpmt_item']."</td>");
					echo("<td>".$result['rqeqpmt_nbr']."</td>");	
					echo("<td>".$result['rqeqpmt_motif']."</td>");
					echo("<td>APPROUVEE</td>");	
					echo("<td>TRAITEE</td></tr>");
											
					$i++;
				}
			}
			else
			{
				echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande d'&eacute;quipement approuv&eacute;e...</div>") ;		
			}
		?>
		</tbody></table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card shadow -->
	</div>
	<hr />
	<div class="row-lg-auto">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liste des demandes de SDR </h6>
          </div>
								
		<?php
			echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");
			  
			$i=1;
			$exis = $mysqli->query("SELECT reqsdr_id AS ID FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE'")->fetch_array();
						
			if($exis['ID'] != 0)
			{
				$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' " ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>#</th>
					<th>Raison</th>
					<th>Salle</th>
					<th>Du</th>
					<th>Au</th>
					<th>Pause-caf&eacute;</th>
					<th>Multim&eacute;dia</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					echo("<tbody><tr><td>".$i."</td>");
					echo("<td>".$result['reqsdr_raison']."</td>");
					echo("<td>".$result['reqsdr_salle']."</td>");	

					if ($result['reqsdr_mind'] < 10)
					{
						echo("<td>".$result['reqsdr_deb']." ".$result['reqsdr_heurd']."h 0".$result['reqsdr_mind']."mn</td>");
					}
					else
					{
						echo("<td>".$result['reqsdr_deb']." ".$result['reqsdr_heurd']."h ".$result['reqsdr_mind']."mn</td>");
					}
										
					if ($result['reqsdr_minf'] < 10)
					{
						echo("<td>".$result['reqsdr_fin']." ".$result['reqsdr_heurf']."h 0".$result['reqsdr_minf']."mn</td>");
					}
					else
					{
						echo("<td>".$result['reqsdr_fin']." ".$result['reqsdr_heurf']."h ".$result['reqsdr_minf']."mn</td>");
					}
					echo("<td>".$result['reqsdr_pc']."</td>
						<td>".$result['reqsdr_mmedia']."</td></tr>");

					$i++;
				}
			}
			else
			{
				echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande de SDR approuv&eacute;e...</div>") ;		
			}
		?>
		</tbody></table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card shadow -->
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