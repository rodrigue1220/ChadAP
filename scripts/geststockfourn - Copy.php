<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
		
	if ($profil != "AdminFOURN")
	{
		header('Location:simple.php');
	}
	
	include("inc/taarikh.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--meta http-equiv="refresh" content="20" /-->
    <meta name="viewport" content="width=device-width/viewport, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="@IZ">

    <title>Chad AP v1.0</title>

	<link rel="shortcut icon" href="../img/WFPico.ico" />
	
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script type="text/javascript" src="DataTables/media/js/jquery.js"></script>

    <script type="text/javascript" src="DataTables/media/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables/media/css/jquery.dataTables.min.css">

<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "serverfourn_processing.php"	
		} );	
	} );		
</script>	
	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
			
            <div class="navbar-header">
				<div class="container-fluid">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="index.html">SB Admin v2.0</a> -->
				<img src="../img/WFP-0000014687.png" width="195" height="80" class="img-rounded" alt="Logo WFP"> 
				</div>
			</div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				<!--img src="../img/beta.png" width="80" height="80" class="img-rounded" alt="&copy; WFP CHAD v1.0.IZ"--> 
				<a class="navbar-brand" href="#">&copy; WFP Chad Automation Project v1.0.IZ</a>
                <?php echo("<li><a href=\"modif1user.php?ide=".$pseudo."\"><i class=\"fa fa-user fa-fw\"></i>".$pseudo." </a>");?>
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </ul>
            <!-- /.navbar-top-links -->	
	<?php
		include("inc/botoune.php");
	?>
	<br /><br /><br />
		<style type="text/css"> .btn2{ width:160px; } </style>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<h1 class="page-header">

						<div align="right">
							<button type="button" class="btn btn2 btn-warning" onclick="document.location='stockvarfourn.php'" title="ENTREES / SORTIES STOCK"><i class="fa fa-sign-in" fa-fw></i> Variations Stock <i class="fa fa-sign-out" fa-fw></i></button>
							<button type="button" class="btn btn2 btn-primary" onclick="document.location='stockaddfourn.php'" title="ENTREE STOCK"><i class="fa fa-sign-in" fa-fw></i> Entr&eacute;es</button>
							<button type="button" class="btn btn2 btn-info" onclick="document.location='stocksortfourn.php'" title="SORTIE STOCK"><i class="fa fa-sign-out" fa-fw></i> Sorties</button>
							<button type="button" class="btn btn2 btn-success" onclick="document.location='listdemfourn.php'" title="Liste des demandes de fourniture"><i class="fa fa-pencil-square" fa-fw></i> Demandes</button>
						</div><br />
						Stock Disponible
                    </h1><br /><br />
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               <div class="col-lg-10">
				<table id="example" class="display" style="align-content:center">
					<thead>
						<tr>
							<th>Item Description</th>
							<th>Nombre</th>
							<th>Remarques</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Item Description</th>
							<th>Nombre</th>
							<th>Remarques</th>
						</tr>
					</tfoot>
				</table>
			  </div>  
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

