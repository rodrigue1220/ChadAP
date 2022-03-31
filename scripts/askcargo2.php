<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	/*$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}*/
	
	$dmd	= $pseudo;
	$nom 	= $mysqli->query("SELECT nom AS ID FROM user WHERE pseudo='$dmd' ")->fetch_array();
	$nom	= $nom['ID'];
	$prenom = $mysqli->query("SELECT prenom AS ID FROM user WHERE pseudo='$dmd' ")->fetch_array();
	$prenom	= $prenom['ID'];
	
	$orig	= $_POST["orig"] ;
	$desti	= $_POST["desti"] ;
	$natc 	= $_POST["natcar"] ;
	$tonn 	= $_POST["tonne"] ;
	$proj	= $_POST["proj"] ;
	$dist	= $_POST["dist"] ;
	$dure 	= $_POST["dure"] ;
	$vol 	= $_POST["vol"] ;
	
	$ddr	= $nom.",".$prenom;
	$dem 	= strtoupper($ddr);
	
	$fori	= strtoupper(substr("$orig", 0, 3)); 
	$fdes	= strtoupper(substr("$desti", 0, 3));
	$dat 	= date("YmdHis");
	
	$date 	= date("Y-m-d H:i:s");

	$code	= "RFT".$dat."-".$fori."-".$fdes;
		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargodem WHERE cargodem_desti='$desti' AND cargodem_depart='$orig' AND cargodem_tonne='$tonn' AND cargodem_vol='$vol' AND cargodem_dem='$dem' AND cargodem_nat='$natc'")->fetch_array();
		
		if($nb['nb']!=0)
		{
			header('Location:oops666khalatt.php?cle=ADDCARG');
			exit();
		}
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_cargodem (cargodem_id, cargodem_date, cargodem_number, cargodem_desti, cargodem_depart, cargodem_nat, cargodem_tonne, cargodem_vol, cargodem_tonnecharge, cargodem_volcharge, cargodem_dist, cargodem_dure, cargodem_proj, cargodem_dem, cargodem_state, cargodem_officer, cargodem_dofficer)
					VALUES ('', '$date', '$code', '$desti', '$orig', '$natc', '$tonn', '$vol', '', '', '$dist', '$dure', '$proj', '$dem', 'ATTENTE', '', '')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$code $dem') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:askcargo.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="askcargo.php">retour</a></center>' ;
			}
		}
  
  ?>
