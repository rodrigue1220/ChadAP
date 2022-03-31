<?php
require_once('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}
	
	$mois= $_GET["cle"];		
	$date	= date("Y-m-d H:i:s");
	
	$sql = "UPDATE wfp_chd_recapbil SET rec_datestatefin='$date', rec_statefin='PRINT' WHERE rec_statefin='NOPRINT' AND rec_mois='$mois' ";     
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'IMPRIME', '$mois') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:factchaharfinance.php?cle='.$mois.'');
	}
			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Validation <br><br><center><a href=\"factchaharfinance.php?cle=$mois\">retour</a></center></span>") ;
	}
?>
    
  