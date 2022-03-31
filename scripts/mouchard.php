<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	
	if ($pseudo != "administrateur")
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
	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">
 <!-- jQuery -->
<script src="js/jquery-latest.min.js"></script>
<script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>		
	<style type="text/css"> .sidebar{ height:1000px; } </style>

<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "serverhis_processing.php"	
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
				<li>&copy; WFP CHAD v1.0.IZ</li>
                <?php echo("<li><a href=\"modif1user.php?ide=".$pseudo."\"><i class=\"fa fa-user fa-fw\"></i>".$pseudo." </a>");?>
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </ul>

	<?php
		include("inc/botoune.php");
		//include("exportaskleave.php");
	?>
	<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<style type="text/css"> .btn{ width:180px; } </style>
					<h1 class="page-header">

						Mouchard d'Activit&eacute;s
                    </h1><br /><br />
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               <div class="col-lg-12">
				<table id="example" class="display" style="align-content:center">
					<thead>
						<tr>
							<th>Utilisateurs</th>
							<th>Agents</th>
							<th>Fichiers</th>
							<!--th>Pr&eacute;nom</th-->
							<th>Dates</th>
							<th>Actions</th>
							<th>D&eacute;tails</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Utilisateurs</th>
							<th>Agents</th>
							<th>Fichiers</th>
							<!--th>Pr&eacute;nom</th-->
							<th>Dates</th>
							<th>Actions</th>
							<th>D&eacute;tails</th>
						</tr>
					</tfoot>
				</table>
			  </div>  
            </div>
            <!-- /.row -->
		</div>
        <!-- /#page-wrapper -->

<?php
	include("inc/ridjilene.php");
?>