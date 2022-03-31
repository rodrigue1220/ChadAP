<?php
	include('fonctionscalcul.php');
	
	$wakit	= $datedep1;
	$ret	= $dateret1; 
	$type	= $typ1;
	
	if ($type == "AL" || $type == "CTO")
	{
		$nbjour1 = getJours($wakit,$ret);
		$nbjour1 = getJours2($wakit,$ret,$nbjour);
	}
	
	elseif ($type == "PL" || $type == "ML" || $type == "R&R")
	{
		$nbjour1 = getJourNouv($wakit,$ret);
	}	
?>