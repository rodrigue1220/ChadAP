<?php
include('ctrl.php');
include('connexion.php');

	$phone	= $_GET["tel"];
	$mois	= $_GET["cle"];
	$opt	= $_GET["opt"];
	$date	= date("Y-m-d H:i:s");
	
	$an		= substr(stristr($mois, '-'), 1);
	if ($an == "18")
	{
		$opt= "archv";
	}
	
	if ($opt=="archv")
	{
		$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp_archv 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND ORIGINAL_CALL_TYPE LIKE '%MO%' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') ")->fetch_array();
	}
	else 
	{
		$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND ORIGINAL_CALL_TYPE LIKE '%MO%' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') ")->fetch_array();
	}
	$taboff = 0;
	
	$totalpriv 		= $tabpriv['som'];
	$privtotal 		= $tabpriv['nb'];
	$totalprivmin	= $tabpriv['tps'] / 60;
	$totaloff 		= 0;
	$offtotal		= 0;
	$totaloffmin	= 0;
	
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
			$sql = "UPDATE wfp_chd_bilpp_archv SET STATE='IDENTIFIE', PRIV_OFF='PRIV', DATE_IDEN='$date'
				WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND ORIGINAL_CALL_TYPE LIKE '%MO%' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') ";			
		}
		else
		{
			$sql = "UPDATE wfp_chd_bilpp SET STATE='IDENTIFIE', PRIV_OFF='PRIV', DATE_IDEN='$date'
				WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND ORIGINAL_CALL_TYPE LIKE '%MO%' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') ";			
		}
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			if ($opt=="archv")
			{
				$sqlx = "UPDATE wfp_chd_bilpp_archv SET STATE='IDENTIFIE', DATE_IDEN='$date' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";			
			}
			else
			{	
				$sqlx = "UPDATE wfp_chd_bilpp SET STATE='IDENTIFIE', DATE_IDEN='$date' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";			
			}
			$requetex = $mysqli->query($sqlx) or die( $mysqli->connect_errno()) ;
		
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$phone', '$agent', '$fich', '$date', 'FORC IDENTIFICATION', '$id $opt') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:rechfactnidenpm.php?cle=".$mois."") ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Identification</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
?>