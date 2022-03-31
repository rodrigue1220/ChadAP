<?php

	$eod	= $ldate;
	$jour	= $wakit;
	$mois	= date_parse($eod);
	$m		= $mois["month"];
	$y		= $mois["year"];
	$d		= $mois["day"];
	$mois	= mktime( 0, 0, 0, $m, $d, $y ); 
	$jour 	= date("Y-m-d", mktime(0,0,0,date("m"),0,date("Y")));
	$datej	= $jour;
	$moisf	= date_parse($jour);
	$mf		= $moisf["month"];
	$yf		= $moisf["year"];
	$df		= $moisf["day"];
	$moisf	= mktime( 0, 0, 0, $mf, $df, $yf );
	$jour	= strtotime($jour);
	$eod	= strtotime($eod);
	$nbjr	= ($jour - $eod)/86400;	
	
	$diff = abs($jour - $eod);

	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	
	if ($days>=0 && $days<4)
	{
		$congjour = 0;
	}
	else if ($days>3 && $days<10)
	{
		$congjour = 0.5;
	}
	else if ($days>9 && $days<16)
	{
		$congjour = 1;
	}
	else if ($days>15 && $days<22)
	{
		$congjour = 1.5;
	}
	else if ($days>21 && $days<28)
	{
		$congjour = 2;
	}
	else 
	{
		$congjour = 2.5;
	}
	
	$nbjourcong = ($years*12*2.5)+($months*2.5)+$congjour;

?>
