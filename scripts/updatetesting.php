<?php
	include ("connexion.php");
	$sqlt 		= "SELECT * FROM wfp_chd_personnel WHERE rh_contrat='Fixed Term' OR rh_contrat='Continuing' " ;
	$requetet	= $mysqli->query( $sqlt );
	
	
	while ($resultt=$requetet->fetch_assoc())
	{
		$nopers	= $resultt['rh_nopers'];
		
		$sql2 = "UPDATE wfp_chd_djoummah SET leave_statu='INACTIF' WHERE leave_nopers='$nopers' AND leave_type='AL' ";
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	}
?>