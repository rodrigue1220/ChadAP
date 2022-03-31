<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$sqle	= "SELECT * FROM user WHERE pseudo='$pseudo' ";
	$requet = $mysqli->query( $sqle );
	$resulte= $requet->fetch_assoc();
	$nom	= $resulte['nom'];
	$prenom	= $resulte['prenom'];
	
	$action	= $_GET["cx"];
	$alyom 	= date("Y-m-d H:i:s");

	if ($action=="OK")
	{
		$sql2 = "UPDATE wfp_chd_djmcto SET cto_statut='APPROUVE', cto_dapprover='$alyom' WHERE cto_approver='$nom,$prenom' AND cto_statut='ATTENTE' ";				
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'APPROBATION', 'Toutes les demandes en Attente') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:vacompenscto.php');
		}			
	}
	else if ($action=="RJ")
	{
		$sql2 = "UPDATE wfp_chd_djmcto SET cto_statut='REJET', cto_dapprover='$alyom' WHERE cto_approver='$nom,$prenom' AND cto_statut='ATTENTE' ";				
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'REJET', 'Toutes les demandes en Attente') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:vacompenscto.php');
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
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'ANNULE', 'Demande $id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:va2compenscto.php');
		}
	}
?>
