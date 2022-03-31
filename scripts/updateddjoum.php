<?php

	include('connexion2.php');

	/*$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_nopers='8844277' AND lv_date<'2019-10-01 00:00:00' " ;
	$requetez	= $mysqli->query( $sqlz );
	
	while($resultz = $requetez->fetch_assoc())
	{
		$type	   	= $resultz['lv_type'];
		$debut		= $resultz['lv_deb'];
		$retour		= $resultz['lv_ret'];
		$nbre		= $resultz['lv_nombre'];
		$id			= $resultz['lv_id'];
		
		if ($type == "R&R")
		{
			$sql = "UPDATE wfp_chd_rqdjoummah SET lv_type1='R&R', lv_deb1='$debut', lv_fin1='$retour', lv_nbr1='$nbre' WHERE lv_id='$id'";			
			$mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		}
		else
		{
			$sql = "UPDATE wfp_chd_rqdjoummah SET lv_type1='AL', lv_deb1='$debut', lv_fin1='$retour', lv_nbr1='$nbre' WHERE lv_id='$id'";			
			$mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		}
	}	*/ 
	//SELECT * FROM `wfp_chd_rqdjoummah` WHERE lv_type1='0000-00-00' OR lv_type2='0000-00-00' OR lv_type3='0000-00-00' OR lv_type4='0000-00-00' 
	
/* 	$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_type='R&R' ";
	$requetez	= $mysqli->query( $sqlz );
	
	while($resultz = $requetez->fetch_assoc())
	{
		/* $debut		= $resultz['lv_deb'];
		$retour		= $resultz['lv_ret'];
		$nbre		= $resultz['lv_nombre'];
		$id			= $resultz['lv_id'];
		$rr			= $resultz['lv_rr'];

		$sql = "UPDATE wfp_chd_rqdjoummah SET lv_selfs='$rr' WHERE lv_id='$id'";			
		$mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	}  */
	//UPDATE wfp_chd_rqdjoummah SET lv_type2="", lv_type3="", lv_type4="" WHERE lv_type is NULL AND lv_rr='OUI' AND lv_nombre=0
	
	/* $sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_type is NULL AND lv_rr='OUI' AND lv_nombre!='0'  ";
	$requetez	= $mysqli->query( $sqlz );
	
	while($resultz = $requetez->fetch_assoc())
	{
		$debut		= $resultz['lv_deb'];
		$retour		= $resultz['lv_ret'];
		$nbre		= $resultz['lv_nombre'];
		$id			= $resultz['lv_id'];

		$sql = "UPDATE wfp_chd_rqdjoummah SET lv_type1='AL+R&R', lv_deb1='$debut', lv_fin1='$retour', lv_nbr1='$nbre' WHERE lv_id='$id'";			
		$mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	} */
	
	$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah_copy";
	$requetez	= $mysqli->query( $sqlz );
	
	while($resultz = $requetez->fetch_assoc())
	{
		$reprise	= $resultz['lv_rep'];
		$id			= $resultz['lv_id'];

		$sql = "UPDATE wfp_chd_rqdjoummah SET lv_rep='$reprise' WHERE lv_id='$id'";			
		$mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	}
?>
 