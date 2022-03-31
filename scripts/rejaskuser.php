<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$refer	= $_GET["ref"];
	
	$date	= date("Y-m-d H:i:s");
  
	$sql 	= "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='ANNULE' WHERE rqeqv_ref='$refer'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;

	if( $requete )
	{
		$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='ANNULE' WHERE rqeqpmt_ref='$refer'";
		$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'DEM_EQPMT_ANNULE', '$refer') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);	
		header("Location:details1attente.php");
	}			
	else
	{
		echo("<font size=\"+2\"><i>Echec ANNULATION</i></font><br><br><center><a href=\"details1attente.php\">retour</a></center>") ;
	}		
?>
