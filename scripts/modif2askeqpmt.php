<?php

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$id = $_POST["id"];
	
	if (get_magic_quotes_gpc())
	{
		$item	= stripslashes(trim($_POST["item"])) ;
		$otr	= stripslashes(trim($_POST["otr"])) ;
		$nbr	= stripslashes(trim($_POST["nbr"])) ;
		$oic 	= stripslashes(trim($_POST["oic"])) ;
		$motif 	= stripslashes(trim($_POST["motif"])) ;
	}
	else
	{
		$item	= trim($_POST["item"]) ;
		$otr	= trim($_POST["otr"]) ;
		$nbr	= trim($_POST["nbr"]) ;
		$oic 	= trim($_POST["oic"]) ;
		$motif 	= trim($_POST["motif"]) ;
	}
	
	if ($item == "Autre")
	{
		$item = $otr;
	}	
  
	$date 		= date("Y-m-d H:i:s");
		

	$sql2 = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_item='$item', rqeqpmt_nbr='$nbr', rqeqpmt_motif='$motif', rqeqpmt_date='$date', rqeqpmt_oic='$oic'
			WHERE rqeqpmt_id='$id' ";
					
	$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	if( $requete2 )
	{		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MODIFICATION', '$item $nbr') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rissalanaskeqpmt.php");
		header('Location:simple.php');
	}
			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"askeqpmt.php\">retour</a></center></span>") ;
	}
?>
