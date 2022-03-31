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
		
		<!-- List Requests Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Demandes SDR</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nba = $mysqli->query("SELECT COUNT(*) AS nba FROM wfp_chd_requestsdr ")->fetch_array();
							
							$nbr = $nba['nba'];
							if ($nbr==0)
							{	
								echo '0';
							}
							else
							{
								echo ("<a href=\"listsdr.php\">".$nbr." <i class=\"fa fa-arrow-circle-right\"></i></a>");  
							}
						?>
					</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-list fa-2x text-gray-600"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
		
		<!-- Approved Request Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Demandes Trait&eacute;es</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nbs = $mysqli->query("SELECT COUNT(*) AS nbs FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' ")->fetch_array();
							$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state='TRAITE' ")->fetch_array();										
							$nbr = $nbs['nbs']+$nbe['nbe'];
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
                    <i class="fas fa-thumbs-up fa-2x text-gray-600"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
		
		<!-- Standby Request Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">Demandes en Attente</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nbs = $mysqli->query("SELECT COUNT(*) AS nbs FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE' ")->fetch_array(); 
							$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='ATTENTE' OR rqeqpmt_state LIKE '%APPROUV%')")->fetch_array();
							$nbr = $nbe['nbe']+$nbs['nbs'];
							if ($nbr==0)
							{	
								echo '0';
							}
							else
							{
								echo ("<a href=\"details1attente.php\">".$nbr." <i class=\"fa fa-arrow-circle-right\"></i></a>");  
							}
						?>
					</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-hand-o-right fa-2x text-gray-600"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
		
		<!-- Rejeted Request Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">Demandes Rejet&eacute;es</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php 
							$nbs = $mysqli->query("SELECT COUNT(*) AS nbs FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='REJET' ")->fetch_array(); 
							$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='ANNULE' OR rqeqpmt_state LIKE '%REJET%') ")->fetch_array();
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
                    <i class="fas fa-thumbs-down fa-2x text-gray-600"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
	</div>
    <!-- Content Row -->
	
	<?php
		echo("<hr /><div class=\"row-lg-auto\">
		<div class=\"card shadow mb-4\">
		  <a href=\"#collapseCardSDRAT\" class=\"d-block card-header py-3\" data-toggle=\"collapse\" role=\"button\" aria-expanded=\"true\" aria-controls=\"collapseCardSDRAT\">
			<h6 class=\"m-0 font-weight-bold text-primary\">Demandes de SDR en Attente</h6>
		  </a>
		  <div class=\"collapse no-show\" id=\"collapseCardSDRAT\">
			<div class=\"card-body\">");
			
		$i=1;
		$exis = $mysqli->query("SELECT reqsdr_id AS ID FROM wfp_chd_requestsdr WHERE reqsdr_state='ATTENTE'")->fetch_array();
						
		if($exis['ID'] != 0)
		{
			$sql = "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_state='ATTENTE'" ;
			$requete = $mysqli->query( $sql ) ;
			echo("<table class=\"table\">
			<thead><tr>
				<th>#</th>
				<th>Demandeur</th>
				<th>Raison</th>
				<th>Salle</th>
				<th>Date</th>
				<th>Soumis le</th>
				<th align=\"center\" colspan=\"3\">Actions</th>
			</tr></thead>");
		
			while( $result = $requete->fetch_assoc()  )
			{
				$demandeur	= $result['reqsdr_deman'];
				$sqlz = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
				$requetez	= $mysqli->query( $sqlz );
				$resultz	= $requetez->fetch_assoc();
				$nom		= $resultz["nom"];
				$prenom 	= $resultz["prenom"];
										
				echo("<tbody><tr class=\"default\"><td>".$i."</td>");
				echo("<td>".$nom." ".$prenom."</td>");
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
										
				echo("<td>".$result['reqsdr_date']."</td>");
				echo("<td><a onclick=\"document.location='detailreqstsdr.php?id=".$result['reqsdr_id']."'\" title=\"DETAILLER\" class=\"btn btn-info btn-sm btn-circle\"><i class=\"fas fa-info-circle text-white\"></i></a></td>");
				echo("<td><a href=\"validasksdr.php?id=".$result['reqsdr_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success btn-sm btn-circle\" title=\"Valider la Demande\"><i class=\"fas fa-check-circle text-white\"></i></a></td>");
				echo("<td><a href=\"rejectasksdr.php?id=".$result['reqsdr_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-sm btn-circle\" title=\"Rejeter la Demande\"><i class=\"fas fa-trash text-white\"></i></a></td></tr>");
				$i++;
			}
		}
		else
		{
			echo("<div class=\"alert alert-warning\">Aucune demande en attente de traitement...</div>") ;		
		}
		echo("</tbody></table>");
		echo("</div>
		</div>
		</div></div>"); 
	?>
			
			
    <div class="row">
		<div class="col-xl-4 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pause-Caf&eacute;</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
				
				<?php
					$i=1;
					$exis = $mysqli->query("SELECT gesdr_id AS ID FROM wfp_chd_gesdr WHERE gesdr_cat='PC'")->fetch_array();
						
					if($exis['ID'] != 0)
					{
						$sql = "SELECT * FROM wfp_chd_gesdr WHERE gesdr_cat='PC' " ;
						$requete = $mysqli->query( $sql ) ;
						echo("<table class=\"table table-bordered\">
						<thead><tr>
							<th>#</th>
							<th>Articles</th>
							<th>D&eacute;tails</th>
						</tr></thead>");
		
						while( $result = $requete->fetch_assoc()  )
						{
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$result['gesdr_lib1']."</td>");
							echo("<td>".$result['gesdr_lib2']."</td>");										
							$i++;
						}
						echo("</tr></tbody></table>");
					}
					else
					{
						echo("<div class=\"alert alert-warning\">Aucun enregistrement...</div>") ;		
					}
				?>
                </table>
              </div>
            </div>
          </div>
		</div>
		
		<div class="col-xl-4 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Salles de R&eacute;union</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
               	<?php
					$i=1;
					$exis = $mysqli->query("SELECT gesdr_id AS ID FROM wfp_chd_gesdr WHERE gesdr_cat='SDR' ")->fetch_array();
						
					if($exis['ID'] != 0)
					{
						$sql = "SELECT * FROM wfp_chd_gesdr WHERE gesdr_cat='SDR' " ;
						$requete = $mysqli->query( $sql ) ;
						echo("<table class=\"table table-bordered\">
						<thead><tr>
							<th>#</th>
							<th>Noms</th>
							<th>D&eacute;tails</th>
						</tr></thead>");
		
						while( $result = $requete->fetch_assoc()  )
						{
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$result['gesdr_lib1']."</td>");
							echo("<td>".$result['gesdr_lib2']."</td>");										
							$i++;
						}
						echo("</tr></tbody></table>");
					}
					else
					{
						echo("<div class=\"alert alert-warning\">Aucun enregistrement...</div>") ;		
					}
				?>
				</table>
              </div>
            </div>
          </div>
		</div>
		
		<div class="col-xl-4 col-md-6 mb-4">
		<!-- Tables -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Equipements Multim&eacute;dia</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" >
				<?php
					$i=1;
					$exis = $mysqli->query("SELECT gesdr_id AS ID FROM wfp_chd_gesdr WHERE gesdr_cat='EQPMT' ")->fetch_array();
						
					if($exis['ID'] != 0)
					{
						$sql = "SELECT * FROM wfp_chd_gesdr WHERE gesdr_cat='EQPMT' " ;
						$requete = $mysqli->query( $sql ) ;
						echo("<table class=\"table table-bordered\">
						<thead><tr>
							<th>#</th>
							<th>D&eacute;signation</th>
							<th>D&eacute;tails</th>
						</tr></thead>");
		
						while( $result = $requete->fetch_assoc()  )
						{
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$result['gesdr_lib1']."</td>");
							echo("<td>".$result['gesdr_lib2']."</td>");										
							$i++;
						}
						echo("</tr></tbody></table>");
					}
					else
					{
						echo("<div class=\"alert alert-warning\">Aucun enregistrement...</div>") ;		
					}
				?>
				</table>
              </div>
            </div>
          </div>
		</div>

    </div>
    <!-- /.row -->
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
		<a href="accueil.php" class="btn btn-danger" id="confirmModalNo">Non</a>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>

  <!-- Bootstrap core JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>