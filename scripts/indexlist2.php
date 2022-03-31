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
	
	if ($pseudo != "zimbos" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
	include("inc/headers.php");
	
	  // Database
  include('db.php');
  
  // Set session
  //session_start();
  if(isset($_POST['records-limit'])){
      $_SESSION['records-limit'] = $_POST['records-limit'];
  }
  
  $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
  $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
  $paginationStart = ($page - 1) * $limit;
  $authors = $connection->query("SELECT * FROM user WHERE pseudo!='administrateur' AND state!='INACTIF' ORDER BY nom ASC LIMIT $paginationStart, $limit")->fetchAll();

  // Get total records
  $sql = $connection->query("SELECT count(id) AS id FROM user")->fetchAll();
  $allRecrods = $sql[0]['id'];
  
  // Calculate total pages
  $totoalPages = ceil($allRecrods / $limit);

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
      <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-list-alt"></i> Liste Index</h1>
	  <a href="assindex.php" class="d-none d-sm-inline-block btn btn3 btn-sm btn-info shadow-sm"><i class="fa fa-asterisk fa-sm text-black-75"></i> Assigner Index</a>				     
	</div>
	<hr />   
    
	<!-- Select dropdown -->
        <div class="d-flex flex-row-reverse bd-highlight mb-3">
            <form action="indexlist2.php" method="post">
                <select name="records-limit" id="records-limit" class="custom-select">
                    <option disabled selected>Records Limit</option>
                    <?php foreach([5,10,15,20] as $limit) : ?>
                    <option
                        <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                        value="<?= $limit; ?>">
                        <?= $limit; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
<?php echo 'Total :'.$allRecrods; ?>
        <!-- Datatable -->
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Unite</th>
                    <th scope="col">Index</th>
					<th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($authors as $author): ?>
                <tr>
                    <th scope="row"><?php echo $author['id']; ?></th>
                    <td><?php echo $author['nom']; ?></td>
                    <td><?php echo $author['prenom']; ?></td>
                    <td><?php echo $author['unite']; ?></td>
                    <td><?php echo $author['indexid']; ?></td>
					<?php echo("<td><a href=\"indexmod.php?ide=".$author['id']."\" data-toggle=\"modal\" data-target=\"#confirmModal\" class=\"confirmModalLink btn btn-warning btn-sm d-sm-inline-block\" title=\"MODIFIER\"><i class=\"fa fa-edit\"></i></a></td>"); ?>
				
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
		
		<!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-right">

                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link btn2"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>"><i class="fas fa-fw fa-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
                </li>
				
				<?php for($i = $page+1; $i <= $page+4; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="indexlist2.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link btn2"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>"><i class="fas fa-fw fa-arrow-right"></i> Suivant</a>
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
		<a href="indexlist2.php" class="btn btn-danger" id="confirmModalNo">Non</a>
		<a href="#" class="btn btn-info" id="confirmModalYes">Oui</a>
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
