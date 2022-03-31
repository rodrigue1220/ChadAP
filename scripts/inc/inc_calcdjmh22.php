<?php
	include('fonctionscalcul.php');
	
	$wakit	= $datedep2;
	$ret	= $dateret2; 
	$type	= $typ2;
	
	if ($type == "AL" || $type == "CTO")
	{
		$nbjour2 = getJours($wakit,$ret);
		$nbjour2 = getJours2($wakit,$ret,$nbjour);
	}
	
	elseif ($type == "PL" || $type == "ML" || $type == "R&R")
	{
		$nbjour2 = getJourNouv($wakit,$ret);
	}	
?>