<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	
	$id = $_GET["id"];
	$date	= date("Y-m-d H:i:s");
  
	$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz 	= $requetez->fetch_assoc();
	$nopers		= $resultz['lv_nopers'];
	

	$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='REJETRH' WHERE lv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'REJET_RH', 'Demande $id $date') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rissalarjdjmrh.php");
		header('Location:listdjoummahaskhr.php') ;
	}
			
	else
	{
		echo'<font size="+2"><i>Echec Rejet</i></font><br><br><center><a href="listdjoummahaskhr.php">retour</a></center>' ;
	}  
?>
