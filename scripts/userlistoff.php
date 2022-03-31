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
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
?>
<script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
<script src="http://10.109.87.10:8080/scripts/js/bootstrap.min.js"></script>
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
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-institution"></i> Bureau <?php echo("<font color=\"blue\">".$_GET["id"]."</font>"); ?></h1>
	  <a href="add1user.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm" title="Nouvel Utilisateur"><i class="fas fa-user-plus fa-fw"></i> Nouvel User</a>
	  <a href="offlist.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm" title="Liste des Bureaux"><i class="fas fa-institution fa-sm text-white-75"></i> Bureaux RBD Chad</a>				
	</div>
	<hr />   
    
	<!--row -->
	<div class="row">
      <div class="col-lg-12">
		<div class="card shadow mb-8">
		  <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Utilisateurs</h6>
          </div>
		  <?php
			echo("<div class=\"card-body\">
            <div class=\"table-responsive\">
              <table class=\"table\">");
							
			$i=1;
			$nom=$_GET["id"];
			$exis = $mysqli->query("SELECT id AS ID FROM user WHERE pseudo!='administrateur' ")->fetch_array();
				
			if($exis['ID'] != 0)
			{
				$sql = "SELECT * FROM user WHERE pseudo!='administrateur' AND unite LIKE '%$nom%' ORDER BY nom " ;
				$requete = $mysqli->query( $sql ) ;
				echo("<thead><tr>
					<th>#</th>
					<th>Nom et Pr&eacute;nom</th>
					<th>Pseudo</th>
					<th>Unit&eacute;</th>
					<th colspan=\"2\">Actions</th>
				</tr></thead>");
		
				while( $result = $requete->fetch_assoc()  )
				{
					$statut = $result['state'];
					echo("<tbody><tr><td>".$i."</td>");
					echo("<td>".$result['nom']." ".$result['prenom']."</td>");
					echo("<td>".$result['pseudo']."</td>");	
					echo("<td>".$result['unite']."</td>");
					
					echo("<td><a href=\"usermod.php?ide=".$result['id']."\" class=\"btn btn-warning btn-circle btn-sm\" title=\"MODIFIER\"><i class=\"fas fa-edit text-white\"></i></a></td>");
					if ($statut=="ACTIF")
					{
						echo("<td><a href=\"desacompte3.php?ide=".$result['id']."&choix=DESC\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-danger btn-circle btn-sm\" title=\"DESACTIVER\"><i class=\"fas fa-ban text-white\"></i></a></td></tr></tbody>");
					}
					else
					{
						echo("<td><a href=\"desacompte3.php?ide=".$result['id']."&choix=ACT\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-success btn-circle btn-sm\" title=\"ACTIVER\"><i class=\"fas fa-check text-white\"></i></a></td></tr></tbody>");
					}
					$i++;
				}
			}
			else
			{
				echo("<div class=\"alert alert-info\">Aucun Compte Utilisateur &aagrave; ".$nom."...</div>") ;		
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
  
  	<!-- Dialog Modal-->
	<div class="modal fade fond" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	  <div class="modal-header">     
		<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
      </div>
      <div class="modal-body">
        Cliquez sur "OUI" pour confirmer votre choix
	  </div>
      <div class="modal-footer">
		<?php echo("<a href=\"userlistoff.php?id=".$nom."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>");?>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>

  <!-- Bootstrap core JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>