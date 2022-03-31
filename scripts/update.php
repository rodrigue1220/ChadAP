<?php

	include("connexion.php");

	$sql1 = "SELECT * FROM wfp_chd_recapbil" ;
	$requete1 = $mysqli->query( $sql1 ) ;
	while( $result1 = $requete1->fetch_assoc()  )
	{	
		$date1 = date('2018-11-07 08:00:00');
		$date2 = $result1["rec_date"];
		
		if($date1>$date2)
		{
			$sql = "UPDATE wfp_chd_recapbil SET rec_datestatefin='2018-11-07 08:00:00' AND rec_statefin='PRINT' ";     
			$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
		}
		
		else
		{
			$sql = "UPDATE wfp_chd_recapbil SET rec_statefin='NOPRINT' ";     
			$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
		}
	}
?>
    
  