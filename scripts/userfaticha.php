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
	
	$cle = $_GET["cle"];
	if ($cle == "")
	{
		header('Location:userlist.php');
	}
	
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
  
	$detusers = $connection->query("SELECT * FROM user 
									WHERE pseudo!='administrateur' AND (nom LIKE '%$cle%' OR prenom LIKE '%$cle%' OR pseudo LIKE '%$cle%' OR tel LIKE '%$cle%' OR email LIKE '%$cle%' OR unite LIKE '%$cle%')
									ORDER BY nom
									LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(id) AS id FROM user WHERE pseudo!='administrateur' AND (nom LIKE '%$cle%' OR prenom LIKE '%$cle%' OR pseudo LIKE '%$cle%' OR tel LIKE '%$cle%' OR email LIKE '%$cle%' OR unite LIKE '%$cle%') ")->fetchAll();
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
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />
<style type="text/css"> .btn3{ width:180px; } </style>
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-search"></i> R&eacute;sultat de la recherche</h1>
	  <a href="add1user.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm" title="Nouvel Utilisateur"><i class="fas fa-user-plus fa-fw"></i> Nouvel User</a>
	  <a href="offlist.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-primary shadow-sm" title="Liste des Bureaux"><i class="fas fa-institution fa-sm text-white-75"></i> Bureaux RBD Chad</a>				
	</div>
	<hr />   
    
	<?php

		$exis = $mysqli->query("SELECT id AS ID FROM user WHERE pseudo!='administrateur' AND (nom LIKE '%$cle%' OR prenom LIKE '%$cle%' OR pseudo LIKE '%$cle%' OR tel LIKE '%$cle%' OR email LIKE '%$cle%' OR unite LIKE '%$cle%') ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>

	<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="userfaticha.php">
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
        <form action="userfaticha.php" method="get">
			<input type="hidden" id="cle" name="cle" value="<?php echo $cle; ?>" />
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
    
	<div class="alert alert-secondary">
	<?php 
		echo ("Liste des utilisateurs | Mot cl&eacute;: <font color=\"#FF0000\">$cle</font> : <b>".$allRecords."</b> | Page : <b>".$page."</b>");
	?>
	</div>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">#</th>
				<th scope="col">Nom et Pr&eacute;nom</th>
				<th scope="col">Pseudo</th>
				<th scope="col">Unit&eacute;</th>
				<th scope="col">Etat</th>
				<th colspan="2">Actions</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">#</th>
				<th scope="col">Nom et Pr&eacute;nom</th>
				<th scope="col">Pseudo</th>
				<th scope="col">Unit&eacute;</th>
				<th scope="col">Etat</th>
				<th colspan="2">Actions</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detusers as $detuser): 
            
			$etat	= $detuser['state'];
			if ($etat=="ACTIF")
			{
				echo("<tr><td>".$detuser['id']."</td>");
				echo("<td>".$detuser['nom']." ".$detuser['prenom']."</td>");	
				echo("<td>".$detuser['pseudo']."</td>");
				echo("<td>".$detuser['unite']."</td>");		
				echo("<td>".$detuser['state']."</td>");	
				echo("<td><a href=\"usermod.php?ide=".$detuser['id']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-warning btn-circle shadow-sm\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a></td>"); 										
				echo("<td><a href=\"desacompte3.php?ide=".$detuser['id']."&choix=DESC&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-danger btn-circle shadow-sm\" title=\"Desctiver\"><i class=\"fas fa-lock\"></i></a></td>"); 										
			}
			if ($etat=="")
			{
				echo("<tr bgcolor=\"#00FFD0\"><td>".$detuser['id']."</td>");
				echo("<td>".$detuser['nom']." ".$detuser['prenom']."</td>");	
				echo("<td>".$detuser['pseudo']."</td>");
				echo("<td>".$detuser['unite']."</td>");		
				echo("<td>NOUVEAU</td>");	
				echo("<td><a href=\"usermod.php?ide=".$detuser['id']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-warning btn-circle shadow-sm\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a></td>"); 										
				echo("<td><a href=\"desacompte3.php?ide=".$detuser['id']."&choix=ACT&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Activer\"><i class=\"fas fa-unlock\"></i></a></td>"); 										
			}
			elseif ($etat=="INACTIF")
			{
				echo("<tr bgcolor=\"#FFDBC2\"><td>".$detuser['id']."</td>");
				echo("<td>".$detuser['nom']." ".$detuser['prenom']."</td>");	
				echo("<td>".$detuser['pseudo']."</td>");
				echo("<td>".$detuser['unite']."</td>");		
				echo("<td>".$detuser['state']."</td>");	
				echo("<td><a href=\"usermod.php?ide=".$detuser['id']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-warning btn-circle shadow-sm\" title=\"Modifier\"><i class=\"fa fa-edit\"></i></a></td>"); 										
				echo("<td><a href=\"desacompte3.php?ide=".$detuser['id']."&choix=ACT&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Activer\"><i class=\"fas fa-unlock\"></i></a></td>"); 										
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
			echo("<div class=\"alert alert-danger\">Aucun Utilisateur trouver avec ce mot cl&eacute;... </div>") ;	
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
		<?php echo("<a href=\"userfaticha.php?cle=".$cle."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>");?>
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