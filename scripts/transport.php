<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="refresh" content="15" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chad AP v1.0 | Transport Approuv&eacute;</title>

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
  <!-- Fixed navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
	  <img src="../img/WFP-0000014687.png" width="195" height="80" class="img-rounded" alt="Programme Alimentaire Mondial"> 
      
    </div>
	<img src="../img/beta.png" width="80" height="80" class="img-rounded" alt="Logo WFP"> 
    <ul class="nav navbar-nav navbar-right"><a class="navbar-brand" href="#">Chad Automation Project v1.0</a>
      <!--li><a href="scripts/adduser.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
    </ul>
  </div>
</nav> 
	<br /><br /><br />
	
	 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Demandes Approuv&eacute;es par le FM</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Liste des demandes de Transport
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
							<?php
								include('connexion.php');
								
								$exis = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_state='VALIDE'")->fetch_array();
						
								if($exis['nb'] != 0)
								{

									$sql = "SELECT * FROM wfp_chd_request WHERE reqst_state='VALIDE'  ORDER BY reqst_dep DESC" ;
									$requete = $mysqli->query( $sql ) ;
									
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Demandeur</th>
												<th>Destination</th>
												<th>Passager (s)</th>
												<th>D&eacute;part</th>
												<th>Retour</th>
												<th>Chauffeur</th>
												<th>Mobile</th>
											</tr>
										</thead>");
									$i=1;
									while( $result = $requete->fetch_assoc()  )
									{
										$demandeur	= $result['reqst_nom'];
										$sqlz = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
										$requetez	= $mysqli->query( $sqlz );
										$resultz	= $requetez->fetch_assoc();
										$nom		= $resultz["nom"];
										$prenom 	= $resultz["prenom"];

										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$nom." ".$prenom."</td>");
										echo("<td>".$result['reqst_dest']."</td>");	
										echo("<td>".$result['reqst_passag']."</td>");
										if ($result['reqst_mind'] < 10)
										{
											echo("<td>".$result['reqst_dep']." ".$result['reqst_heurd']."h 0".$result['reqst_mind']."mn</td>");
										}
										else
										{
											echo("<td>".$result['reqst_dep']." ".$result['reqst_heurd']."h ".$result['reqst_mind']."mn</td>");
										}
										
										if ($result['reqst_minr'] < 10)
										{
											echo("<td>".$result['reqst_ret']." ".$result['reqst_heurr']."h 0".$result['reqst_minr']."mn</td>");
										}
										else
										{
											echo("<td>".$result['reqst_ret']." ".$result['reqst_heurr']."h ".$result['reqst_minr']."mn</td>");
										}
										echo("<td bgcolor=\"#00FF00\">".$result['reqst_chauf']."</td>");
										echo("<td bgcolor=\"#00FF00\">".$result['reqst_vehicle']."</td>");
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-warning\">Aucune Demande de Transport Valid&eacute;e...</div>") ;		
								}
							
							?>
								
								</tr></tbody></table>
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
