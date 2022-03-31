<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

  $id	= $_GET["id"];
  $date	= date("Y-m-d H:i:s");
  
  $pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
  $profil	= $pro["PROF"];
	
	if ($profil != "AdminFLEET")
	{
		header('Location:simple.php');
	}
  		$sql = "UPDATE wfp_chd_request SET reqst_state='REJET', reqst_dateaction='$date'
				WHERE reqst_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION REJET', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			include("inc/rissalarejask.php");
			header('Location:accueil.php') ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
  ?>
