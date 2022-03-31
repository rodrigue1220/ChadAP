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
	$nomoic = $result["nom"];
	$pnomoic = $result["prenom"];
			
	$oic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nomoic' AND off_pnom='$pnomoic' AND off_unit='LOGISTIQUE/CO NDJAMENA' ")->fetch_array();
	if($oic['ID'] == 0)
	{
		header('Location:simple.php');
	}

	$officer= $nomoic.",".$pnomoic;
	$id		= $_GET["ide"] ;
	$page	= $_GET["page"] ;
	$date 	= date("Y-m-d H:i:s");
  	
	$sql = "UPDATE wfp_chd_cargodem SET cargodem_state='APPROUVE', cargodem_officer='$officer', cargodem_dofficer='$date' WHERE cargodem_id='$id' ";
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];

		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPROBATION', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header("Location:listdecargo.php?page=".$page."") ;
	}
	else
	{
		header('Location:oops666khalatt.php?cle=APPRVCARG');
		exit();
	}
  
?>