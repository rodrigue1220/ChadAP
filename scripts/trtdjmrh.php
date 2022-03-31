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
	
	//$nbra 	= $mysqli->query("SELECT COUNT(lv_id) AS nb FROM wfp_chd_rqdjoummah WHERE lv_statetrt!='TRAITE' AND lv_state!='ATTENTE' AND lv_state!='ATTENTERH' AND lv_state!='' ")->fetch_array();
	//$ntrt	= $nbra['nb'];
	$nbri 	= $mysqli->query("SELECT COUNT(lv_id) AS nb FROM wfp_chd_rqdjoummah WHERE lv_statetrt='TRAITE' ")->fetch_array();
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
  
	$detdjoummahs = $connection->query("SELECT j.lv_id, j.lv_nopers, j.lv_deb1, j.lv_rep, j.lv_type1, j.lv_type2, j.lv_type3, j.lv_type4, j.lv_state,  p.rh_lname, p.rh_fname, p.rh_duty, j.lv_dselfs 
									FROM wfp_chd_personnel p
									INNER JOIN wfp_chd_rqdjoummah j
									ON j.lv_nopers = p.rh_nopers
									WHERE lv_statetrt!='TRAITE' AND lv_state!='ATTENTE' AND lv_state!='ATTENTERH' AND lv_state!=''
									ORDER BY j.lv_id DESC
									LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(lv_id) AS id FROM wfp_chd_rqdjoummah WHERE lv_statetrt!='TRAITE' AND lv_state!='ATTENTE' AND lv_state!='ATTENTERH' AND lv_state!='' ")->fetchAll();
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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar-check"></i> Demandes de Cong&eacute;s pour Traitement</h1>
	 <a href="askleave.php" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-calendar fa-sm text-black-75"></i> Liste des Demandes Cong&eacute;s</a>				
	</div>
	<hr />
	
	<?php

		$exis = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_statetrt!='TRAITE' AND lv_state!='ATTENTE' AND lv_state!='ATTENTERH' AND lv_state!=''")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="trtdjmrh.php" method="get">
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
		echo ("Demandes NON Trait&eacute;es : <b>".$allRecords."</b> | Page : <b>".$page."</b>");
		echo(" | <a href=\"askleavetrt.php\">Demandes Trait&eacute;es : <strong>$trt</strong></a>");		
	?>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">N&deg;</th>
				<th scope="col">Index</th>
				<th scope="col">Nom & Pr&eacute;nom</th>
				<th scope="col">D&eacute;but</th>
				<th scope="col">Fin</th>
				<th scope="col">Reprise</th>
				<th scope="col">Type</th>
				<th scope="col">Etat</th>
				<th scope="col">Action RH</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">N&deg;</th>
				<th scope="col">Index</th>
				<th scope="col">Nom & Pr&eacute;nom</th>
				<th scope="col">D&eacute;but</th>
				<th scope="col">Fin</th>
				<th scope="col">Reprise</th>
				<th scope="col">Type</th>
				<th scope="col">Etat</th>
				<th scope="col">Action RH</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detdjoummahs as $detdjoummah): 
            
			$ident 	= $detdjoummah["lv_id"];
			$dselfs	= $detdjoummah["lv_dselfs"];
			$varf 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4, lv_dselfs) AS DMAX FROM wfp_chd_rqdjoummah WHERE lv_id='$ident' ")->fetch_array();		
			$fin	= $varf['DMAX'];
							
			if ($fin==$dselfs)
			{
				$fin = mktime(0,0,0,substr($fin,5,2),substr($fin,8,2)-1,substr($fin,0,4));
				$fin = date("Y-m-d",$fin);
			}
									
			$nopers = $detdjoummah['lv_nopers'];
			$sql1 = "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$nopers' " ;
			$requete1 = $mysqli->query( $sql1 ) ;
			$result1 = $requete1->fetch_assoc();
			$nom = $result1['rh_lname'];
			$pnom= $result1['rh_fname'];
		  ?>
			<tr>
                <td><?php echo $detdjoummah['lv_id']; ?></td>
				<td><?php echo $detdjoummah['lv_nopers']; ?></td>
				<td><?php echo $detdjoummah['rh_lname']." ".$detdjoummah['rh_fname']; ?></td>
                <td><?php echo date("d.m.Y",strtotime($detdjoummah['lv_deb1'])); ?></td>
                <td><?php echo date("d.m.Y",strtotime($fin)); ?></td>
				<td><?php echo date("d.m.Y",strtotime($detdjoummah['lv_rep'])); ?></td>
				<td>-<?php echo $detdjoummah['lv_type1']."-".$detdjoummah['lv_type2']."-".$detdjoummah['lv_type3']."-".$detdjoummah['lv_type4']; ?></td>
				<td><?php echo $detdjoummah['lv_state']; 
				echo("</td><td><a href=\"traitedjmrh.php?id=".$detdjoummah['lv_id']."&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Traiter\"><i class=\"fas fa-hourglass-1\"></i></a></td>"); ?>										
			</tr>
          <?php endforeach; ?>
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
			echo("<div class=\"alert alert-success\">Toutes les Demandes de Cong&eacute;s sont Trait&eacute;es... </div>") ;	
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
		<?php echo("<a href=\"trtdjmrh.php?&page=".$page."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
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