<?php

	include('connexion.php');
	
	$date	= date("Y-m-d H:i:s");
		
	$sql1 = "SELECT * FROM wfp_chd_majbilling WHERE maj_state='' AND maj_nom!='' AND maj_mois!='mai-21' AND maj_mois!='juin-21' AND maj_mois!='juil-21'" ;		
	$requete1 = $mysqli->query( $sql1 ) ;
	while( $result = $requete1->fetch_assoc()  )
	{	
		$phone		= $result["maj_tel"];
		$mois		= $result["maj_mois"];
		
		$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') 
					AND (SUBSTR(CALLED_NO, 1, 4)!='6856' AND SUBSTR(CALLED_NO, 1, 7)!='2356856') ")->fetch_array();
	
		$taboff = 0;
	
		$totalpriv 		= $tabpriv['som'];
		$privtotal 		= $tabpriv['nb'];
		$totalprivmin	= $tabpriv['tps'] / 60;
		$totaloff 		= 0;
		$offtotal		= 0;
		$totaloffmin	= 0;
	

		$sqlz = "INSERT INTO wfp_chd_recapbil (rec_id, rec_phone, rec_mois, rec_totpriv, rec_totoff, rec_privtot, rec_offtot, rec_privtotmin, rec_offtotmin, rec_date, rec_statefin)
				VALUES ('', '$phone', '$mois', '$totalpriv', '$totaloff', '$privtotal', '$offtotal', '$totalprivmin', '$totaloffmin', '$date', 'NOPRINT') ";
		$requetez = $mysqli->query($sqlz) or die( $mysqli->connect_errno()) ;

		$sql = "UPDATE wfp_chd_bilpp SET PRIV_OFF='PRIV'
			WHERE MSISDN_NO='$phone' AND MONTH='$mois' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') 
			AND (SUBSTR(CALLED_NO, 1, 4)!='6856' AND SUBSTR(CALLED_NO, 1, 7)!='2356856') ";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$sqlx = "UPDATE wfp_chd_bilpp SET STATE='IDENTIFIE', DATE_IDEN='$date' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";			
			$mysqli->query($sqlx) or die ('Erreur '.$sqlx.' '.$mysqli->error);
			
			$agent	= "Sys_auto"; //$_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$phone', '$agent', '$fich', '$date', 'FORC IDENTIFICATION', 'GLOBAL $mois') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			//header("Location:rechfactnidenpm.php?cle=".$mois."") ;
		}
	}
?>