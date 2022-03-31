<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	$nbri 	= $mysqli->query("SELECT COUNT(rh_id) AS nb FROM wfp_chd_personnel WHERE rh_statut='INACTIF' ")->fetch_array();
	$trt	= $nbri['nb'];
	
	include("inc/taarikh.php");
	include("inc/headers.php");
	
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
  
	$detemploys = $connection->query("SELECT * FROM wfp_chd_personnel 
									WHERE rh_statut='ACTIF' 
									ORDER BY rh_lname
									LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(rh_id) AS id FROM wfp_chd_personnel WHERE rh_statut='ACTIF' ")->fetchAll();
	$allRecords = $sql[0]['id'];

	// Calculate total pages
	$totoalPages = ceil($allRecords / $limit);

	// Prev + Next
	$prev = $page - 1;
	$next = $page + 1;
?>

<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Profils des Employ&eacute;s ACTIFS</h1>
	  <?php
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_personnel WHERE rh_statut='' ")->fetch_array();		
		if($nb['nb']!=0)
		{
			echo ("<a href=\"confemploy.php\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm\"><i class=\"fa fa-legal\" fa-fw></i> Confirmer Profil</a>");
		}
	  ?>
	  <a href="gestcontcong.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm"><i class="fas fa-wrench fa-sm text-black-75"></i> Admin. RH</a>
	</div>
	<hr />
	
	<?php

		$exis = $mysqli->query("SELECT rh_id AS ID FROM wfp_chd_personnel WHERE rh_statut='ACTIF'")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>

	<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="employfaticha.php">
      <div class="input-group">
        <input type="text" id="cle" name="cle" class="form-control bg-highlight border-2 small" placeholder="Rechercher et modifier..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  
	<!-- Select dropdown -->
	<div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="employlist.php" method="get">
            <select name="records-limit" id="records-limit" class="custom-select">
                <option disabled selected>Records Limit</option>
                <?php foreach([3,5,10,15,20] as $limit) : ?>
					<option
                        <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                        value="<?= $limit; ?>">
                        <?= $limit; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    
	<?php 
		echo ("Liste des Employ&eacute;s ACTIFS : <b>".$allRecords."</b> | Page : <b>".$page."</b>");
		echo(" | <a href=\"employlistinac.php\">Employ&eacute;s INACTIFS : <strong>$trt</strong></a>");		
	?>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">Index</th>
				<th scope="col">Nom et Pr&eacute;nom</th>
				<th scope="col">Titre</th>
				<th scope="col">Duty</th>
				<th scope="col">EOD</th>
				<th scope="col">NTE</th>
				<th colspan="3">Actions</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">Index</th>
				<th scope="col">Nom et Pr&eacute;nom</th>
				<th scope="col">Titre</th>
				<th scope="col">Duty</th>
				<th scope="col">EOD</th>
				<th scope="col">NTE</th>
				<th colspan="3">Actions</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detemploys as $detemploy): 
            
			$alyom = date("Y-m-d");
			$duree	= (strtotime($detemploy['rh_nte'])- strtotime($alyom))/86400; 
			if ($duree<=15)
			{
				echo("<tr bgcolor=\"pink\"><td>".$detemploy['rh_nopers']."</td>");
				echo("<td>".$detemploy['rh_lname']." ".$detemploy['rh_fname']."</td>");											
				echo("<td>".$detemploy['rh_titre']."</td>");
				echo("<td>".$detemploy['rh_duty']."</td>");	
				echo("<td>".date("d.m.Y", strtotime($detemploy['rh_eod']))."</td>");
				echo("<td>".date("d.m.Y", strtotime($detemploy['rh_nte']))."</td>");	
			}
			else
			{
				echo("<tr><td>".$detemploy['rh_nopers']."</td>");
				echo("<td>".$detemploy['rh_lname']." ".$detemploy['rh_fname']."</td>");	
				echo("<td>".$detemploy['rh_titre']."</td>");
				echo("<td>".$detemploy['rh_duty']."</td>");	
				echo("<td>".date("d.m.Y", strtotime($detemploy['rh_eod']))."</td>");
				echo("<td>".date("d.m.Y", strtotime($detemploy['rh_nte']))."</td>");	
			}
			echo("<td><a href=\"employmod.php?id=".$detemploy['rh_id']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-info btn-circle shadow-sm\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a></td>"); 										
			echo("<td><a href=\"desacpte.php?id=".$detemploy['rh_id']."&cx=DESC&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-warning btn-circle shadow-sm\" title=\"Desactiver\"><i class=\"fas fa-lock\"></i></a></td>"); 										
			echo("<td><a href=\"suppcpte.php?id=".$detemploy['rh_id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-danger btn-circle shadow-sm\" title=\"Supprimer\"><i class=\"fas fa-trash\"></i></a></td>"); 										
			echo '</tr>';
          
			endforeach; 
		  ?>
        </tbody>
    </table>
	
	<!-- Pagination -->
    <nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
            </li>

            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
            </li>
        </ul>
    </nav>
	
	<?php
		}
		else
		{
			echo("<div class=\"alert alert-danger\">Aucun Profil Employ&eacute; ACTIF... </div>") ;	
			echo("</tbody></table>");
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
		<?php echo("<a href=\"employlist.php?&page=".$page."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
		<a href="#" class="btn btn-success" id="confirmModalYes">Oui</a>
      </div>

	</div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  
   <script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
        });
    </script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>