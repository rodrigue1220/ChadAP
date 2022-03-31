<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$cle	= "CAT";
	$id		= $_GET["id"];
	$cle	= $_GET["cle"];
	$date	= date("Y-m-d H:i:s");

  		
	$sql = "DELETE FROM wfp_chd_sandoukvar WHERE vars_id='$id'";
			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'SUPPRESSION', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		if ($cle=="FOURN")
		{
			header('Location:askfour.php');
		}
		else
		{
			header('Location:askeqpmform.php?cle=IT');
		}
	}			
	else
	{
		echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="askeqpmform.php?cle=IT">retour</a></center>' ;
	}
?>
