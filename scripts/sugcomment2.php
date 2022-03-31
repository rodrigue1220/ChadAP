<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$user 	= $pseudo;
	$date 	= date("Y-m-d H:i:s");
	$module	= $_POST["mod"] ;
	$rmrq	= addslashes($_POST["rq"]) ;
	$propos	= addslashes($_POST["prop"]) ;
	$choix	= $_POST["opt"] ;
		
	$sql2 = "INSERT INTO wfp_chd_sugcom (sgc_id, sgc_user, sgc_date, sgc_module, sgc_rq, sgc_propos, sgc_choix)
			VALUES ('', '$user', '$date', '$module', '$rmrq', '$propos', '$choix')";
					
	$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	if( $requete2 )
	{	
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$user', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$rmrq $propos') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include('inc/rissalansugcom.php');
		header('Location:sugcomok.php');
	}
			
	else
	{
		echo'Echec Ajout <br><br><center><a href="sugcomment.php">retour</a></center>' ;
	}  
?>
