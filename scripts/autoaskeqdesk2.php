<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$id 	= $_POST["id"];
	$oicit 	= $_POST["oic"];
	$date	= date("Y-m-d H:i:s");
	
	$ref	= $mysqli->query("SELECT vars_ref AS RF FROM wfp_chd_sandoukvar WHERE vars_id='$id' ")->fetch_array();
	$refer	= $ref['RF'];
  
	$sqlsan = "UPDATE wfp_chd_sandoukvar SET vars_state='APRV1' WHERE vars_id='$id' ";
	$requet = $mysqli->query($sqlsan) or die ( $mysqli->connect_errno());
	
	if($requet)
	{	
		$sqlu = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_sdesk='$pseudo', rqeqpmt_oicit='$oicit', rqeqpmt_dsdesk='$date' WHERE rqeqpmt_ref='$refer'";
		$mysqli->query($sqlu) or die ('Erreur '.$sqlu.' '.$mysqli->error);
			
		$existe = $mysqli->query("SELECT vars_id AS ID FROM wfp_chd_sandoukvar WHERE vars_ref='$refer' AND vars_state='AUTO' ")->fetch_array();
		if($existe['ID'] == 0)
		{
			$sql = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE1', rqeqpmt_sdesk='$pseudo', rqeqpmt_oicit='$oicit', rqeqpmt_dsdesk='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
			//include("inc/rissalaskeqit.php");
		}
		header('Location:listaskeqpmt.php') ;
	}			
	else
	{
		echo'<font size="+2"><i>Echec Assignation</i></font><br><br><center><a href="listaskeqpmt.php">retour</a></center>' ;
	}
?>
