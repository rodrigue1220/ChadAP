<?php
include("inc/rass.php");
include("inc/taarikh.php");
?>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
              
                        <li>
                            <a href="admin.php"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Administration Syst&egrave;me<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="adduser.php"><i class="fa fa-users fa-fw"></i>Gestion des Utilisateurs</a>
                                </li>
								<li>
                                    <a href="addunite.php"><i class="fa fa-user fa-fw"></i>Gestion des OIC</a>
                                </li>
							</ul>
                            <!-- /.nav-second-level -->
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
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> <?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM user ")->fetch_array(); echo $nb['nb']; ?> </div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
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
                                    <i class="fa fa-building-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_state='ATTENTE' ")->fetch_array(); echo $nb['nb']; ?></div>
                                    <div>Unit&eacute;s</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
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
                                    <i class="fa fa-building fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php include('connexion.php'); $nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_state='REJET' ")->fetch_array(); echo $nb['nb']; ?></div>
                                    <div>SO / FO</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
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
		
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene.php");
?>