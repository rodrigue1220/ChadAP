<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminFOURN")
	{
		header('Location:simple.php');
	}

	$id		= $_GET["id"];
	$refer	= $_GET["ref"];
	$date	= date("Y-m-d H:i:s");
  
	$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='REJ3' WHERE rqeqv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV2' ")->fetch_array();
	if($existe['ID'] == 0)
	{
		$existeapr = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='TRT' ")->fetch_array();
		if($existeapr['ID'] != 0)
		{
			$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='TRAITE', rqeqpmt_appro='$pseudo', rqeqpmt_dappro='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
				//include("inc/rissalaskfour.php");
			header("Location:listdemfourndet.php?id=".$refer."") ;
		}
		else
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJET3', rqeqpmt_appro='$pseudo', rqeqpmt_dappro='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			//include("inc/rissalaskeqdesk.php");
			header("Location:listdemfourndet.php?id=".$refer."") ;
		}
	}
	else
	{
		header("Location:listdemfourndet.php?id=".$refer."") ;
	}	
?>
