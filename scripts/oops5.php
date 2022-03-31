<?php
	require('ctrl.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="refresh" content="10; URL=add1ask.php" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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

  
            <!-- /.navbar-top-links -->

      
        </nav>
		<div id="page-wrapper">
		<br /><br /><br /><br /><br />
		<div class="panel-body"> 
                            <div id="morris-area-chart">
			<center>
				<img src="../img/sorry.jpg" alt="Sorry">
				<br /><br /><div class="alert alert-danger"><strong>D&eacute;sol&eacute; votre demande ne peut pas &ecirc;tre enregistr&eacute;e...<br />Veuillez saisir un bon format de Date!!!<br />aaaa-mm-jj</strong></div></center> 
		</div>
                        </div>
		</div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

	
	<!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
	

    
</body>

</html>
