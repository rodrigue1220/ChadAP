<?php
require_once('config.php');
require_once('verifications.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Automation Project v1.0</title>

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

            <ul class="nav navbar-top-links navbar-right">
				<a href="admin.php"><?php echo $pseudo; ?></a>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> -->
                        <!-- </li> -->
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
					<!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
              
                        <li>
                            <a href="simple.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                        </li>

                        <li>
                            <a href="/" onclick="document.location='add1ask.php';return false"><i class="fa fa-edit fa-fw"></i> Demande de Transport</a>
                        </li>
						<li>
                            <a href="/" onclick="document.location='under.php';return false"><i class="glyphicon glyphicon-edit fa-fw"></i> Demande de Salle De Reunion</a>
                        </li>
						<li>
                            <a href="/" onclick="document.location='under.php';return false"><i class="glyphicon glyphicon-edit fa-fw"></i> Billing System</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		<br /><br /><br />
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tableau de bord</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-up fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> <?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='VALIDE' ")->fetch_array(); echo $nb['nb']; ?> </div>
                                    <div>Mes Demandes Approuv&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="simple.php">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-o-up fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='ATTENTE' OR reqst_statoic='ATTENTE') ")->fetch_array(); echo $nb['nb']; ?></div>
                                    <div>Mes Demandes En attente</div>
                                </div>
                            </div>
                        </div>
                        <a href="details1attente.php">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-down fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='REJET' OR reqst_statoic='REJET') ")->fetch_array(); echo $nb['nb']; ?></div>
                                    <div>Mes Demandes Rejet&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="details1rejet.php">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			<?php
				include("connexion.php");
				$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
				$requete = $mysqli->query( $sql );
				$result = $requete->fetch_assoc();
				$nom = $result["nom"];
				$prenom = $result["prenom"];
				$i=1;
				
				$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom'")->fetch_array();
				if($oic['ID'] != 0)
				{					
					echo("<div class=\"row\">
							<div class=\"col-lg-12\">
								<div class=\"panel panel-default\">
									<div class=\"panel-heading\">");
										echo ("Demandes de Transport &agrave; Autoriser
									</div>
								<!-- /.panel-heading -->
								<div class=\"panel-body\">
									<div class=\"table-responsive\">");
					
					$existe = $mysqli->query("SELECT reqst_id AS ID FROM wfp_chd_request WHERE reqst_oic='$nom $prenom' AND reqst_statoic='ATTENTE' AND reqst_state='ATTENTE'")->fetch_array();
					if($existe['ID'] != 0)
					{
						$sql1 = "SELECT * FROM wfp_chd_request WHERE reqst_oic='$nom $prenom' AND reqst_statoic='ATTENTE' AND reqst_state='ATTENTE'" ;
						$requete1 = $mysqli->query( $sql1 ) ;
						echo("<table class=\"table\">
						<thead>
							<tr>
								<th>#</th>
								<th>Motif</th>
								<th>Destination</th>
								<th>D&eacute;part</th>
								<th>Retour</th>
							</tr>
						</thead>");
					
						while( $result1 = $requete1->fetch_assoc()  )
						{
							echo("<tbody><tr class=\"default\"><td>".$i."</td>");
							echo("<td>".$result1['reqst_motif']."</td>");
							echo("<td>".$result1['reqst_dest']."</td>");	
							if ($result1['reqst_mind'] < 10)
							{
								echo("<td>".$result1['reqst_dep']." ".$result1['reqst_heurd']."h 0".$result1['reqst_mind']."mn</td>");
							}
							else
							{
								echo("<td>".$result1['reqst_dep']." ".$result1['reqst_heurd']."h ".$result1['reqst_mind']."mn</td>");
							}
						
							if ($result1['reqst_minr'] < 10)
							{
								echo("<td>".$result1['reqst_ret']." ".$result1['reqst_heurr']."h 0".$result1['reqst_minr']."mn</td>");
							}
							else
							{
								echo("<td>".$result1['reqst_ret']." ".$result1['reqst_heurr']."h ".$result1['reqst_minr']."mn</td>");
							}	
							echo("<td><a href=\"auto1ask.php?id=".$result1['reqst_id']."\"><button type=\"button\" class=\"btn btn-info btn-xs\" title=\"AUTORISER\">AUTORISER</button></a></td>");
							$i++;
						}
					}
					else
					{
						echo("<div class=\"alert alert-info\">Aucune demande &agrave; autoriser...</div>") ;		
					}								
							echo("</tr></tbody></table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
					</div>");
				}				
			?>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mes Demandes de Transport Approuv&eacute;es
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                
							<?php
								include('connexion.php');
								
								$i=1;
								$exis = $mysqli->query("SELECT reqst_id AS ID FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='VALIDE'")->fetch_array();
						
								if($exis['ID'] != 0)
								{
									$sql = "SELECT * FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='VALIDE'" ;
									$requete = $mysqli->query( $sql ) ;
									echo("<table class=\"table\">
										<thead>
											<tr>
												<th>#</th>
												<th>Motif</th>
												<th>Destination</th>
												<th>D&eacute;part</th>
												<th>Retour</th>
												<th>Autoris&eacute; par</th>
											</tr>
										</thead>");
		
									while( $result = $requete->fetch_assoc()  )
									{
										echo("<tbody><tr class=\"default\"><td>".$i."</td>");
										echo("<td>".$result['reqst_motif']."</td>");
										echo("<td>".$result['reqst_dest']."</td>");	

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
										echo("<td>".$result['reqst_oic']."</td>");		
										echo("<td><a href=\"impr1ask.php?id=".$result['reqst_id']."\"><i class=\"glyphicon glyphicon-print\" title=\"IMPRIMER\"></i></a></td>");
										$i++;
									}
								}
								else
								{
									echo("<div class=\"alert alert-info\">Aucune demande...</div>") ;		
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
        </div>
        <!-- /#page-wrapper -->

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
