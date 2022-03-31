<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$npnom		= $_POST["nom"] ;
	$option		= $_POST["choix"] ;
	
	$nom = stristr($npnom, ',', true);
	$prenom = substr(stristr($npnom, ','), 1);
  	
	if ($option=="DESC")
	{
		$sql = "UPDATE user SET state='INACTIF' WHERE nom='$nom' AND prenom='$prenom' ";		
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION DESACTIVATION', '$nom $prenom $profil') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:add1user.php') ;
		}
		
		else
		{
			echo'<font size="+2"><i>Echec Desactivation</i></font><br><br><center><a href="desacompte.php">retour</a></center>' ;
		}
	}
	else
	{
		$sql = "UPDATE user SET state='ACTIF' WHERE nom='$nom' AND prenom='$prenom' ";		
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION ACTIVATION', '$nom $prenom $profil') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:add1user.php') ;
		}
		
		else
		{
			echo'<font size="+2"><i>Echec Activation</i></font><br><br><center><a href="desacompte.php">retour</a></center>' ;
		}
	}
  
?>