<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminSDR")
	{
		header('Location:simple.php');
	}
	
	$id		= $_POST["id"];
	$salle	= $_POST["sdr"];
	$lib	= $_POST["comm"];
	$date	= date("Y-m-d H:i:s");
  
  		$sql = "UPDATE wfp_chd_requestsdr SET reqsdr_salle='$salle', reqsdr_state='VALIDE', reqsdr_dateact='$date', reqsdr_lib='$lib'
				WHERE reqsdr_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION VALIDE', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rissalavasksdr.php");
		header('Location:simple.php') ;
	}
			
	else
	{
		echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
	}
?>
