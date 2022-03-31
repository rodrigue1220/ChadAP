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
	$date	= date("Y-m-d H:i:s");
	$opt	= $_GET["opt"];
	
	if ($opt=="archv")
	{
		$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp_archv 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') AND PRIV_OFF='PRIV' ")->fetch_array();
		$taboff = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp_archv 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') AND PRIV_OFF='OFF' ")->fetch_array();
	}
	else
	{
		$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') AND PRIV_OFF='PRIV' ")->fetch_array();
		$taboff = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') AND PRIV_OFF='OFF' ")->fetch_array();
	}
	$totalpriv 		= $tabpriv['som'];
	$privtotal 		= $tabpriv['nb'];
	$totalprivmin	= $tabpriv['tps'] / 60;
	$totaloff 		= $taboff['som'];
	$offtotal		= $taboff['nb'];
	$totaloffmin	= $taboff['tps'] / 60;
	
	$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' ")->fetch_array();
	if($exis['ID'] != 0)
	{
		$sqlw = "UPDATE wfp_chd_recapbil SET rec_totpriv='$totalpriv', rec_totoff='$totaloff', rec_privtot='$privtotal', rec_offtot='$offtotal', rec_privtotmin='$totalprivmin', rec_offtotmin='$totaloffmin', rec_date='$date', rec_statefin='NOPRINT' 
				WHERE rec_phone='$phone' AND rec_mois='$mois' ";
		$requetew = $mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
	}
	else
	{
		$sqlz = "INSERT INTO wfp_chd_recapbil (rec_id, rec_phone, rec_mois, rec_totpriv, rec_totoff, rec_privtot, rec_offtot, rec_privtotmin, rec_offtotmin, rec_date, rec_statefin)
				VALUES ('', '$phone', '$mois', '$totalpriv', '$totaloff', '$privtotal', '$offtotal', '$totalprivmin', '$totaloffmin', '$date', 'NOPRINT') ";
		$requetez = $mysqli->query($sqlz) or die( $mysqli->connect_errno()) ;
	}
		
		if ($opt=="archv")
		{
			$sql = "UPDATE wfp_chd_bilpp_archv SET STATE='IDENTIFIE' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";
		}
		else
		{
			$sql = "UPDATE wfp_chd_bilpp SET STATE='IDENTIFIE' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";
		}
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'FIN IDENTIFICATION', '$id $opt') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:gouroussphone.php") ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Identification</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
?>