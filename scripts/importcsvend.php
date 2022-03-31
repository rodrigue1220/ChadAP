<?php

/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$date 	= date("Y-m-d H:i:s");
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	$sql2 = "UPDATE wfp_chd_bilpp SET STATE='ATTENTE' WHERE STATE='IMPORT' ";
	$requete2 = $mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
	
	if( $requete2 )
	{		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'IMPORT_DET', 'NEW') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		//include("inc/rissalanaskeqpmt.php");
		header("Location:gestgourouss.php");
	}
?>