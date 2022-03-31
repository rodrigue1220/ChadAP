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
		header('Location:rechdjmrh.php');
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
  
	$detdjoummahs = $connection->query("SELECT * FROM wfp_chd_rqdjoummah 
									WHERE lv_nopers='$nopers' 
									ORDER BY lv_id DESC LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(lv_id) AS id FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers'  ")->fetchAll();
	$allRecords = $sql[0]['id'];

	// Calculate total pages
	$totoalPages = ceil($allRecords / $limit);

	// Prev + Next
	$prev = $page - 1;
	$next = $page + 1;
?>
<script src="http://10.109.87.10:8080/scripts/js/jquery-2.2.4.min.js"></script>
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

<style type="text/css"> .btn2{ width:130px; } </style>
<style type="text/css"> .btn3{ width:180px; } </style>
<link href="http://10.109.87.10:8080/scripts/inc/iz-modal.css" rel="stylesheet" type="text/css" />

<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calendar"></i> Demandes de Cong&eacute; | <font color="green"><i><?php echo $nopers;?></i></font></h1>
		<a href="askleave.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fas fa-calendar fa-sm text-black-75"></i> Demandes Cong&eacute;s</a>				
		<a href="rechdjmrh.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm"><i class="fas fa-search fa-sm text-black-75"></i> D&eacute;tailler Demande</a>
	</div>
	<hr />
	
	<?php

		$exis = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="rechdjmrh2.php" method="get">
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
                <th scope="col">N&deg; Demande</th>
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
				<th scope="col">N&deg; Demande</th>
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
			$dselfs	= $detdjoummah["lv_dselfs"];
			$varf 	= $mysqli->query("SELECT GREATEST(lv_fin1, lv_fin2, lv_fin3, lv_fin4, lv_dselfs) AS DMAX FROM wfp_chd_rqdjoummah WHERE lv_id='$ident' ")->fetch_array();		
			$fin	= $varf['DMAX'];
							
			if ($fin==$dselfs)
			{
				$fin = mktime(0,0,0,substr($fin,5,2),substr($fin,8,2)-1,substr($fin,0,4));
				$fin = date("Y-m-d",$fin);
			}
		  ?>
			<tr>
                <td><?php echo $detdjoummah['lv_id']; ?></td>
                <td><?php echo date("d.m.Y",strtotime($detdjoummah['lv_deb1'])); ?></td>
                <td><?php echo date("d.m.Y",strtotime($fin)); ?></td>
				<td><?php echo date("d.m.Y",strtotime($detdjoummah['lv_rep'])); ?></td>
				<td><?php echo $detdjoummah['lv_selfs']; ?></td>
				<td>-<?php echo $detdjoummah['lv_type1']."-".$detdjoummah['lv_type2']."-".$detdjoummah['lv_type3']."-".$detdjoummah['lv_type4']; ?></td>
			  
			  <?php
				if ($detdjoummah['lv_state']=="")
				{
					echo("<td bgcolor=\"#FF0000\" class=\"text-white\">INACHEVEE</td>");
					echo("<td><a href=\"supdjoummahdmdrh.php?id=".$detdjoummah['lv_id']."&nopers=".$detdjoummah['lv_nopers']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn-danger btn-circle btn-sm\" title=\"Supprimer\"><i class=\"fas fa-remove text-white\"></i></a></td>");
				}
				else
				{
					echo("<td>".$detdjoummah['lv_state']."</td>");
					echo("<td><a href=\"detdjoummahdmdrh.php?id=".$detdjoummah['lv_id']."&nopers=".$detdjoummah['lv_nopers']."&page=".$page."\" class=\"d-none d-sm-inline-block btn btn-sm btn-success btn-circle shadow-sm\" title=\"Detailler\"><i class=\"fas fa-list\"></i></a></td>"); 										
				}
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
			echo("<div class=\"alert alert-info\">Aucune demande de Cong&eacute; Enregistrée avec cet Index... </div>") ;	
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
		<?php echo("<a href=\"rechdjmrh2.php?nopers=".$nopers."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
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
