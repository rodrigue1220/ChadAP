<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("connexion.php");

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminSTOCK" && $profil != "AdminFOURN")
	{
		header('Location:simple.php');
	}
	

	$id		= $_POST["keys"];
	$choix	= $_POST["cx"];
	$refer	= $_POST["ref"];
	$nitem	= $_POST["item"];
	$nbrap	= $_POST["nbr"];
	$comm	= addslashes($_POST["comm"]);
	$date	= date("Y-m-d H:i:s");


	if ($choix == "REJ")
	{
		$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='REJ3', rqeqv_comm='$comm' WHERE rqeqv_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		
		$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV2' ")->fetch_array();
		if($existe['ID'] == 0)
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJET3', rqeqpmt_appro='$pseudo', rqeqpmt_dappro='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			//include("inc/rissalaskeqdesk.php");
			if ($profil == "AdminSTOCK")
			{
				header("Location:listdeqpmtdet.php?id=".$refer."") ;
				exit();
			}
			else 
			{
				header("Location:listdemfourndet.php?id=".$refer."") ;
				exit();
			}
		}
		else
		{
			if ($profil == "AdminSTOCK")
			{
				header("Location:listdeqpmtdet.php?id=".$refer."") ;
				exit();
			}
			else 
			{
				header("Location:listdemfourndet.php?id=".$refer."") ;
				exit();
			}
		}
	}

	elseif ($choix == "ADJ")
	{
		$item 		= stristr($nitem, '>', true);
		$code 		= substr(stristr($nitem, '>'), 1);
		
		$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_itemaprv='$code', rqeqv_nbraprv='$nbrap', rqeqv_comm='$comm' WHERE rqeqv_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		
		if ($profil == "AdminSTOCK")
		{
			header("Location:listdeqpmtdet.php?id=".$refer."") ;
			exit();
		}
		else 
		{
			header("Location:listdemfourndet.php?id=".$refer."") ;
			exit();
		}
	}
  
		
?>
