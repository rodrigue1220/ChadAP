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
	$origine= $_POST["orig"];

	$sql 	= "INSERT INTO wfp_chd_logconf(logc_id, logc_nom, logc_lib, logc_type)
		VALUES ('', '$wh', '$origine', 'WH') ";
	
	$req	= $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	if( $req )
	{			
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$alyom 	= date("Y-m-d H:i:s");
		
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ('', '$pseudo', '$agent', '$fich', '$alyom', 'CREATION', '$wh $origine')";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);

		header("Location:addlogconfg.php");
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"addlogconfg.php\">retour</a></center></span>") ;
	}

?>