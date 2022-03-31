<?php
require_once('ctrl.php');
require_once('config.php');
require_once('verifications.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chad AP v1.0 | Demande Transport</title>

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

	<img src="../img/newfpheader.png" width="800"> 			
	<br /><br /><br />
		
	<div class="col-xs-12">
        <center><h1 class="page-header">DEMANDE DE TRANSPORT</h1>
    </div>
		
	<div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
				<div class="panel-heading">
                    D&eacute;tails passager (s)
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">			
						<?php
							include('connexion.php');
							$id=$_GET["id"];
								
							$sql = "SELECT * FROM wfp_chd_request WHERE reqst_id='$id'" ;
							$requete = $mysqli->query( $sql ) ;
							$result = $requete->fetch_assoc();
							
							$nprenom = $result['reqst_nom'];
							
							$sql2 = "SELECT * FROM user WHERE pseudo='$nprenom' OR nom LIKE '%$nprenom%' OR prenom LIKE '%$nprenom%' " ;
							$requete2 = $mysqli->query( $sql2 ) ;
							$result2 = $requete2->fetch_assoc();
									
							echo("<table class=\"table table-striped table-bordered table-hover\">
								<tbody>
									<tr><th>Demandeur</th><td>".$result2['nom']." ".$result2['prenom']."</td></tr>
									<tr><th>Passager (s)</th><td>".$result['reqst_passag']."</td></tr>
								</tbody>");

							echo("</table>");
						?>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
			<!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    D&eacute;tails driver
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">                         
						<?php
							include('connexion.php');
							$id=$_GET["id"];
								
							$sql = "SELECT * FROM wfp_chd_request WHERE reqst_id='$id'" ;
							$requete = $mysqli->query( $sql ) ;
							$result = $requete->fetch_assoc();
								
							echo("<table class=\"table table-striped table-bordered table-hover\">
								<tbody>
									<tr><th>Chauffeur</th><td>".$result['reqst_chauf']."</td></tr>
									<tr><th>Mobile</th><td>".$result['reqst_vehicle']."</td></tr>
								</tbody>");
							echo("</table>");
						?>	
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
	<div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
				<div class="panel-heading">
                    D&eacute;tails transport
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">			
						<?php
							include('connexion.php');
							$id=$_GET["id"];
								
							$sql = "SELECT * FROM wfp_chd_request WHERE reqst_id='$id'" ;
							$requete = $mysqli->query( $sql ) ;
							$result = $requete->fetch_assoc();
									
							echo("<table class=\"table table-striped table-bordered table-hover\">
								<tbody>
									<tr><th colspan=\"2\">Motif</th><td colspan=\"2\">".$result['reqst_motif']."</td></tr>
									<tr><th colspan=\"2\">Destination</th><td colspan=\"2\">".$result['reqst_dest']."</td></tr>
									<tr><th>Du</th><td>".$result['reqst_dep']."</td><th>Au</th><td>".$result['reqst_ret']."</td></tr>
									<tr><th>De</th><td>".$result['reqst_heurd']."h ".$result['reqst_mind']."mn</td><th>A</th><td>".$result['reqst_heurr']."h ".$result['reqst_heurr']."mn</td></tr>
								</tbody>");

							echo("</table>");
						?>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
			<!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
	
	<div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
				<div class="panel-heading">
                    Approbation
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">			
						<?php
							include('connexion.php');
							$id=$_GET["id"];
								
							$sql = "SELECT * FROM wfp_chd_request WHERE reqst_id='$id'" ;
							$requete = $mysqli->query( $sql ) ;
							$result = $requete->fetch_assoc();
									
							echo("<table class=\"table table-striped table-bordered table-hover\">
								<tbody>
									<tr><th>Autoris&eacute;e par</th><td>".$result['reqst_oic']."</td><td bgcolor=\"#00DDEE\">Autoris&eacute;e</td></tr>
									<tr><th>Fleet manager</th><td>Honor&eacute; MBAIGUEDEM</td><td bgcolor=\"#00DDEE\">Approuv&eacute;e</td></tr>
								</tbody>");

							echo("</table>");
							
							$agent	= $_SERVER['HTTP_USER_AGENT'];
							$fich	= $_SERVER['PHP_SELF'];
							$date	= date("Y-m-d H:i:s");
							$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
									VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'EDITION', 'Demande $id') ";
							$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
						?>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
			<!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
	
	</center>
	
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
