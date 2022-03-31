<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	$cle = $_GET["cle"];
	$nb  = $_GET["nb"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="5; URL=gestgourouss.php" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="@IZ">
  <link rel="shortcut icon" href="../img/WFPico.ico" />

  <title>Chad AP v1.1</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/fontawesome-free/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="../vendor/font-awesome/css/css.css" rel="stylesheet" type="text/css" />
  
  <!-- Custom styles for this template-->
  <link href="../css/iz-admin-2.min.css" rel="stylesheet">
  
  <script type="text/javascript" src="../DataTables/media/js/jquery.js"></script>
  <script type="text/javascript" src="../DataTables/media/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../DataTables/media/css/jquery.dataTables.min.css">

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" >

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      
    </ul>
    <!-- End of Sidebar -->
<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
			<img src="../img/WFP-0000015014.png" width="225" height="80" alt="Logo WFP">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
		  
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

		  </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
		  <center>
			<?php
				if ($cle=="NON")
				{
					echo("<img src=\"../img/oops.jpg\" alt=\"Erreur\">
					<br /><br /><div class=\"alert alert-danger\"><strong>Sorry!!!<br />... Probl&egrave;me lors de l\'importation des donn&eacute;es CSV</strong></div>");
				}
				else if ($cle=="OUI")
				{
					echo("<img src=\"../img/super.jpg\" alt=\"Felicitations\">
					<br /><br /><div class=\"alert alert-success\"><strong>F&eacute;licitations!!!<br />... Les Donn&eacute;es sont import&eacute;es dans la base de donn&eacute;es <br />
					Nombre de ligne: ".$nb."</strong></div>");
				}
			?>
		  </center>
		</div>
        <!-- /.container-fluid -->	
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

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
