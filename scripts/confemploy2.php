<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


	$id		= $_GET["id"] ;
	$page	= $_GET["page"] ;

	$date 	= date("Y-m-d H:i:s");
		
	$sql = "UPDATE wfp_chd_personnel SET rh_statut='ACTIF' WHERE rh_id='$id' ";				
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )	
	{			
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CONF_PROF', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header("Location:confemploy.php?page=".$page."");
	}
			
	else
	{
		echo'Echec Operation <br><br><center><a href="confemploy.php">retour</a></center>' ;
	}  
 ?>
