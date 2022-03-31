<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$demandeur	= $pseudo ;
	$nitem		= $_POST["item"] ;
	$otr		= $_POST["otr"] ;
	$otr		= addslashes($otr) ;
	$nbr		= $_POST["nbr"];

	//Test if other
	if ($nitem == "Autre")
	{
		$item = $otr;
		$code = $otr;
	}
	else
	{
		$item 		= stristr($nitem, '>', true);
		$code 		= substr(stristr($nitem, '>'), 1);
	}
	
	$date 	= date("Y-m-d H:i:s");
	$dater 	= date("YmdHis");
	
	//Verif si une demande en STANDBY
	$ref	= $mysqli->query("SELECT rqeqv_ref AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_state='STDBY' AND rqeqv_dem='$demandeur' AND rqeqv_type='FOURN' ")->fetch_array();		
	if ($ref['ID']=="")
	{
		$refer	= "DEM-".$dater."-".$demandeur;
	}
	else
	{
		$refer	= $ref['ID'];
	}
		
	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_requesteqpmtvar WHERE rqeqv_dem='$demandeur' AND rqeqv_item ='$code' AND rqeqv_state='STDBY' ")->fetch_array();		
	if($nb['nb']!=0)
	{
		header('Location:oops666khalatt.php?cle=ASKADD');
		exit();
	}
		
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_requesteqpmtvar (rqeqv_id, rqeqv_ref, rqeqv_item, rqeqv_nbr, rqeqv_dem, rqeqv_date, rqeqv_state, rqeqv_type)
			VALUES ('', '$refer', '$code', '$nbr', '$demandeur', '$date', 'STDBY', 'FOURN')";
					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{		
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$item $code $nbr $demandeur') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			//include("inc/rissalanaskeqpmt.php");
			header("Location:askfour.php");
		}
			
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"askfour.php\">retour</a></center></span>") ;
		}
	}
?>
