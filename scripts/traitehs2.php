<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$id		= $_GET["id"];
	$action	= $_GET["cx"];
	$alyom 	= date("Y-m-d H:i:s");

	if ($action=="OK")
	{
		$sql2 = "UPDATE wfp_chd_djmcto SET cto_statut='CERTIFIE', cto_dapprover='$alyom' WHERE cto_id='$id' ";				
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'CERTIFICATION', 'Demande $id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:vacompenscto2.php');
		}			
	}
	else if ($action=="RJ")
	{
		$sql2 = "UPDATE wfp_chd_djmcto SET cto_statut='NON_CERTIFIE', cto_dapprover='$alyom' WHERE cto_id='$id' ";				
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'REJET_CERTIFICATION', 'Demande $id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:vacompenscto2.php');
		}			
	}
	else if ($action=="AN")
	{
		$sql2 = "UPDATE wfp_chd_djmcto SET cto_statut='ANNULE', cto_dapprover2='$alyom' WHERE cto_id='$id' ";				
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'ANNULE_CERTIFICATION', 'Demande $id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:va2compenscto.php');
		}
	}
?>
