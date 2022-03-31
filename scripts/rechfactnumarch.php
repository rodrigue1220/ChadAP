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
		header('Location:gouroussphone.php');
	}
	
	$telephone= $_GET["num"];
	
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
  
	$detusers = $connection->query("SELECT * FROM wfp_chd_recapbil 
									WHERE rec_phone='$telephone' AND (rec_mois LIKE '%18' OR rec_mois LIKE '%19') AND rec_status!='ANNULE'
									ORDER BY rec_id DESC
									LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(rec_id) AS id FROM wfp_chd_recapbil WHERE rec_phone='$telephone' AND (rec_mois LIKE '%18' OR rec_mois LIKE '%19') AND rec_status!='ANNULE' ")->fetchAll();
	$allRecords = $sql[0]['id'];
	
	$sql2 = $connection->query("SELECT COUNT(rec_id) AS id FROM wfp_chd_recapbil WHERE rec_mois LIKE '%2%' AND rec_phone='$telephone' AND rec_status!='ANNULE' ")->fetchAll();
	$allRecords2 = $sql2[0]['id'];

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
	  <?php 
		/*echo("<a href=\"factchardet.php?tel=".$telephone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm\" title=\"Détails des Identifications\"><i class=\"fas fa-list fa-sm text-white-75\"></i> D&eacute;tails Identifications</a>");
		echo("<a href=\"factchar_archv.php?tel=".$telephone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-secondary shadow-sm\" title=\"Archives des détails\"><i class=\"fas fa-archive fa-sm text-white-75\"></i> Archives</a>");
	  */?>
	</div>
	<hr />   
    
	<?php

		$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_phone='$telephone' AND (rec_mois LIKE '%18' OR rec_mois LIKE '%19') AND rec_status!='ANNULE' ")->fetch_array();	  
		if($exis['ID'] != 0)
		{	
	
	?>
  
	<!-- Select dropdown -->
	<div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="rechfactnumarch.php" method="get">
			<input type="hidden" id="num" name="num" value="<?php echo $telephone; ?>" />
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
    
	<div class="alert alert-primary">
	<?php 
		echo ("Facture (s) T&eacute;l&eacute;phonique | Num&eacute;ro: <font color=\"#FF0000\">$telephone</font> : <b>".$allRecords."</b> | Page : <b>".$page."</b> | <a href=\"rechfactnum.php?num=".$telephone."\"><b>NEW : ".$allRecords2."</b></a>");
	?>
	</div>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">#</th>
				<th scope="col">Mois</th>
				<th scope="col">Officiels</th>
				<th scope="col">Priv&eacute;s</th>
				<th scope="col">Officiel (FCFA)</th>
				<th scope="col">Priv&eacute; (FCFA)</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">#</th>
				<th scope="col">Mois</th>
				<th scope="col">Officiels</th>
				<th scope="col">Priv&eacute;s</th>
				<th scope="col">Officiel (FCFA)</th>
				<th scope="col">Priv&eacute; (FCFA)</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detusers as $detuser): 
            
			echo("<tr><td>".$detuser['rec_id']."</td>");
			echo("<td>".$detuser['rec_mois']."</td>");	
			echo("<td>".$detuser['rec_offtot']."</td>");
			echo("<td>".$detuser['rec_privtot']."</td>");		
			echo("<td>".$detuser['rec_totoff']."</td>");	
			echo("<td>".$detuser['rec_totpriv']."</td>");
			
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
                   href="<?php if($page <= 1){ echo '#'; } else { echo "?num=".$telephone."&page=".$prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
            </li>

            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-success"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?num=".$telephone."&page=".$next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
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