<?php

	include("connexion.php");

	$sqlb 	= "SELECT DISTINCT MONTH FROM wfp_chd_bilpp" ;
	$requeteb = $mysqli->query( $sqlb ) ;

	while( $resultb = $requeteb->fetch_assoc() )
	{
		$mois = $resultb['MONTH'];
		$exis = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_month WHERE mth_chahar='$mois' ")->fetch_array();
		if($exis['nb'] == 0)
		{
			$sql2 = "INSERT INTO wfp_chd_month (mth_id, mth_chahar)
				VALUES ( '', '$mois') ";
			$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
		}
	}
?>