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

	$npnom	= $_POST["nom"] ;
	$buro	= $_POST["office"] ;
	$unit	= $_POST["service"] ;
	
	$nom = stristr($npnom, ',', true);
	$prenom = substr(stristr($npnom, ','), 1);
  		
	$sql = "UPDATE user SET unite='$unit/$buro' WHERE nom='$nom' AND prenom='$prenom' ";		
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CHANGE_UNITE', '$nom $prenom $unit/$buro') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:unitmod.php') ;
	}
		
	else
	{
		echo'<font size="+2"><i>Echec Assignation</i></font><br><br><center><a href="unitmod.php">retour</a></center>' ;
	}
  
?>