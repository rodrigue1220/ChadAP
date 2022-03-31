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
	
	if ($_GET["nopers"] == "")
	{
		header('Location:rechctorh.php');
	}	
	
	$nopers	= $_GET["nopers"];
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
  
	$detdjoummahctos = $connection->query("SELECT * FROM wfp_chd_djmcto 
									WHERE cto_index='$nopers' 
									ORDER BY cto_id DESC LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(cto_id) AS id FROM wfp_chd_djmcto WHERE cto_index='$nopers'  ")->fetchAll();
	$allRecords = $sql[0]['id'];

	// Calculate total pages
	$totoalPages = ceil($allRecords / $limit);

	// Prev + Next
	$prev = $page - 1;
	$next = $page + 1;
?>
<style type="text/css"> .btn2{ width:130px; } </style>
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar"></i> Demandes HS | <font color="green"><i><?php echo $nopers;?></i></font></h1>
		<a href="askcto.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-calendar fa-sm text-black-75"></i> Demandes HS</a>				
		<a href="rechctorh.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-search fa-sm text-black-75"></i> D&eacute;tailler Demande</a>
	</div>
	<hr />
	
	<?php

		$exis = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_index='$nopers' ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="rechctorh2.php" method="get">
			<input type="hidden" id="nopers" name="nopers" value="<?php echo $nopers; ?>" />
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
		echo ("Total Enregistrements : <b>".$allRecords."</b> | Page : <b>".$page."</b>");		
	?>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">N&deg;</th>
				<th scope="col">Soumis le</th>
				<th scope="col">Date pr&eacute;vue</th>
				<th scope="col">Heure d&eacute;but E/T</th>
				<th scope="col">Heure fin E/T</th>
				<th scope="col">Dur&eacute;e</th>
				<th scope="col">Type</th>
				<th scope="col">Statut</th>
				<th scope="col"></th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
				<th scope="col">N&deg;</th>
				<th scope="col">Soumis le</th>
				<th scope="col">Date pr&eacute;vue</th>
				<th scope="col">Heure d&eacute;but E/T</th>
				<th scope="col">Heure fin E/T</th>
				<th scope="col">Dur&eacute;e</th>
				<th scope="col">Type</th>
				<th scope="col">Statut</th>
				<th scope="col"></th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detdjoummahctos as $detdjoummahcto): 
            
			$h1=strtotime($detdjoummahcto['cto_hfin']);
			$h2=strtotime($detdjoummahcto['cto_hdeb']);
			$dure = gmdate('H:i:s',$h1-$h2);
									
			echo("<tr><td>".$detdjoummahcto['cto_id']."</td>");
			echo("<td>".date("d.m.Y H:m:s",strtotime($detdjoummahcto['cto_date']))."</td>");
			
			if ($detdjoummahcto['cto_statut']=="CERTIFIE")
			{
				echo("<td bgcolor=\"#AAE144\">".date("d.m.Y",strtotime($detdjoummahcto['cto_deb2']))."</td>");
				echo("<td bgcolor=\"#AAE144\">".$detdjoummahcto['cto_hdeb2']."</td>");	
				echo("<td bgcolor=\"#AAE144\">".$detdjoummahcto['cto_hfin2']."</td>");
				echo("<td bgcolor=\"#AAE144\">".$detdjoummahcto['cto_dure']."</td>");
				echo("<td bgcolor=\"#AAE144\">".$detdjoummahcto['cto_choix']."</td>");
				echo("<td bgcolor=\"#AAE144\">".$detdjoummahcto['cto_statut']."</td>");
			}
			else
			{
				echo("<td>".date("d.m.Y",strtotime($detdjoummahcto['cto_deb']))."</td>");
				echo("<td>".$detdjoummahcto['cto_hdeb']."</td>");	
				echo("<td>".$detdjoummahcto['cto_hfin']."</td>");
				echo("<td>".$dure."</td>");
				echo("<td>".$detdjoummahcto['cto_choix']."</td>");
				echo("<td>".$detdjoummahcto['cto_statut']."</td>");
			}
		   echo("<td><a href=\"detctorh.php?id=".$detdjoummahcto['cto_id']."\" class=\"d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Detailler\"><i class=\"fas fa-list\"></i></a></td>");
			
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
                   href="<?php if($page <= 1){ echo '#'; } else { echo "?nopers=".$nopers."&page=" . $prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
            </li>

            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?nopers=".$nopers."&page=". $next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
            </li>
        </ul>
    </nav>
	
	<?php
		}
		else
		{
			echo("<div class=\"alert alert-info\">Aucune demande d'heures suppl&eacute;mentaires Enregistrée avec cet Index... </div>") ;	
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