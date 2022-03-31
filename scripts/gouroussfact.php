<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$phone	= $_GET["tel"];
	$mois	= $_GET["chahar"];
	$opt	= $_GET["opt"];
	
	$numero	= $mysqli->query("SELECT tel AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phone2	= $numero["num"];
	
	$numer2	= $mysqli->query("SELECT tel2 AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phon2	= $numer2["num"];
	
	if (($phone2 != $phone) && ($phon2 != $phone))
	{
		header('Location:gouroussphone.php');
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
  
  if ($opt=="archv")
  {
	$detcalls = $connection->query("SELECT * FROM wfp_chd_bilpp_archv WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND STATE='ATTENTE' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') ORDER BY CALLED_NO LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(ID) AS id FROM wfp_chd_bilpp_archv WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND STATE='ATTENTE' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699')")->fetchAll();
	$allRecrods = $sql[0]['id'];
  }
  
  else 
  {
	$detcalls = $connection->query("SELECT * FROM wfp_chd_bilpp WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND STATE='ATTENTE' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') ORDER BY CALLED_NO LIMIT $paginationStart, $limit")->fetchAll();
	
	// Get total records
	$sql = $connection->query("SELECT COUNT(ID) AS id FROM wfp_chd_bilpp WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND STATE='ATTENTE' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699')")->fetchAll();
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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-thumb-tack"></i> Identification des Appels T&eacute;l&eacute;phoniques et SMS</h1>
	  <?php
		echo("<a href=\"gouroussfactall.php?opt=".$opt."&chahar=".$mois."&tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-success shadow-sm\" title=\"TOUT PRIVE\"><i class=\"fa fa-check-square fa-sm text-white-75\"></i> TOUT SELECTIONNER</a>");
		echo("<a href=\"gouroussfactfin.php?opt=".$opt."&chahar=".$mois."&tel=".$phone."\" class=\"d-none d-sm-inline-block btn btn3 btn-sm btn-danger shadow-sm\" title=\"TERMINER\"><i class=\"fa fa-times-circle fa-sm text-white-75\"></i> TERMINER</a>");
	  ?>
	</div>
	<hr />   
    
	<div class="alert alert-danger" size="-2">Cliquez sur le bouton PRIVE UNIQUEMENT s'il s'agit d'un appel ou SMS Priv&eacute;</div>
	
	<!-- Select dropdown -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <form action="gouroussfact.php" method="get">
			<input type="hidden" id="tel" name="tel" value="<?php echo $phone; ?>" />
			<input type="hidden" id="chahar" name="chahar" value="<?php echo $mois; ?>" />
			<input type="hidden" id="opt" name="opt" value="<?php echo $opt; ?>" />
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
    
	<?php echo ("Total Enregistrements : <b>".$allRecrods."</b> | Page : <b>".$page."</b>"); ?>
	
	<!-- Datatable -->
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-primary">
                <th scope="col">Action</th>
				<th scope="col">Contact</th>
				<th scope="col">Date et Heure</th>
				<th scope="col">Dur&eacute;e (s)</th>
				<th scope="col">Type</th>
				<th scope="col">Terminaison</th>
				<th scope="col">Montant (FCFA)</th>
            </tr>
        </thead>
		<tfoot>
            <tr class="table-primary">
                <th scope="col">Action</th>
				<th scope="col">Contact</th>
				<th scope="col">Date et Heure</th>
				<th scope="col">Dur&eacute;e (s)</th>
				<th scope="col">Type</th>
				<th scope="col">Terminaison</th>
				<th scope="col">Montant (FCFA)</th>
            </tr>
        </tfoot>
		<tbody>
		  <?php foreach($detcalls as $detcall): ?>
            <tr>
				<?php 
					if ($opt=="archv")
					{
						echo("<td><a href=\"gouroussfactiden.php?cle=".$detcall['ID']."&opt=archv&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-success shadow-sm\" title=\"Identifier\">PRIVE</a></td>");
					}
					else
					{
						echo("<td><a href=\"gouroussfactiden.php?cle=".$detcall['ID']."&opt=new&page=".$page."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink d-none d-sm-inline-block btn btn-sm btn-success shadow-sm\" title=\"Identifier\">PRIVE</a></td>");
					}
				?>
                <td><?php echo $detcall['CALLED_NO']; ?></td>
                <td><?php echo $detcall['START_TIME']; ?></td>
                <td><?php echo $detcall['CALL_DURATION']; ?></td>
                <td><?php echo $detcall['ORIGINAL_CALL_TYPE']; ?></td>
                <td><?php echo $detcall['TERMINATING_COUNTRY']; ?></td>
				<td><?php echo $detcall['CHARGABLE_AMOUNT']; ?></td>
			</tr>
          <?php endforeach; ?>
        </tbody>
    </table>
	
	<!-- Pagination -->
    <nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page <= 1){ echo '#'; } else { echo "?chahar=".$mois."&tel=".$phone."&opt=".$opt."&page=" . $prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
            </li>

            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link btn2 btn-primary"
                   href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?chahar=".$mois."&tel=".$phone."&opt=".$opt."&page=". $next; } ?>"> Suivant <i class="fas fa-fw fa-arrow-right"></i></a>
            </li>
        </ul>
    </nav>
		
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
		<?php echo("<a href=\"gouroussfact.php?chahar=".$mois."&tel=".$phone."&opt=".$opt."\" class=\"btn btn-danger\" id=\"confirmModalNo\">Non</a>"); ?>
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

  <!-- Page level plugins -->
  <script src="http://10.109.87.10:8080/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="http://10.109.87.10:8080/js/demo/chart-area-demo.js"></script>
  <script src="http://10.109.87.10:8080/js/demo/chart-pie-demo.js"></script>
  
	<script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
        });
	</script>

</body>

</html>