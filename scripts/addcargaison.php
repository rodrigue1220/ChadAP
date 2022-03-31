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
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}
	
	$orig	= $_POST["orig"] ;
	$desti	= $_POST["desti"] ;
	$vehi 	= $_POST["vehi"] ;
	$driv 	= $_POST["driver"] ;
	$natc 	= $_POST["natcar"] ;
	$tonn 	= $_POST["tonne"] ;
	$dem 	= strtoupper($_POST["demand"]);
	
	$fori	= strtoupper(substr("$orig", 0, 2)); 
	$fdes	= strtoupper(substr("$desti", 0, 2));
	$dat 	= date("YmdHis");

	$code	= "CARG".$dat."-".$fori."-".$fdes;
		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargo WHERE cargo_desti='$desti' AND cargo_depart='$orig' AND cargo_vehi='$vehi' AND cargo_tonne='$tonn' AND cargo_dem='$dem' AND cargo_nat='$natc'")->fetch_array();
		$cp = $mysqli->query("SELECT cam_capa AS CAPA FROM wfp_chd_cam WHERE cam_plaq='$vehi'")->fetch_array();
		
		if($nb['nb']!=0)
		{
			header('Location:oops666khalatt.php?cle=ADDCARG');
			exit();
		}
		
		else if($cp['CAPA']<$tonn)
		{
			header('Location:oops666khalatt.php?cle=CAPACARG');
			exit();
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_cargo (cargo_id, cargo_number, cargo_desti, cargo_depart, cargo_vehi, cargo_chauf, cargo_nat, cargo_tonne, cargo_dem, cargo_state)
					VALUES ('', '$code', '$desti', '$orig', '$vehi', '$driv', '$natc', '$tonn', '$dem', 'ATTENTE')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$code') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:askflotteat.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="askflotteat.php">retour</a></center>' ;
			}
		}
  
  ?>
