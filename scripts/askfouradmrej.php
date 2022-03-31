<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$prof2 = $result["profil2"];
	$unite = $result["unite"];
				
	if($prof2!="AdminSU" AND $unite!="ADMIN-FINANCE/CO NDJAMENA")
	{
		header('Location:simple.php');
	}

	$id		= $_GET["id"];
	$refer	= $_GET["ref"];
	$date	= date("Y-m-d H:i:s");
  
	$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='REJ2' WHERE rqeqv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='AUTO' ")->fetch_array();
	if($existe['ID'] == 0)
	{
		$existeapr = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV2' ")->fetch_array();
		if($existeapr['ID'] != 0)
		{
			$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE2', rqeqpmt_oicit='$pseudo', rqeqpmt_doicit='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
				//include("inc/rissalaskfour.php");
			header("Location:listdefourndet.php?id=".$refer."") ;
		}
		else
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJET2', rqeqpmt_oicit='$pseudo', rqeqpmt_doicit='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			//include("inc/rissalaskeqdesk.php");
			header("Location:listdefourndet.php?id=".$refer."") ;
		}
	}
	else
	{
		header("Location:listdefourndet.php?id=".$refer."") ;
	}	
?>
