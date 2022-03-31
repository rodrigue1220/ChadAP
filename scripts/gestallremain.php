<?php
include('ctrl.php');
include('connexion.php');


	$date	= date("Y-m-d H:i:s");
	
	$exis = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_bilpp WHERE STATE='ATTENTE' ")->fetch_array();
	if($exis['nb'] != 0)
	{
		$sql = "SELECT DISTINCT MONTH, MSISDN_NO  FROM wfp_chd_bilpp WHERE (MSISDN_NO='$phone' OR MSISDN_NO='$phone2') AND STATE='ATTENTE' " ;
		$requete = $mysqli->query( $sql ) ;
		while( $result = $requete->fetch_assoc()  )
		{		
			$phone = $result['MSISDN_NO'];
			$mois = $result['MONTH'];	
	
			$tabpriv = $mysqli->query("SELECT SUM(CHARGABLE_AMOUNT) AS som, SUM(CALL_DURATION) AS tps, COUNT(ID) AS nb FROM wfp_chd_bilpp 
				WHERE MONTH='$mois' AND MSISDN_NO='$phone' AND ORIGINAL_CALL_TYPE LIKE '%MO%' AND (SUBSTR(CALLED_NO, 1, 4)!='6699' AND SUBSTR(CALLED_NO, 1, 7)!='2356699') AND PRIV_OFF='PRIV' ")->fetch_array();
	
			$totalpriv 		= $tabpriv['som'];
			$privtotal 		= $tabpriv['nb'];
			$totalprivmin	= $tabpriv['tps'] / 60;
	
			$exist = $mysqli->query("SELECT rec_id AS ID FROM wfp_chd_recapbil WHERE rec_phone='$phone' AND rec_mois='$mois' ")->fetch_array();
			if($exist['ID'] != 0)
			{
				$sqlw = "UPDATE wfp_chd_recapbil SET rec_totpriv='$totalpriv', rec_totoff='0', rec_privtot='$privtotal', rec_offtot='0', rec_privtotmin='$totalprivmin', rec_offtotmin='0', rec_date='$date' 
				WHERE rec_phone='$phone' AND rec_mois='$mois' ";
				$requetew = $mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
			}
			else
			{
				$sqlz = "INSERT INTO wfp_chd_recapbil (rec_id, rec_phone, rec_mois, rec_totpriv, rec_totoff, rec_privtot, rec_offtot, rec_privtotmin, rec_offtotmin, rec_date)
				VALUES ('', '$phone', '$mois', '$totalpriv', '0', '$privtotal', '0', '$totalprivmin', '0', '$date') ";
				$requetez = $mysqli->query($sqlz) or die( $mysqli->connect_errno()) ;
			}

  		$sql = "UPDATE wfp_chd_bilpp SET STATE='IDENTIFIE', DATE_IDEN='$date'
				WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'FIN IDENTIFICATION', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:gouroussphone.php") ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Identification</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
?>