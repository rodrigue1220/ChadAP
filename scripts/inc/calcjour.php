<?php

	/*
	$calc		= date_parse($ret);
	$mcalc		= $calc["month"];
	$ycalc		= $calc["year"];
	$dcalc		= $calc["day"];
	$lastday	= strftime("%Y%m%d",mktime(0,0,0,$mcalc+1,0,$ycalc));
	$lastday	= date("Y-m-d", strtotime($lastday));
	
	$cald		= date_parse($wakit);
	$mcald		= $cald["month"];
	$ycald		= $cald["year"];
	$dcald		= $cald["day"];
	$firstday	= strftime("%Y%m%d",mktime(0,0,0,$mcald,0,$ycald));
	$firstday	= date("Y-m-d", strtotime($firstday));
	
	echo $calcav		= getCalcJours("2019-03-31","2019-09-30")+23.5;echo '<br/>';
	echo $calcap		= getCalcJours("2019-04-00","2019-11-30")+23.5;
	
	function getCalcJours($date1,$date2)
	{*/
		$eod	= "2019-03-31";
		$mois	= date_parse($eod);
		$m		= $mois["month"];
		$y		= $mois["year"];
		$d		= $mois["day"];
		
	
		$mois	= mktime( 0, 0, 0, $m, $d, $y ); 
		$jour 	= "2019-12-31";
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
		else if ($days>=4 && $days<10)
		{
			$congjour = 0.5;
		}
		else if ($days>=10 && $days<16)
		{
			$congjour = 1;
		}
		else if ($days>=16 && $days<22)
		{
			$congjour = 1.5;
		}
		else if ($days>=22 && $days<28)
		{
			$congjour = 2;
		}
		else
		{
			$congjour = 2.5;
		}
	
		echo $years;echo '<br/>';
		echo $months;echo '<br/>';
		echo $days;echo '<br/>';
		echo $nbjourcong = ($years*12*2.5)+($months*2.5)+23.5;
		
		//return $nbjourcong;
	//}
?>
