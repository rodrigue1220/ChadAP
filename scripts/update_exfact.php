<?php

	include("connexion.php");

	$sql = "SELECT * FROM wfp_chd_majbilling WHERE maj_state='' " ;		
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{	
		$numero		= $result["maj_tel"];
		$mois		= $result["maj_mois"];
		
		$exis = $mysqli->query("SELECT ID AS ID FROM wfp_chd_bilpp WHERE MSISDN_NO='$numero' AND MONTH='$mois' AND STATE='ATTENTE' ")->fetch_array();
		if($exis['ID'] == 0)
		{
			$sql3 = "UPDATE wfp_chd_majbilling SET maj_state='TERMINE' WHERE maj_tel='$numero' AND maj_mois='$mois' ";
			$mysqli->query($sql3) or die ('Erreur '.$sql3.' '.$mysqli->error);
		}
	}
?>