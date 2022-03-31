<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
include('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$phone	= $_GET["tel"];
	$mois	= $_GET["chahar"];
	$opt	= $_GET["opt"];
	$date	= date("Y-m-d H:i:s");
	
		if ($opt=="archv")
		{
			$sql = "UPDATE wfp_chd_bilpp_archv SET STATE='IDENTIFIE', PRIV_OFF='PRIV', DATE_IDEN='$date'
				WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') ";
		}
		else
		{
			$sql = "UPDATE wfp_chd_bilpp SET STATE='IDENTIFIE', PRIV_OFF='PRIV', DATE_IDEN='$date'
				WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562')";
		}
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'IDENTIFICATION', '$id $opt') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:gouroussfact.php?opt=".$opt."&chahar=".$mois."&tel=".$phone." ") ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Identification</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
?>