<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	include("inc/fonctionscalc.php");

	$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nopers	= $result['lv_nopers'];

	$sol 	= $mysqli->query("SELECT leave_solde AS NB FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
	$soldex = $sol['NB'];
	$dsol 	= $mysqli->query("SELECT leave_ldate AS NB FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
	$dsoldav = $dsol['NB'];
					
	$wakit	= $result['lv_deb'];
	$ret	= $result['lv_ret'];
	$drep	= $result['lv_rep'];;
					
	$firstday	= getFinMois1($wakit);
	$lastday	= getFinMois2($ret);
	$calcav		= getCalcJours($dsoldav,$firstday);
	$calcap		= getCalcJours($dsoldav,$lastday);
	$nbjour 	= $result['lv_nombre'];
	$nbjour 	= getJours2($wakit,$ret,$nbjour);
	$soldav		= $soldex + $calcav;
	$soldap		= ($soldex+$calcap)-$nbjour;
?>
