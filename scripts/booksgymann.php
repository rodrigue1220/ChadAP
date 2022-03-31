<?php

require_once('connexion.php');
require_once('config.php');
require_once('verifications.php');

	$id 	= $_GET["iden"];
	$alyom 	= date("Y-m-d H:i:s");

	$sql 	 = "SELECT * FROM wfp_chd_progymrv WHERE pgymrv_id='$id' " ;
	$requete = $mysqli->query( $sql ) 
	$result	 = $requete->fetch_assoc();
	$jour	= $result["pgymrv_jour"];
	$eqp	= $result["pgymrv_eqp"];
	
	$sql2 = "DELETE FROM wfp_chd_progymrv WHERE pgymrv_id='$id' " ;
	$req2 =  $mysqli->query($sql2) ;
	
	if ($req2)
	{		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'SUPP_RESERVATION', '$jour $eqp $id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:booksgymrsv.php');
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Annulation Reservation <br><br><center><a href=\"booksgymrsv.php\">retour</a></center></span>") ;
	}	
?>