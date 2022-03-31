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
	
	$nbra 	= $mysqli->query("SELECT COUNT(cargo_id) AS nb FROM wfp_chd_cargo WHERE cargo_state='CHARGE' ")->fetch_array();
	$carga	= $nbra['nb'];
	$nbrap 	= $mysqli->query("SELECT COUNT(cargo_id) AS nb FROM wfp_chd_cargo WHERE cargo_state='DECHARGE' ")->fetch_array();
	$cargap	= $nbrap['nb'];
	
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
  
	$detcargos = $connection->query("SELECT * FROM wfp_chd_cargo 
									WHERE cargo_state='CHARGE' OR cargo_state='DECHARGE' OR cargo_state='' OR cargo_state='ARRIVE'
									ORDER BY cargo_state
									LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(cargo_id) AS id FROM wfp_chd_cargo WHERE cargo_state='CHARGE' OR cargo_state='DECHARGE' OR cargo_state='' OR cargo_state='ARRIVE' ")->fetchAll();
	$allRecords = $sql[0]['id'];

	// Calculate total pages
	$totoalPages = ceil($allRecords / $limit);

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
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />
<style type="text/css"> .btn2{ width:130px; } </style>
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cogs"></i> Gest. Cargaisons</h1>
	   <a href="askflotteat.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-edit fa-sm text-black-75"></i> Assign. Camion</a>
	   <a href="gestdmd.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-warning shadow-sm"><i class="fas fa-list fa-sm text-black-75"></i> Liste des Demandes</a>				
	</div>
	<hr />   
    
	<?php

		$exis = $mysqli->query("SELECT cargo_id AS ID FROM wfp_chd_cargo WHERE cargo_state='CHARGE' OR cargo_state='DECHARGE' OR cargo_state='' OR cargo_state='ARRIVE' ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>

	<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="gestchargefaticha.php">
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
        <form action="gestcharge.php" method="get">
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
    
	<div class="alert alert-info">
	<?php 
		echo ("<i class=\"fas fa-fw fa-list\"></i> Liste des Cargaisons : <b>".$allRecords."</b> | Page : <b>".$page."</b>");
		echo(" | CHARGEE : <strong>$carga</strong>");	
		echo(" | DECHARGEE : <strong>$cargap</strong>");
	?>
	</div>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">R&eacute;f&eacute;rence</th>
				<th scope="col">N&deg; Demande</th>
				<th scope="col">Projet</th>
				<th scope="col">V&eacute;hicule</th>
				<th scope="col">Chauffeur</th>
				<th colspan="2">Actions</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">R&eacute;f&eacute;rence</th>
				<th scope="col">N&deg; Demande</th>
				<th scope="col">Projet</th>
				<th scope="col">V&eacute;hicule</th>
				<th scope="col">Chauffeur</th>
				<th colspan="2">Actions</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detcargos as $detcargo): 
			
			$ref	= $detcargo['cargo_numberdem'];
			$id		= $detcargo['cargo_id'];
			
			$sql 	= "SELECT * FROM wfp_chd_cargodem WHERE cargodem_number='$ref'" ;
			$requete= $mysqli->query( $sql ) ;
			$result = $requete->fetch_assoc();
			$projet = $result['cargodem_proj'];
			$dem	= $result['cargodem_number'];
			
			echo("<tr><td><a href=\"gestchargedetcargo.php?ide=".$id."\">".$detcargo['cargo_ref']."</a></td>");
			echo("<td>".$dem."</a></td>");
			echo("<td>".$projet."</td>");
			echo("<td>".$detcargo['cargo_vehi']."</td>");
			echo("<td>".$detcargo['cargo_chauf']."</td>");
			
			if ($detcargo['cargo_state']=="")
			{
				echo("<td><a href=\"cargoact.php?ide=".$detcargo['cargo_id']."&choix=CHRG&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Charger\"><i class=\"fas fa-unlock\"></i></a></td>");										
			}
			else if ($detcargo['cargo_state']=="CHARGE")
			{
				echo("<td><a href=\"cargoact.php?ide=".$detcargo['cargo_id']."&choix=DCHRG&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-danger btn-circle shadow-sm\" title=\"D&eacute;charger\"><i class=\"fas fa-lock\"></i></a></td>");										
				echo("<td><a href=\"cargoact.php?ide=".$detcargo['cargo_id']."&choix=MSERTE&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-warning btn-circle shadow-sm\" title=\"Mise en route\"><i class=\"fas fa-truck\"></i></a></td>");
			}
			else if ($detcargo['cargo_state']=="ARRIVE")
			{
				echo("<td><a href=\"cargoact.php?ide=".$detcargo['cargo_id']."&choix=DCHRG&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-danger btn-circle shadow-sm\" title=\"D&eacute;charger\"><i class=\"fas fa-lock\"></i></a></td>");										
			}
			else
			{
				echo("<td><a href=\"cargodet.php?ide=".$detcargo['cargo_id']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-info btn-circle shadow-sm\" title=\"D&eacute;tailler\"><i class=\"fas fa-list\"></i></a></td>");										
			}
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
                <a class="page-link btn2 btn-success"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
            </li>
        </ul>
    </nav>
	
	<?php
		}
		else
		{
			echo("<div class=\"alert alert-danger\">Aucune Cargaison Charg&eacute;e / D&eacute;charg&eacute;e... </div>") ;	
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

  <!-- Bootstrap core JavaScript-->
  <script src="http://10.109.87.10:8080/vendor/jquery/jquery.min.js"></script>
  <script src="http://10.109.87.10:8080/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
   <script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
        });
    </script>

</body>

</html>