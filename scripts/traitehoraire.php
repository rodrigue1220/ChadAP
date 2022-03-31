<?php
	include('connexion.php');
	
	$sql = "SELECT * FROM wfp_chd_requestsdr" ;
	$requete = $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$ide	= $result["reqsdr_id"];
		$hd		= $result["reqsdr_heurd"];
		$hf		= $result["reqsdr_heurf"];
		$md		= $result["reqsdr_mind"];
		$mf		= $result["reqsdr_minf"];
		
		$saaa	= $hd.":".$md.":00";
		$saar	= $hf.":".$mf.":00";
		
		$sql2	= "UPDATE wfp_chd_requestsdr SET reqsdr_horaire1='$saaa', reqsdr_horaire2='$saar' WHERE reqsdr_id='$ide' ";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
	}
?>