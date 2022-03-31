<?php

	//récupération des quotas des congés
	$nb1 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ1'")->fetch_array();		
	$nb1 = $nb1['SOL'];
	$dt1 = $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ1'")->fetch_array();		
	$dt1 = $dt1['DT'];
	
	$nb2 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ2'")->fetch_array();		
	$nb2 = $nb2['SOL'];
	$dt2 = $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ2'")->fetch_array();		
	$dt2 = $dt2['DT'];
	
	$nb3 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ3'")->fetch_array();		
	$nb3 = $nb3['SOL'];
	$dt3 = $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ3'")->fetch_array();		
	$dt3 = $dt3['DT'];
	
	$nb4 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ4'")->fetch_array();		
	$nb4 = $nb4['SOL'];
	$dt4 = $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ4'")->fetch_array();		
	$dt4 = $dt4['DT'];
	
	//récupérer le statut du Staff et son Duty
	$duty = $mysqli->query("SELECT rh_duty AS DUT FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();		
	$duty = $duty['DUT'];
	$etat = $mysqli->query("SELECT rh_state AS ETA FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();		
	$etat = $etat['ETA'];
	
?>
