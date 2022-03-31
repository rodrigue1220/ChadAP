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
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}
	
	$id	= $_GET["id"];
	$pg	= $_GET["page"];
  
  	$sql = "UPDATE wfp_chd_rqdjoummah SET lv_statetrt='TRAITE' WHERE lv_id='$id'";		
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION_TRT_CONGES', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header("Location:trtdjmrh.php?page=".$pg."") ;
	}
			
	else
	{
		echo("<font size=\"+2\"><i>Echec Action Traitement</i></font><br><br><center><a href=\"trtdjmrh.php?page=".$pg."\">retour</a></center>") ;
	}
?>
