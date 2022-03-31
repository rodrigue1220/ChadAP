<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminFOURN")
	{
		header('Location:simple.php');
	}
	
	$desc		= $_POST["desc"] ;
	$item		= $_POST["item"] ;
	$seuil		= $_POST["seuil"] ;
	
	$maxi	= $mysqli->query("SELECT MAX(catart_id) AS MX FROM wfp_chd_catart")->fetch_array();	
	if ($maxi['MX']=="NULL")
	{
		$maxi = 1;
	}
	else
	{
		$maxi 	= $maxi['MX']+1;
	}
	
	$code	= "TCDWFPART-".$maxi;
	

	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_catart WHERE catart_nom='$item' AND catart_type='ART' AND catart_lib='FOURN' ")->fetch_array();	
	if($nb['nb']!=0)
	{		
		header('Location:oops666khalatt.php?cle=ARTADD');
		exit();
	}
	
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_catart (catart_id, catart_code, catart_nom, catart_type, catart_desc, catart_lib, catart_seuil)
			VALUES ('', '$code', '$item', 'ART', '$desc', 'FOURN', '$seuil')";
					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{	
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$item $cat') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:articaddfourn.php');
		}
			
		else
		{
			echo'Echec Ajout <br><br><center><a href="articaddfourn.php">retour</a></center>' ;
		}
	}		
	
?>