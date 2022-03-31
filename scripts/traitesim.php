<?php

include('connexion.php');

	
	$sql = "SELECT * FROM wfp_chd_flotte_airtel" ;
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{
		$phone 	= $result["sim_phone"];
		$type	= $result["sim_type"];
		$mois	= $result["sim_mois"];

		$sqlw = "UPDATE wfp_chd_recapbil SET rec_simtype='$type' WHERE rec_phone='$phone' AND rec_mois='$mois' ";
		$requetew = $mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
	}  
?>