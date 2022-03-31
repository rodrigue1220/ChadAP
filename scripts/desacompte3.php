<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}

	$id		= $_GET["ide"] ;
	$option	= $_GET["choix"] ;
  	
	if ($option=="DESC")
	{
		$sql = "UPDATE user SET state='INACTIF' WHERE id='$id' ";
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION DESACTIVATION', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:userlist.php') ;
		}
		
		else
		{
			echo'<font size="+2"><i>Echec Desactivation</i></font><br><br><center><a href="desacompte.php">retour</a></center>' ;
		}
	}
	else
	{
		$sql = "UPDATE user SET state='ACTIF' WHERE id='$id' ";
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION ACTIVATION', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:userlist.php') ;
		}
		
		else
		{
			echo'<font size="+2"><i>Echec Activation</i></font><br><br><center><a href="desacompte.php">retour</a></center>' ;
		}
	}
  
?>