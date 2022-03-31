<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("connexion.php");

	$sql 	= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete= $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nom 	= $result["nom"];
	$prenom = $result["prenom"];
				
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom' AND off_unit='ICT/CO NDJAMENA' ")->fetch_array();
	if($oic['ID'] == 0)
	{
		header('Location:simple.php');
	}

	$id		= $_POST["keys"];
	$choix	= $_POST["cx"];
	$refer	= $_POST["ref"];
	$nbrap	= $_POST["nbr"];
	$comm	= addslashes($_POST["comm"]);
	$date	= date("Y-m-d H:i:s");
	
	if ($choix == "REJ")
	{
		$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='REJ2', rqeqv_comm='$comm' WHERE rqeqv_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	}
	elseif ($choix == "ADJ")
	{
		$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_nbraprv='$nbrap', rqeqv_comm='$comm' WHERE rqeqv_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	}
  
	
	
	$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV1' ")->fetch_array();
	if($existe['ID'] == 0)
	{
		$existeapr = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV2' ")->fetch_array();
		if($existeapr['ID'] != 0)
		{
			$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE2', rqeqpmt_doicit='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
			include("inc/rissalaskeqstock.php");
			header("Location:listdeqpmtatit.php") ;
		}
		else
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJET2', rqeqpmt_doicit='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			include("inc/rissalaskrejeqoicit.php");
			header("Location:listdeqpmtatit.php") ;
		}
	}
	else
	{
		header("Location:listdeqpmtatitdet.php?id=".$refer."") ;
	}	
?>
