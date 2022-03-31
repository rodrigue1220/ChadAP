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
				
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom' AND off_unit='ICT/CO NDJAMENA' ")->fetch_array();
	if($oic['ID'] == 0)
	{
		header('Location:simple.php');
	}
	
	$id 	= $_POST["id"];
	$comm 	= addslashes($_POST["comm"]);
	$nbr	= $_POST["nbr"];
	$date	= date("Y-m-d H:i:s");
	
	$ref	= $mysqli->query("SELECT vars_ref AS RF FROM wfp_chd_sandoukvar WHERE vars_id='$id' ")->fetch_array();
	$refer	= $ref['RF'];
	
	$sqlsan = "UPDATE wfp_chd_sandoukvar SET vars_state='APRV2', vars_nbraprv='$nbr', vars_lib='$comm' WHERE vars_id='$id' ";
	$requet = $mysqli->query($sqlsan) or die ( $mysqli->connect_errno());
	
	if($requet)
	{
		$existe = $mysqli->query("SELECT vars_id AS ID FROM wfp_chd_sandoukvar WHERE vars_ref='$refer' AND (vars_state='AUTO' OR vars_state='APRV1') ")->fetch_array();
		if($existe['ID'] == 0)
		{
			$sql = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE2', rqeqpmt_doicit='$date', rqeqpmt_nbraprv='$nbr', rqeqpmt_lib='$comm'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
			//include("inc/rissalaskeqstock.php");
			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPROBATION OIC-ICT', '$id $nbr') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		}
		header('Location:listdeqpmtatit.php'); 
	}		
?>
