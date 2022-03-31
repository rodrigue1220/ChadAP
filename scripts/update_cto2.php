<?php

	include("connexion.php");
	$ref	= "20:00:00";

	$sql = "SELECT * FROM wfp_chd_recapcto WHERE rcto_mois='2021-05' AND rcto_durcash>'$ref' " ;
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{	
		$cash	= $result["rcto_durcash"];
		$cto	= $result["rcto_durcto"];
		$iden	= $result["rcto_id"];
		
		$over	= $cash - $ref;
		$cto	= $cto + $over;

		$sql3 = "UPDATE wfp_chd_recapcto SET rcto_durcash='$ref', rcto_durcto='$cto' WHERE rcto_id='$iden' ";
			$mysqli->query($sql3) or die ('Erreur '.$sql3.' '.$mysqli->error);
	}
?>