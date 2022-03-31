<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
require_once('config.php');
require_once('verifications.php');
include('connexion.php');
?>

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
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />
	<style type="text/css"> .btn3{width:180px;} </style>
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Tableau de bord</h1>
            <!--a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a-->
    </div>

    <!-- Content Row -->
    <div class="row">
			
		<!-- Approved Request Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Demandes Trait&eacute;es / APRV</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nbs = $mysqli->query("SELECT COUNT(*) AS nbs FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' ")->fetch_array();
							$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmtvar WHERE rqeqv_dem='$pseudo' AND (rqeqv_state='TRT' OR rqeqv_state='APRV2') ")->fetch_array();
							$nbr = $nbe['nbe']+$nbs['nbs'];
							if ($nbr==0)
							{	
								echo '0';
							}
							else
							{
								echo ("<a href=\"details1approuv.php\">".$nbr." <i class=\"fa fa-arrow-circle-right\"></i></a>");  
							} 
						?>
					</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
		
		<!-- Standby Request Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Demandes en Attente</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nbsa = $mysqli->query("SELECT COUNT(*) AS nbs FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE' ")->fetch_array(); 
							$nbea = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmtvar WHERE rqeqv_dem='$pseudo' AND (rqeqv_state='AUTO' OR rqeqv_state='SOUMIS' OR rqeqv_state='APRV1' ) ")->fetch_array();
							$nbra = $nbea['nbe']+$nbsa['nbs'];
							if ($nbra==0)
							{	
								echo '0';
							}
							else
							{
								echo ("<a href=\"details1attente.php\">".$nbra." <i class=\"fa fa-arrow-circle-right\"></i></a>");  
							}
						?>
					</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-hand-o-right fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
		
		<!-- Rejeted Request Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">Demandes Rejet&eacute;es</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nbs = $mysqli->query("SELECT COUNT(*) AS nbs FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='REJET' ")->fetch_array(); 
							$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmtvar WHERE rqeqv_dem='$pseudo' AND (rqeqv_state='ANNULE' OR rqeqv_state LIKE '%REJ%') ")->fetch_array();
							$nbr = $nbe['nbe']+$nbs['nbs'];
							if ($nbr==0)
							{	
								echo '0';
							}
							else
							{
								echo ("<a href=\"details1rejet.php\">".$nbr." <i class=\"fa fa-arrow-circle-right\"></i></a>");  
							}
						?>
					</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-thumbs-down fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
	</div>
    <!-- Content Row -->
	
    <div class="row">
				
	
		
		<div class="col-xl-4 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-secondary"><i class="fas fa-fw fa-edit"></i> Demande (s) Personnalis&eacute;e (s)</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >					
					 <ul class="list-group">
						<li class="list-group-item"><i class="fas fa-fw fa-home"></i> <a href="add1asksdr.php">Salle de r&eacute;union</a></li>
						<li class="list-group-item"><i class="fas fa-fw fa-book-open"></i> <a href="askfour.php">Fourniture</a></li>
						<li class="list-group-item"><i class="fas fa-fw fa-laptop"></i> <a href="askeqpmt.php">Equipement</a></li>
					</ul> 
				</table>
              </div>
            </div>
          </div>
		</div>
		
		<div class="col-xl-4 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-secondary"><i class="fas fa-fw fa-calendar"></i> Leave System</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >					
					 <ul class="list-group">
						<li class="list-group-item"><i class="fas fa-fw fa-calendar-o"></i> <a href="djoummah.php">Cong&eacute;s</a></li>
						<li class="list-group-item"><i class="fas fa-fw fa-hourglass-half"></i> <a href="compenscto.php">Heure (s) suppl&eacute;mentaire (s)</a></li>
					</ul> 
				</table>
              </div>
            </div>
          </div>
		</div>	

				<?php 
			$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
			$requete = $mysqli->query( $sql );
			$result = $requete->fetch_assoc();
			$nomoic = $result["nom"];
			$pnomoic = $result["prenom"];	
			
			$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic'")->fetch_array();
			if($oic['ID'] != 0)
			{
				echo("<div class=\"col-xl-4 col-md-6 mb-4\">
						<div class=\"card shadow mb-8\">
							<div class=\"card-header py-3\">
								<h6 class=\"m-0 font-weight-bold text-secondary\"><i class=\"fas fa-fw fa-check\"></i> Approbations OIC</h6>
					</div>");
				echo("<div class=\"card-body\">
					<div class=\"table-responsive\">
						<table class=\"table table-bordered\" >					
						<ul class=\"list-group\">");
				echo("<li class=\"list-group-item\"></i> <i class=\"fas fa-fw fa-laptop\"></i> <a href=\"askapprv.php\">Demandes Four / Eqpmt</a></li>");
				echo("<li class=\"list-group-item\"><i class=\"fas fa-fw fa-calendar\"></i> <a href=\"djoummahapprv.php\">Demandes Cong&eacute;s / HSup.</a></li>");			
			}
			
			$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic' AND off_unit='ICT/CO NDJAMENA' ")->fetch_array();
			if($oic['ID'] != 0)
			{
				echo("<li class=\"list-group-item\"><i class=\"fas fa-fw fa-check\"></i> <a href=\"listdeqpmtatit.php\">Approbations TEC</a></li>");			
			}
			
			$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic' AND off_unit='ADMIN-FINANCE/CO NDJAMENA' ")->fetch_array();
			if($oic['ID'] != 0)
			{
				echo("<li class=\"list-group-item\"><i class=\"fas fa-fw fa-check\"></i> <a href=\"listdefourn.php\">Approbations ADMIN</a></li>");			
			}
			
			//$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic' AND off_unit='LOGISTIQUE/CO NDJAMENA' ")->fetch_array();
			if($pseudo=="zimbos")
			{
				echo("<li class=\"list-group-item\"><i class=\"fas fa-fw fa-bus\"></i> <a href=\"listdecargo.php\">Approbations WORKSHOP</a></li>");			
			}
			echo("</ul></table></div></div></div></div>");
		?>
		
	</div>

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
		<?php echo("<a href=\"accueil.php\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>");?>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>

  <!-- Bootstrap core JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>