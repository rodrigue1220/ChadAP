<?php

	include("connexion.php");

	$sql = "SELECT * FROM wfp_chd_recapbil WHERE (rec_mois='mars-21' OR rec_mois='avr-21') AND rec_date>'2021-06-01 00:00:00'";
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{	
		$numero		= $result["rec_phone"];
		$mois		= $result["rec_mois"];
		
		$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$numero' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') AND PRIV_OFF='PRIV' ")->fetch_array();
		$taboff = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$numero' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND (SUBSTR(CALLED_NO, 1, 5)!='68562' AND SUBSTR(CALLED_NO, 1, 8)!='23568562') AND PRIV_OFF='OFF' ")->fetch_array();
	
		$totalpriv 		= $tabpriv['som'];
		$privtotal 		= $tabpriv['nb'];
		$totalprivmin	= $tabpriv['tps'] / 60;
		$totaloff 		= $taboff['som'];
		$offtotal		= $taboff['nb'];
		$totaloffmin	= $taboff['tps'] / 60;
	
		$exis = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_phone='$numero' AND rec_mois='$mois' ")->fetch_array();
		if($exis['ID'] != 0)
		{
			$sqlw = "UPDATE wfp_chd_recapbil SET rec_totpriv='$totalpriv', rec_totoff='$totaloff', rec_privtot='$privtotal', rec_offtot='$offtotal', rec_privtotmin='$totalprivmin', rec_offtotmin='$totaloffmin'  
				WHERE rec_phone='$numero' AND rec_mois='$mois' ";
			$requetew = $mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
		}
	}
?>