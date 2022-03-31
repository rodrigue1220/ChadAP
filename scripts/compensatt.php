<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	include("inc/taarikh.php");
	include('inc/headers.php');
	
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

	$detdjmctos = $connection->query("SELECT * FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' ORDER BY cto_id DESC LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(cto_id) AS id FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' ")->fetchAll();
	$allRecrods = $sql[0]['id'];
  
  
	// Calculate total pages
	$totoalPages = ceil($allRecrods / $limit);

	// Prev + Next
	$prev = $page - 1;
	$next = $page + 1;
?>
<style type="text/css"> .btn3{ width:180px; } </style>
<style type="text/css"> .btn2{ width:130px; } </style>

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tasks"></i> Mes Demandes HS</h1>
	  <a href="compenscto.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-reply fa-sm text-black-75"></i> Retour</a>				     
	</div>
	<hr />

	<?php

		$exis = $mysqli->query("SELECT cto_id AS ID FROM wfp_chd_djmcto WHERE cto_dem='$pseudo' ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="compensatt.php" method="get">
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
    
	<?php echo ("Total Enregistrements : <b>".$allRecrods."</b> | Page : <b>".$page."</b>"); ?>
	
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
				<th scope="col">Date A/C</th>
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
				<th scope="col">Date A/C</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detdjmctos as $detdjmcto): ?>
            <tr>
				<?php 
					$h1		= strtotime($detdjmcto['cto_hfin']);
					$h2		= strtotime($detdjmcto['cto_hdeb']);
					$dure 	= gmdate('H:i:s',$h1-$h2);
					
					$h12	= strtotime($detdjmcto['cto_hfin2']);
					$h22	= strtotime($detdjmcto['cto_hdeb2']);
					$dure2 	= gmdate('H:i:s',$h12-$h22);
				?>
                <td><?php echo $detdjmcto['cto_id']; ?></td>
                <td><?php echo $detdjmcto['cto_date']; ?></td>
				<?php
				
					if ($detdjmcto['cto_statut']=="CERTIFIE")
					{
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_deb2']."</td>");
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_hdeb2']."</td>");	
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_hfin2']."</td>");
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_dure']."</td>");
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_choix']."</td>");
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_statut']."</td>");
						echo("<td bgcolor=\"#AAE144\">".$detdjmcto['cto_dapprover2']."</td>");
					}
					else if ($detdjmcto['cto_statut']=="EFFECTUE")
					{
						echo("<td>".$detdjmcto['cto_deb2']."</td>");
						echo("<td>".$detdjmcto['cto_hdeb2']."</td>");	
						echo("<td>".$detdjmcto['cto_hfin2']."</td>");
						echo("<td>".$dure2."</td>");
						echo("<td>".$detdjmcto['cto_choix']."</td>");
						echo("<td>".$detdjmcto['cto_statut']."</td>");
						echo("<td>".$detdjmcto['cto_dapprover2']."</td>");
					}
					else
					{
						echo("<td>".$detdjmcto['cto_deb']."</td>");
						echo("<td>".$detdjmcto['cto_hdeb']."</td>");	
						echo("<td>".$detdjmcto['cto_hfin']."</td>");
						echo("<td>".$dure."</td>");
						echo("<td>".$detdjmcto['cto_choix']."</td>");
						echo("<td>".$detdjmcto['cto_statut']."</td>");
						echo("<td>".$detdjmcto['cto_dapprover']."</td>");
					}
				?>
			</tr>
        <?php endforeach;?>
		
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
			echo("<div class=\"alert alert-danger\">Vous n'avez aucune demande d'heures suppl&eacute;mentaires Enregistrée... </div>") ;	
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