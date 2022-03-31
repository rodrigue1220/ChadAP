<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$wh		= $_POST["wh"];
	$matd	= $_POST["mdesc"];
	$batch	= $_POST["batch"];
	$wbs	= $_POST["wbs"];
	$grnt	= $_POST["gnum"];
	$grntd	= $_POST["gdesc"];
	$slbbd	= $_POST["bbd"];
	$total	= $_POST["total"];
	$gtdd	= $_POST["gtdd"];
	
	$sql 	= "INSERT INTO wfp_chd_logstock (logs_id, logs_wh, logs_matdesc, logs_batch, logs_wbs, logs_grantnum, logs_grantdesc, logs_sledbbd, logs_total, logs_tddgrant)
	VALUES ('', '$wh', '$matd', '$batch', '$wbs', '$grnt', '$grntd', '$slbbd', '$total', '$gtdd') ";
	
	$req	= $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	if( $req )
	{			
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$alyom 	= date("Y-m-d H:i:s");
		
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ('', '$pseudo', '$agent', '$fich', '$alyom', 'CREATION', '$wh $grnt $batch $total')";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);

		header("Location:majlogstkreport.php");
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"majlogstkreport.php\">retour</a></center></span>") ;
	}

?>