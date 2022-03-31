<?php

	include("connexion.php");

	$sql = "SELECT * FROM wfp_chd_recapcto WHERE rcto_mois='2021-05' AND rcto_durover>'00:00:00' " ;
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{	
		$over	= $result["rcto_durover"];
		$iden	= $result["rcto_id"];

		$sql3 = "UPDATE wfp_chd_recapcto SET rcto_durcto='$over' WHERE rcto_id='$iden' ";
			$mysqli->query($sql3) or die ('Erreur '.$sql3.' '.$mysqli->error);
	}
?>