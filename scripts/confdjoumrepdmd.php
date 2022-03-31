<?php

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$id   = $_GET["id"];
	$date = date("Y-m-d H:i:s");
	
	
	$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requete	= $mysqli->query( $sql );
	$result 	= $requete->fetch_assoc();
	
	$oic		= $result['lv_oic'];
	$sup		= $result['lv_sup'];
	$nopers		= $result['lv_nopers'];
	$deb1		= $result['lv_deb1'];
	$fin1		= $result['lv_fin1'];
	$typ1		= $result['lv_type1'];
	$nbre1		= $result['lv_nbr1'];
	$deb2		= $result['lv_deb2'];
	$fin2		= $result['lv_fin2'];
	$typ2		= $result['lv_type2'];
	$nbre2		= $result['lv_nbr2'];
	$deb3		= $result['lv_deb3'];
	$fin3		= $result['lv_fin3'];
	$typ3		= $result['lv_type3'];
	$nbre3		= $result['lv_nbr3'];
	$deb4		= $result['lv_deb4'];
	$fin4		= $result['lv_fin4'];
	$typ4		= $result['lv_type4'];
	$nbre4		= $result['lv_nbr4'];
	$datap		= $result['lv_dateap'];
	$reprise	= $result['lv_rep'];
	$opt		= $result['lv_selfs'];
	$soldap		= $result['lv_soldap'];
	
	include("inc/varecup.php");
	
	$restant1	= $nb1-$nbre1;
	$restant2	= $nb2-$nbre2;
	$restant3	= $nb3-$nbre3;
	$restant4	= $nb4-$nbre4;
	
	$sqlw 		= "UPDATE wfp_chd_rqdjoummah SET lv_state ='EFFECTIVE' WHERE lv_id='$id' ";			
	$requetew 	= $mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
	
	if ( $requetew )
	{
		include("inc/varupdate.php");
		include("inc/rissalacaskdjmdmd.php");
		header('Location:djoummah.php') ;
	}
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Confirmation Reprise<br><br><center><a href=\"djoummahaskconfdmd.php\">retour</a></center></span>") ;
	}
?>