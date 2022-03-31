<?php
	include('fonctionscalcul.php');
	
	$wakit	= $datedep3;
	$ret	= $dateret3; 
	$type	= $typ3;
	
	if ($type == "AL" || $type == "CTO")
	{
		$nbjour3 = getJours($wakit,$ret);
		$nbjour3 = getJours2($wakit,$ret,$nbjour);
	}
	
	elseif ($type == "PL" || $type == "ML" || $type == "R&R")
	{
		$nbjour3 = getJourNouv($wakit,$ret);
	}	
?>