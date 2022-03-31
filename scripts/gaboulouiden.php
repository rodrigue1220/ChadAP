<?php
include('ctrl.php');
require_once('connexion.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}

	$phone	= $_GET["tel"];
	$mois	= $_GET["cle"];
	$page	= $_GET["page"];
	$date	= date("Y-m-d H:i:s");
	
	
		$sqlz = "DELETE FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' ";
		$requetez = $mysqli->query($sqlz) or die( $mysqli->connect_errno()) ;

  		$sql = "UPDATE wfp_chd_bilpp SET STATE='ATTENTE', PRIV_OFF='OFF' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ANNUL_IDENTIFICATION', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:rechfactidenpm.php?cle=".$mois."&page=".$page."") ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Annule Identification</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
?>