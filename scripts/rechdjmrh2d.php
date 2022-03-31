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
	
	if ($_GET["datdeb"] == "" || $_GET["datfin"] == "" || $_GET["datdeb"] == "1970-01-01" || $_GET["datfin"] == "1970-01-01" )
	{
		header('Location:rechdjmrh.php');
	}	
	
	$date2= $_GET["datfin"];
	$date1= $_GET["datdeb"];
	
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
  
	$detdjoummahs = $connection->query("SELECT * FROM wfp_chd_rqdjoummah 
									WHERE lv_deb1>='$date1' AND lv_deb1<='$date2' 
									ORDER BY lv_id DESC LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(lv_id) AS id FROM wfp_chd_rqdjoummah WHERE lv_deb1>='$date1' AND lv_deb1<='$date2'  ")->fetchAll();
	$allRecords = $sql[0]['id'];

	// Calculate total pages
	$totoalPages = ceil($allRecords / $limit);

	// Prev + Next
	$prev = $page - 1;
	$next = $page + 1;
?>

<style type="text/css"> .btn3{ width:160px; } </style>
<style type="text/css"> .btn2{ width:130px; } </style>
<link href="inc/iz-modal.css" rel="stylesheet" type="text/css" />

<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar"></i> Demandes de Cong&eacute;s | <font color="green"><i><?php echo date("d.m.Y",strtotime($_GET["datdeb"]));?></i></font> - <font color="green"><i><?php echo date("d.m.Y",strtotime($_GET["datfin"]));?></i></font></h1>
		<a href="askleave.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-calendar fa-sm text-black-75"></i> Demandes Cong&eacute;s</a>				
		<a href="rechdjmrh.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-search fa-sm text-black-75"></i> D&eacute;tailler Demande</a>
	</div>
	<hr />
	
	<?php

		$exis = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_deb1>='$date1' AND lv_deb1<='$date2' ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="rechdjmrh2d.php" method="get">
			<input type="hidden" id="datefin" name="datefin" value="<?php echo $date2; ?>" />
			<input type="hidden" id="datedeb" name="datedeb" value="<?php echo $date1; ?>" />
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
				<th scope="col">Demandeur</th>
				<th scope="col">D&eacute;but</th>
				<th scope="col">Fin</th>
				<th scope="col">Reprise</th>
				<th scope="col">W-S-S</th>
				<th scope="col">Type(s)</th>
				<th scope="col">Statut</th>
				<th scope="col"></th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
				<th scope="col">N&deg;</th>
				<th scope="col">Demandeur</th>
				<th scope="col">D&eacute;but</th>
				<th scope="col">Fin</th>
				<th scope="col">Reprise</th>
				<th scope="col">W-S-S</th>
				<th scope="col">Type(s)</th>
				<th scope="col">Statut</th>
				<th scope="col"></th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detdjoummahs as $detdjoummah): 
            
			$ident 	= $detdjoummah["lv_id"];
			$nopers	= $detdjoummah["lv_nopers"];
			$dselfs	= $detdjoummah["lv_dselfs"];
			$varf 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4, lv_dselfs) AS DMAX FROM wfp_chd_rqdjoummah WHERE lv_id='$ident' ")->fetch_array();		
			$fin	= $varf['DMAX'];
							
			if ($fin==$dselfs)
			{
				$fin = mktime(0,0,0,substr($fin,5,2),substr($fin,8,2)-1,substr($fin,0,4));
				$fin = date("Y-m-d",$fin);
			}
			
			$sqlt 		= "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$nopers' " ;
			$requetet	= $mysqli->query( $sqlt );
			$resultt	= $requetet->fetch_assoc();
			$nom		= $resultt["rh_lname"];
			$pnom 	= $resultt["rh_fname"];
		  ?>
			<tr>
                <td><?php echo $detdjoummah['lv_id']; ?></td>
				<td><?php echo $nom." ".$pnom; ?></td>
                <td><?php echo date("d.m.Y",strtotime($detdjoummah['lv_deb1'])); ?></td>
                <td><?php echo date("d.m.Y",strtotime($fin)); ?></td>
				<td><?php echo date("d.m.Y",strtotime($detdjoummah['lv_rep'])); ?></td>
				<td><?php echo $detdjoummah['lv_selfs']; ?></td>
				<td>-<?php echo $detdjoummah['lv_type1']."-".$detdjoummah['lv_type2']."-".$detdjoummah['lv_type3']."-".$detdjoummah['lv_type4']; ?></td>
				<td><?php echo $detdjoummah['lv_state']; 
				echo("</td><td><a href=\"detdjoummahdmdrh.php?id=".$detdjoummah['lv_id']."&nopers=".$detdjoummah['lv_nopers']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Detailler\"><i class=\"fas fa-list\"></i></a></td>"); ?>										
			</tr>
          <?php endforeach; ?>
        </tbody>
    </table>
	
	<!-- Pagination -->
    <nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page <= 1){ echo '#'; } else { echo "?datdeb=".$date1."&datfin=".$date2."&page=" . $prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
            </li>

            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?datdeb=".$date1."&datfin=".$date2."&page=". $next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
            </li>
        </ul>
    </nav>
	
	<?php
		}
		else
		{
			echo("<div class=\"alert alert-info\">Aucune demande de Cong&eacute; Enregistrée durant ces deux dates... </div>") ;	
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
