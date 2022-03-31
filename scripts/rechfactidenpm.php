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
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
	
	$mois= $_GET["cle"];
	
  // Database
  include('db.php');
  
  // Set session
  //session_start();
  if(isset($_GET['records-limit'])){
      $_SESSION['records-limit'] = $_GET['records-limit'];
  }
  
  $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
  $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
  $paginationStart = ($page - 1) * $limit;
  
  if (substr($mois, -1)=="9")
  {
	$detfactnidens = $connection->query("SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp_archv19 WHERE MONTH='$mois' AND STATE='IDENTIFIE' ORDER BY MSISDN_NO LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(DISTINCT MSISDN_NO) AS id FROM wfp_chd_bilpp_archv19 WHERE MONTH='$mois' AND STATE='IDENTIFIE' ")->fetchAll();
	$allRecrods = $sql[0]['id'];
  }
  
  else if (substr($mois, -1)=="8")
  {
	$detfactnidens = $connection->query("SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp_archv WHERE MONTH='$mois' AND STATE='IDENTIFIE' ORDER BY MSISDN_NO LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(DISTINCT MSISDN_NO) AS id FROM wfp_chd_bilpp_archv WHERE MONTH='$mois' AND STATE='IDENTIFIE' ")->fetchAll();
	$allRecrods = $sql[0]['id'];
  }
  
  else
  {
	$detfactnidens = $connection->query("SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp WHERE MONTH='$mois' AND STATE='IDENTIFIE' ORDER BY MSISDN_NO LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(DISTINCT MSISDN_NO) AS id FROM wfp_chd_bilpp WHERE MONTH='$mois' AND STATE='IDENTIFIE' ")->fetchAll();
	$allRecrods = $sql[0]['id'];
  }
  
  // Calculate total pages
  $totoalPages = ceil($allRecrods / $limit);

  // Prev + Next
  $prev = $page - 1;
  $next = $page + 1;
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
<style type="text/css"> .btn3{ width:180px; } </style>
<style type="text/css"> .btn2{ width:130px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-search"></i> Recherche de (s) facture (s) identifi&eacute; (s) de : <?php echo ("<font color=\"red\">".$_GET["cle"]."</font>"); ?></h1>
	  <?php 
		echo("<a href=\"factchaharfinance.php?cle=".$mois."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm\"><i class=\"fa fa-money fa-sm text-black-75\"></i> Facture Finance</a>");
	  ?>
	</div>
	<hr />   
    
	<?php
		if($allRecrods != 0)
		{	
	?>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="rechfactidenpm.php" method="get">
			<input type="hidden" id="cle" name="cle" value="<?php echo $mois; ?>" />
            <select name="records-limit" id="records-limit" class="custom-select">
                <option disabled selected>Records Limit</option>
                <?php foreach([3, 5,10,15,20] as $limit) : ?>
					<option
                        <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                        value="<?= $limit; ?>">
                        <?= $limit; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
	
	<div class="alert alert-info">
		<?php echo ("Liste de (s) facture (s) Identifi&eacute;es | Total Enregistrements : <b>".$allRecrods."</b> | Page : <b>".$page."</b>"); ?>
	</div>
    
	<!-- Datatable -->
    <table class="table table-bordered ">
        <thead>
            <tr class="table-primary">
                <th scope="col">Num&eacute;ros</th>
				<th scope="col">Utilisateurs</th>
				<th colspan="4">Actions</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">Num&eacute;ros</th>
				<th scope="col">Utilisateurs</th>
				<th colspan="4">Actions</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detfactnidens as $detfactniden): ?>
            <tr>
				<?php 
					
					$phone = $detfactniden['MSISDN_NO'];
					
					$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ";
					$requetep	= $mysqli->query( $sqlp );
					$resultp 	= $requetep->fetch_assoc();
					$nom  		= $resultp['nom'];
					$pnom 		= $resultp['prenom'];
				?>
                <td><?php echo $phone; ?></td>
                <td><?php echo $nom." ".$pnom; ?></td>
                <?php
					echo("<td><a href=\"factdetails.php?cle=".$mois."&tel=".$phone."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-primary btn-circle shadow-sm\" title=\"Details Facture\"><i class=\"fa fa-list\"></i></a></td>"); 										
					echo("<td><a href=\"gaboulouiden.php?cle=".$mois."&tel=".$phone."&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Annuler Identification\"><i class=\"fa fa-reply\"></i></a></td>"); 										
					echo("<td><a href=\"inc/rissalarapindiv.php?cle=".$mois."&tel=".$phone."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-warning btn-circle shadow-sm\" title=\"Rappel Email\"><i class=\"fa fa-envelope\"></i></a></td>"); 										
					echo("<td><a href=\"delfact.php?cle=".$mois."&tel=".$phone."&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-danger btn-circle shadow-sm\" title=\"Supprimer Details Identification\"><i class=\"fa fa-remove\"></i></a></td>"); 										
				?>
			</tr>
          <?php endforeach; ?>
        </tbody>
    </table>
	
	<!-- Pagination -->
    <nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page <= 1){ echo '#'; } else { echo "?cle=".$mois."&page=" . $prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
            </li>

            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?cle=".$mois."&page=". $next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
            </li>
        </ul>
    </nav>
	
	<?php 
		}
		else
		{
			echo("<div class=\"alert alert-warning\">Aucune Facture Disponible...</div>") ;	
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
		<?php echo("<a href=\"rechfactidenpm.php?cle=".$mois."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
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
  
   <script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
        });
    </script>

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://10.109.87.10:8080/js/demo/chart-area-demo.js"></script>
  <script src="http://10.109.87.10:8080/js/demo/chart-pie-demo.js"></script>

</body>

</html>