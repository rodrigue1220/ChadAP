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
	$item		= $_POST["item"] ;
	$otr		= $_POST["otr"] ;
	$item		= addslashes($item) ;
	$otr		= addslashes($otr) ;
	$nbr		= $_POST["nbr"];

	//Test if other
	if ($item == "Autre")
	{
		$item = $otr;
	}	
	
	$date 	= date("Y-m-d H:i:s");
	$dater 	= date("YmdHis");
	
	//Verif si une demande en STANDBY
	$ref	= $mysqli->query("SELECT vars_ref AS ID FROM wfp_chd_sandoukvar WHERE vars_state='STDBY' AND vars_sens='SORTIE' AND vars_rq='$demandeur' AND vars_type='FOURN' ")->fetch_array();		
	if ($ref['ID']=="")
	{
		$refer	= "DEM-".$dater."-".$demandeur;
	}
	else
	{
		$refer	= $ref['ID'];
	}
		
	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_sandoukvar WHERE vars_rq='$demandeur' AND vars_sens='SORTIE' AND vars_item ='$item' AND vars_state='STDBY' AND vars_type='FOURN' ")->fetch_array();		
	if($nb['nb']!=0)
	{
		echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"askfour.php?cle=IT\">retour</a></center></span>") ;
	}
		
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_sandoukvar (vars_id, vars_ref, vars_item, vars_nbr, vars_sens, vars_rq, vars_state, vars_type)
			VALUES ('', '$refer', '$item', '$nbr', 'SORTIE', '$demandeur', 'STDBY', 'FOURN')";
					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{		
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$item $nbr') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			//include("inc/rissalanaskeqpmt.php");
			header('Location:askfour.php');
		}
			
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"askfour.php\">retour</a></center></span>") ;
		}
	}
?>
