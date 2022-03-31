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

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-up fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> 
										<?php 
											include('connexion.php'); 
											$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='VALIDE' ")->fetch_array(); 
											$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' ")->fetch_array();
											$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state='TRAITE' ")->fetch_array();
											
											echo $nbt['nb']+$nbs['nbe']+$nbe['nbe']; 
										?>
									</div>
                                    <div>Approuv&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='details1approuv.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-hand-o-right fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php 
											include('connexion.php'); 
											$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='ATTENTE' OR reqst_statoic='ATTENTE') ")->fetch_array(); 
											$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE' ")->fetch_array(); 
											$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state NOT LIKE '%REJET%' AND rqeqpmt_state!='TRAITE'")->fetch_array();
																						
											echo $nbt['nb']+$nbs['nbe']+$nbe['nbe']; 
										?>
									</div>
                                    <div>En attente</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='details1attente.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-down fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php 
											include('connexion.php'); 
											$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='REJET' OR reqst_statoic='REJET') ")->fetch_array(); 
											$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='REJET' ")->fetch_array(); 
											$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state LIKE '%REJET%' ")->fetch_array();
																				
											echo $nbt['nb']+$nbs['nbe']+$nbe['nbe']; 
										?>
									</div>
                                    <div>Rejet&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='details1rejet.php';return false">
                            <div class="panel-footer">
                                <span class="pull-left">Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php 
											include('connexion.php'); 
											$nba = $mysqli->query("SELECT COUNT(*) AS nba FROM wfp_chd_request WHERE reqst_state='EFFECTUE' ")->fetch_array();
											echo $nba['nba'];
										?>
									</div>
                                    <div>Effectu&eacute;es</div>
                                </div>
                            </div>
                        </div>
                        <a href="/" onclick="document.location='detailseffectue.php';return false">
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
