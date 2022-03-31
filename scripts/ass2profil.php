<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	if ($profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
	$npnom		= $_POST["nom"] ;
	$profil		= $_POST["prof"] ;
	
	$nom = stristr($npnom, ',', true);
	$prenom = substr(stristr($npnom, ','), 1);
  		
	$sql = "UPDATE user SET profil='$profil' WHERE nom='$nom' AND prenom='$prenom' ";		
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION ASSIGNATION', '$nom $prenom $profil') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:userprofil.php') ;
	}
		
	else
	{
		echo'<font size="+2"><i>Echec Assignation</i></font><br><br><center><a href="simple.php">retour</a></center>' ;
	}
  
?>