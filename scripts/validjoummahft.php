<?php

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	include("inc/fonctionscalc.php");
	
	$id   = $_GET["id"];
	$date = date("Y-m-d H:i:s");
	
	
	$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nopers	= $result['lv_nopers'];

	
	/*$sol 	= $mysqli->query("SELECT leave_solde AS NB FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
	$soldex = $sol['NB'];
	$dsol 	= $mysqli->query("SELECT leave_ldate AS NB FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' ")->fetch_array();
	$dsoldav = $dsol['NB'];*/
					
	$wakit	= $result['lv_deb'];
	$ret	= $result['lv_ret'];
	$drep	= $result['lv_rep'];
	$superv	= $result['lv_sup'];
	$type	= $result['lv_type'];
	$choix	= $result['lv_rr'];
	$nbjour = $result['lv_nombre'];
	
	$datefin= $mysqli->query("SELECT rh_nte AS DT FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();
	$nte	= $datefin['DT'];
	
	if (strtotime($nte)<strtotime($drep))
	{
		header('Location:oops3.php');
	}
	else if ($wakit=="1970-01-01" || $ret=="1970-01-01" || $wakit=="0000-00-00" || $ret=="0000-00-00")
	{
		header('Location:oops5.php');
	}
	
	else if (strtotime($wakit)<0  || strtotime($ret)<0 || strtotime($wakit)=="" || strtotime($ret)=="")
	{
		header('Location:oops5.php');
	}
	else if (strtotime($ret)<=strtotime($wakit))
	{
		header('Location:oops6.php');
	}
	
	else
	{
		/*$firstday	= getFinMois1($wakit);
		$lastday	= getFinMois2($ret);
		$calcav		= getCalcJours($dsoldav,$firstday);
		$calcap		= getCalcJours($dsoldav,$lastday);
		$nbjour 	= $result['lv_nombre'];
		$nbjour 	= getJours2($wakit,$ret,$nbjour);
		$soldav		= $soldex + $calcav;		
		$soldap		= ($soldex+$calcap)-$nbjour;
		
		if (($soldap<0) && ($soldap>=-10))
		{	
			$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_state='ATTENTERH', lv_date='$date', lv_dateav='$firstday', lv_soldav='$soldav', lv_dateap='$lastday', lv_soldap='$soldap'
			WHERE lv_id='$id' ";					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CONFIRMATION', 'Demande $id ATT RH') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalaskdjmrh.php");
				header('Location:djoummah.php');		
			}
			else
			{
				echo("<span class=\"alert alert-danger\">Echec Confirmation <br><br><center><a href=\"djoummah.php\">retour</a></center></span>") ;
			}
		}
		else if ($soldap<-10)
		{
			header('Location:oops2.php');		
		}
		else
		{	*/
			$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_state='ATTENTE', lv_date='$date' WHERE lv_id='$id' ";					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CONFIRMATION', 'Demande $id $type ATT SUP/OIC') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalaskdjmsupft.php");
				header('Location:djoummahft.php');		
			}
			else
			{
				echo("<span class=\"alert alert-danger\">Echec Confirmation <br><br><center><a href=\"djoummahft.php\">retour</a></center></span>") ;
			}
							
	}
?>
