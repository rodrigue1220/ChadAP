<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	/*$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}*/
	
	include("inc/taarikh.php");
	include("inc/rass.php");
	include("inc/botoune.php");
?>
		<br /><br /><br />
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestion du Plan Op&eacute;rationnel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<style type="text/css"> .btn{ width:180px; } </style>
			<div align="right">
				<button type="button" class="btn btn-info" onclick="document.location='addofficeope.php'" title="Définir les zones / sites d'intervention"><i class="fa fa-institution" fa-fw></i> Sites </button>
				<button type="button" class="btn btn-success" onclick="document.location='addcontcongp.php'" title="Bénéficiaires"><i class="fa fa-users" fa-fw></i> B&eacute;n&eacute;ficiaires</button>
				<button type="button" class="btn btn-primary" onclick="document.location='addcontcong.php'" title="Ajouter type d'activité"><i class="fa fa-line-chart" fa-fw></i> Activit&eacute;s</button>
				<button type="button" class="btn btn-warning" onclick="document.location='addcontcongj.php'" title="Définir les rations"><i class="fa fa-shopping-basket" fa-fw></i> Rations</button>				
			</div><br /><br />
            <!-- /.row -->
			
			
        </div>
        <!-- /#page-wrapper -->
<?php
	include("inc/ridjilene2.php");
?>
