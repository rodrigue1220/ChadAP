<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
    session_start(); // ici on continue la session
    if ((!isset($_SESSION['session'])) || ($_SESSION['session'] == ""))
    {
    // La variable $_SESSION['login'] n'existe pas, ou bien elle est vide
    // <=> la personne ne s'est PAS connectée
?>
	
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="@IZ">
  <link rel="shortcut icon" href="../img/WFPico.ico" />

  <title>Chad AP v1.1 - Session Expired</title>

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
  <style type="text/css"> .btn3{ width:180px; } </style>
  
</head>

<body id="page-top">

    <!-- Page Wrapper -->
  <div id="wrapper" >

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
     <img src="../img/WFP-0000014687.png" width="225" height="90" alt="Logo WFP">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
			ChadAP v1.1.IZ &copy; WFP CO CHAD, 2020</strong>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
		  
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
			 <a class="nav-link" href="../index.php">
				<i class="fas fa-fw fa-sign-in-alt"></i>
				<span>Log in</span>
			 </a>
		  </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <img src="../img/session_expired.jpg" alt="Session Expir&eacute;e"> 
            
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

<?php
    exit();
  }
?>
	