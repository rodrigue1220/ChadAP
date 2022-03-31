<?php

	//changement de solde concernant le staff sur le 1er type de congés
	if ($typ1=="AL")
	{
		//$restant1	= $soldap-$nbre1;
		$sql1 = "UPDATE wfp_chd_djoummah SET leave_ldate='$datap', leave_solde='$soldap' WHERE leave_nopers='$nopers' AND leave_type='$typ1' ";			
		$mysqli->query($sql1) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ1=="R&R")
	{
		$sql1 = "UPDATE wfp_chd_djoummah SET leave_ldate='$reprise', leave_solde='0' WHERE leave_nopers='$nopers' AND leave_type='$typ1' ";			
		$mysqli->query($sql1) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ1=="PL" || $typ1=="ML" || $typ1=="CTO")
	{
		$sql1 = "UPDATE wfp_chd_djoummah SET leave_solde='$restant1' WHERE leave_nopers='$nopers' AND leave_type='$typ1' ";			
		$mysqli->query($sql1) or die( $mysqli->connect_errno()) ;
	}		
	
		
	//changement de solde concernant le staff sur le 2ème type de congés
	if ($typ2=="AL")
	{
		//$restant2	= $soldap-$nbre2;
		$sql2 = "UPDATE wfp_chd_djoummah SET leave_ldate='$datap', leave_solde='$soldap' WHERE leave_nopers='$nopers' AND leave_type='$typ2' ";			
		$mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ2=="R&R")
	{
		$sql2 = "UPDATE wfp_chd_djoummah SET leave_ldate='$reprise', leave_solde='0' WHERE leave_nopers='$nopers' AND leave_type='$typ2' ";			
		$mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ2=="PL" || $typ2=="ML" || $typ2=="CTO")
	{
		$sql2 = "UPDATE wfp_chd_djoummah SET leave_solde='$restant2' WHERE leave_nopers='$nopers' AND leave_type='$typ2' ";			
		$mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	}		
	
		
	//changement de solde concernant le staff sur le 3ème type de congés
	if ($typ3=="AL")
	{
		//$restant3	= $soldap-$nbre3;
		$sql3 = "UPDATE wfp_chd_djoummah SET leave_ldate='$datap', leave_solde='$soldap' WHERE leave_nopers='$nopers' AND leave_type='$typ3' ";			
		$mysqli->query($sql3) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ3=="R&R")
	{
		$sql3 = "UPDATE wfp_chd_djoummah SET leave_ldate='$reprise', leave_solde='0' WHERE leave_nopers='$nopers' AND leave_type='$typ3' ";			
		$mysqli->query($sql3) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ3=="PL" || $typ3=="ML" || $typ3=="CTO")
	{
		$sql3 = "UPDATE wfp_chd_djoummah SET leave_solde='$restant3' WHERE leave_nopers='$nopers' AND leave_type='$typ3' ";			
		$mysqli->query($sql3) or die( $mysqli->connect_errno()) ;
	}		
	
	
	//changement de solde concernant le staff sur le 4ème type de congés
	if ($typ4=="AL")
	{
		//$restant4	= $soldap-$nbre4;
		$sql4 = "UPDATE wfp_chd_djoummah SET leave_ldate='$datap', leave_solde='$soldap' WHERE leave_nopers='$nopers' AND leave_type='$typ4' ";			
		$mysqli->query($sql4) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ4=="R&R")
	{
		$sql4 = "UPDATE wfp_chd_djoummah SET leave_ldate='$reprise', leave_solde='0' WHERE leave_nopers='$nopers' AND leave_type='$typ4' ";			
		$mysqli->query($sql4) or die( $mysqli->connect_errno()) ;
	}
	elseif ($typ4=="PL" || $typ4=="ML" || $typ4=="CTO")
	{
		$sql4 = "UPDATE wfp_chd_djoummah SET leave_solde='$restant4' WHERE leave_nopers='$nopers' AND leave_type='$typ4' ";			
		$mysqli->query($sql4) or die( $mysqli->connect_errno()) ;
	}		
	
	
?>
