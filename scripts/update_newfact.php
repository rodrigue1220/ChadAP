<?php

	include("connexion.php");

	$sql = "SELECT COUNT(*) AS nbr_doublon, MSISDN_NO, MONTH 
			FROM wfp_chd_bilpp WHERE STATE='ATTENTE'
			GROUP BY MSISDN_NO, MONTH HAVING COUNT(*) > 1" ;
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{	
		$numero		= $result["MSISDN_NO"];
		$mois		= $result["MONTH"];
		
		$sql1 		= "SELECT * FROM user WHERE tel='$numero' OR tel2='$numero' " ;
		$requete1	= $mysqli->query( $sql1 );
		$result1 	= $requete1->fetch_assoc();
		
		$nom		= $result1["nom"];
		$pnom		= $result1["prenom"];
		$mail		= $result1["email"];
		
		$exis = $mysqli->query("SELECT maj_id AS ID FROM wfp_chd_majbilling WHERE maj_tel='$numero' AND maj_mois='$mois' ")->fetch_array();
		if($exis['ID'] == 0)
		{
			$sql2 = "INSERT INTO wfp_chd_majbilling (maj_id, maj_nom, maj_pnom, maj_tel, maj_mail, maj_mois, maj_state)
				VALUES ( '', '$nom', '$pnom', '$numero', '$mail', '$mois', '') ";
			$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
		}
		else
		{
			$sql3 = "UPDATE wfp_chd_majbilling SET maj_nom='$nom', maj_pnom='$pnom', maj_tel='$numero', maj_mail='$mail', maj_mois='$mois' 
					WHERE maj_tel='$numero' AND maj_mois='$mois' ";
			$mysqli->query($sql3) or die ('Erreur '.$sql3.' '.$mysqli->error);
		}
	}
?>