<?php

function getFinMois1($datex)
	{
		$cald		= date_parse($datex);
		$mcald		= $cald["month"];
		$ycald		= $cald["year"];
		$dcald		= $cald["day"];
		$datefin	= strftime("%Y%m%d",mktime(0,0,0,$mcald,0,$ycald));
		$datefin	= date("Y-m-d", strtotime($datefin));
		return $datefin;
	}
	
function getFinMois2($datex)
	{	
		$cald		= date_parse($datex);
		$mcald		= $cald["month"];
		$ycald		= $cald["year"];
		$dcald		= $cald["day"];
		$datefin	= strftime("%Y%m%d",mktime(0,0,0,$mcald+1,0,$ycald));
		$datefin	= date("Y-m-d", strtotime($datefin));
		return $datefin;
	}
	
function getCalcJours($date1,$date2)
	{
		$eod	= $date1;
		$mois	= date_parse($eod);
		$m		= $mois["month"];
		$y		= $mois["year"];
		$d		= $mois["day"];
		
	
		$mois	= mktime( 0, 0, 0, $m, $d, $y ); 
		$jour 	= $date2;
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
	
		if ($days<4)
		{
			$congjour = 0;
		}
		else if ($days<10)
		{
			$congjour = 0.5;
		}
		else if ($days<16)
		{
			$congjour = 1;
		}
		else if ($days<22)
		{
			$congjour = 1.5;
		}
		else if ($days<28)
		{
			$congjour = 2;
		}
		else 
		{
			$congjour = 2.5;
		}
	
		$nbjourcong = ($years*12*2.5)+($months*2.5)+$congjour;
		
		return $nbjourcong;
	}
function getEstimCalc($date1,$date2)
	{
		$eod	= $date1;
		$mois	= date_parse($eod);
		$m		= $mois["month"];
		$y		= $mois["year"];
		$d		= $mois["day"];
		
	
		$mois	= mktime( 0, 0, 0, $m, $d, $y ); 
		$jour 	= $date2;
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
	
		if ($days<4)
		{
			$congjour = 0;
		}
		else if ($days<10)
		{
			$congjour = 0.5;
		}
		else if ($days<16)
		{
			$congjour = 1;
		}
		else if ($days<22)
		{
			$congjour = 1.5;
		}
		else if ($days<28)
		{
			$congjour = 2;
		}
		else 
		{
			$congjour = 2.5;
		}
	
		$nbjourcong = ($years*12*2.5)+($months*2.5)+$congjour;
		
		return $nbjourcong;
	}
	
function getJours2($datedeb,$datefin,$nombre)
	{
		include('connexion.php');
		$nb_jours=$nombre;
		$dated=strtotime($datedeb);
		$datef=strtotime($datefin);

		while($dated<=$datef)
		{
			$sqls = "SELECT * FROM wfp_chd_crualjf " ;
			$requetes = $mysqli->query( $sqls ) ;
			while( $results = $requetes->fetch_assoc()  )
			{
				$datexy = $results['jf_date'];
				$datexy = strtotime($datexy);
				if($dated==$datexy)
				{
					$nb_jours--;
				}
			}	
			$dated=$dated+86400;
		}
		return $nb_jours;
	}

function getJours($datedeb,$datefin)
	{
		$nb_jours=0;
		$dated=explode('-',$datedeb);
		$datef=explode('-',$datefin);
		$timestampcurr=mktime(0,0,0,$dated[1],$dated[2],$dated[0]);
		$timestampf=mktime(0,0,0,$datef[1],$datef[2],$datef[0]);
		while($timestampcurr<$timestampf)
		{
			if((date('w',$timestampcurr)!=0)&&(date('w',$timestampcurr)!=6))
			{
				$nb_jours++;
			}
		
			$timestampcurr=mktime(0,0,0,date('m',$timestampcurr),(date('d',$timestampcurr)+1)   ,date('Y',$timestampcurr));
		}
		if ((date('w',$timestampf)!=0)&&(date('w',$timestampf)!=6))
		{
			return $nb_jours+1;
		}
		else
		{
			return $nb_jours;
		}
	}	
?>