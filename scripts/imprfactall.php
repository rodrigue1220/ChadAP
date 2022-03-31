<?php
require_once('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chad AP v1.0 | Facturation T&eacute;l&eacute;phonique</title>

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
        <center><h1 class="page-header">FACTURE TELEPHONIQUE</h1>
    </div>
		
	<div class="row">
				<div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							<?php 
								$tot=$mysqli->query("SELECT SUM(rec_totpriv) AS TOT FROM wfp_chd_recapbil")->fetch_array();
								$total=$tot['TOT'];
								
								$totn=$mysqli->query("SELECT COUNT(DISTINCT rec_phone) AS TOT FROM wfp_chd_recapbil")->fetch_array();
								$totaln=$totn['TOT'];
								
								echo ("Facture pour Unit&eacute; Finance  <br />Nombre num&eacute;ros: <strong>".$totaln."</strong><br />P&eacute;riode: ");
								
								$sql = "SELECT DISTINCT rec_mois FROM wfp_chd_recapbil" ;
								$requete = $mysqli->query( $sql ) ;
								while( $result = $requete->fetch_assoc()  )
								{
								  echo ("<strong>".$result['rec_mois']."</strong>, ");
								}
								echo (" Total : <strong>".number_format($total,2,',','.')." FCFA</strong>");
							?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php

								$i=1;

								$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Cl&eacute;</th>
												<th>Utilisateur</th>
												<th>Num&eacute;ro</th>
												<th>Montant (FCFA)</th>
												<th>Mois</th>
											</tr>
										</thead>");
											
									$sql = "SELECT * FROM wfp_chd_recapbil ORDER BY rec_phone " ;
									$requete = $mysqli->query( $sql ) ;
									while( $result = $requete->fetch_assoc()  )
									{	
										$phone		= $result['rec_phone'];
										$sqlp	 	= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' ORDER BY nom ";
										$requetep	= $mysqli->query( $sqlp );
										$resultp 	= $requetep->fetch_assoc();
										$nom  		= $resultp['nom'];
										$pnom 		= $resultp['prenom'];
										
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['rec_id']."</td>");
										echo("<td>".$nom." ".$pnom."</td>");
										echo("<td>".$result['rec_phone']."</td>");	 
										echo("<td>".number_format($result['rec_totpriv'],2,',','.')."</td>");
										echo("<td>".$result['rec_mois']."</td>");
										$i++;
									}
									echo("</tr></tbody></table>");
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Aucune Facture Disponible...</div>") ;	
								}
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
            <!-- /.row -->
		
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
