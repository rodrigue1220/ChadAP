<?php

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	include("inc/fonctionscalc.php");
	
	$id   = $_GET["id"];
	$date = date("Y-m-d H:i:s");
	
	
	$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requete	= $mysqli->query( $sql );
	$result 	= $requete->fetch_assoc();
	$nopers		= $result['lv_nopers'];
	$choix		= $result['lv_rr'];
	$repriz		= $result['lv_rep'];
	$datap		= $result['lv_dateap'];
	$soldap		= $result['lv_soldap'];
	$sup		= $result['lv_sup'];
	$oic		= $result['lv_oic'];
	$deb		= $result['lv_deb'];
	$ret		= $result['lv_ret'];
	
	$daterep = $repriz;
	$nombre = $result['lv_nombre'];
	$jour	 = date("Y-m-d");
	$nbjour	= (strtotime($jour)-strtotime($daterep))/86400;
					
	if ($nbjour<0)
	{
		$diffj 	 = getJours($jour,$daterep);
		$diffj   = getJours2($jour,$daterep,$diffj)-1;
		$soldap  = $soldap+$diffj;
	}
	else if ($nbjour>0)
	{
		$diffj 	 = getJours($daterep,$jour);
		$diffj   = getJours2($daterep,$jour,$diffj)-1;
		$soldap  = $soldap-$diffj;
	}

	$sqlw = "UPDATE wfp_chd_rqdjoummah SET lv_state ='EFFECTIVE' WHERE lv_id='$id' ";			
	$mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
	
	if ($choix=="OUI" || $nombre>4)
	{
		$sql3 = "UPDATE wfp_chd_djoummah SET leave_ldate='$repriz', leave_solde='0' WHERE leave_nopers='$nopers' AND leave_type='R&R' ";			
		$requete3 = $mysqli->query($sql3) or die( $mysqli->connect_errno()) ;

		if( $requete3 )
		{
			$sql2 = "UPDATE wfp_chd_djoummah SET leave_ldate='$datap', leave_solde='$soldap' WHERE leave_nopers='$nopers' AND leave_type='AL' ";			
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			include("inc/rissalacaskdjm.php");
			header('Location:simple.php') ;
		}
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Confirmation Reprise<br><br><center><a href=\"djoummahaskconf.php\">retour</a></center></span>") ;
		}
	}
	else
	{
		$sqlx = "UPDATE wfp_chd_djoummah SET leave_ldate='$datap', leave_solde='$soldap' WHERE leave_nopers='$nopers' AND leave_type='AL' ";			
		$requetex = $mysqli->query($sqlx) or die( $mysqli->connect_errno()) ;

		if( $requetex )
		{
			include("inc/rissalacaskdjm.php");
			header('Location:simple.php') ;
		}
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Confirmation Reprise<br><br><center><a href=\"djoummahaskconf.php\">retour</a></center></span>") ;
		}
	}
?>