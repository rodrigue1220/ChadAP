<?php
	include ("connexion2.php");
	/*$sqlt 		= "SELECT * FROM wfp_chd_djmcto WHERE cto_index='' " ;
	$requetet	= $mysqli->query( $sqlt );
	
	
	while ($resultt=$requetet->fetch_assoc())
	{
		$dem	= $resultt["cto_dem"];
		$id		= $resultt["cto_id"];
		$exis 	= $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$dem' ")->fetch_array();
		$nopers	= $exis['ID'];
		
		$sql2 = "UPDATE wfp_chd_djmcto SET cto_index='$nopers' WHERE cto_id='$id' ";
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	}
	
	$sqlt 		= "SELECT * FROM wfp_chd_catart WHERE catart_type='ART' " ;
	$requetet	= $mysqli->query( $sqlt );
	
	
	while ($resultt=$requetet->fetch_assoc())
	{
		$id		= $resultt["catart_id"];
		$code	= "WFPART-".$id;
		
		$sql2 = "UPDATE wfp_chd_catart SET catart_code='$code' WHERE catart_id='$id' ";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
	}*/
	
	$sqlt 		= "SELECT * FROM wfp_chd_catart" ;
	$requetet	= $mysqli->query( $sqlt );
	
	
	while ($resultt=$requetet->fetch_assoc())
	{
		$nom	= $resultt["catart_nom"];
		$code	= $resultt["catart_code"];
		
		$sql2 = "UPDATE wfp_chd_sandouk SET stock_item='$code' WHERE stock_item='$nom' ";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
	}
	
?>