<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}

	$id		= $_GET["id"] ;
	$opt	= $_GET["cx"];
	$page	= $_GET["page"];

	if ($opt == "DESC")
	{
		$sql = "UPDATE wfp_chd_personnel SET rh_statut='INACTIF' WHERE rh_id='$id' ";		
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION_DESACTIVATION_RH', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:employlistinac.php") ;
		}
		
		else
		{
			echo'<font size="+2"><i>Echec Desactivation</i></font><br><br><center><a href="employlistinac.php">retour</a></center>' ;
		}
	}
	
	else if ($opt == "ACT")
	{
		$sql = "UPDATE wfp_chd_personnel SET rh_statut='ACTIF' WHERE rh_id='$id' ";		
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION_ACTIVATION_RH', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:employlist.php") ;
		}
		
		else
		{
			echo("<font size=\"+2\"><i>Echec Activation</i></font><br><br><center><a href=\"employlist.php\">retour</a></center>");
		}
	}
?>