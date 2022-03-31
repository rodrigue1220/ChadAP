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
	
	if ($profil != "AdminSTDESK")
	{
		header('Location:simple.php');
	}
	
	$id		= $_GET["id"];
	$refer	= $_GET["ref"];
	$date	= date("Y-m-d H:i:s");
  
	$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='REJDESK' WHERE rqeqv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='AUTO' ")->fetch_array();
	if($existe['ID'] == 0)
	{
		$existeapr = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV1' ")->fetch_array();
		if($existeapr['ID'] != 0)
		{
			$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE1', rqeqpmt_sdesk='$pseudo', rqeqpmt_dsdesk='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
				//include("inc/rissalaskfour.php");
			header("Location:listaskeqpmtdet.php?id=".$refer."") ;
		}
		else
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJETDESK', rqeqpmt_sdesk='$pseudo', rqeqpmt_dsdesk='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			//include("inc/rissalaskeqdesk.php");
			header("Location:listaskeqpmtdet.php?id=".$refer."") ;
		}
	}
	else
	{
		header("Location:listaskeqpmtdet.php?id=".$refer."") ;
	}	
?>
