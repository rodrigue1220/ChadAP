<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$sql 	= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete= $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nom 	= $result["nom"];
	$prenom = $result["prenom"];
	
	$id		= $_GET["id"];
	$refer	= $_GET["ref"];
	
	$exis = $mysqli->query("SELECT rqeqpmt_id AS ID FROM wfp_chd_requesteqpmt WHERE rqeqpmt_state='APPROUVE1' AND rqeqpmt_oicit='$nom,$prenom' AND rqeqpmt_ref='$refer' ")->fetch_array();				
	if($exis['ID'] != 0)
	{
		header('Location:simple.php');
	}
	
	$date	= date("Y-m-d H:i:s");
  
	$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='REJ2' WHERE rqeqv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV1' ")->fetch_array();
	if($existe['ID'] == 0)
	{
		$existeapr = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV2' ")->fetch_array();
		if($existeapr['ID'] != 0)
		{
			$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE2', rqeqpmt_doicit='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
			//include("inc/rissalaskeqstock.php");
			header("Location:listdeqpmtatit.php") ;
		}
		else
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJET2', rqeqpmt_doicit='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			//include("inc/rissalaskeqdesk.php");
			header("Location:listdeqpmtatit.php") ;
		}
	}
	else
	{
		header("Location:listdeqpmtatit.php") ;
	}	
?>
