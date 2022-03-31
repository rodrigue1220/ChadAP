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

	$id		= $_POST["id"] ;
	$page	= $_POST["page"] ;
	$vehi	= $_POST["vehi"] ;
	$driv	= $_POST["driver"] ;
	$tonnch	= $_POST["tonnch"] ;
	$volch	= $_POST["volch"] ;

	$sql 	= "SELECT * FROM wfp_chd_cargodem WHERE cargodem_id='$id'" ;
	$requete= $mysqli->query( $sql ) ;
	$result = $requete->fetch_assoc();
	$tonnag = $result['cargodem_tonne'];
	$volum  = $result['cargodem_vol'];
	$numdem = $result['cargodem_number'];
	$posi   = $result['cargodem_depart'];
	$capdch	= $result['cargodem_tonnecharge']+$tonnch;
	$voldch	= $result['cargodem_volcharge']+$volch;
	
	
	$drvnom		= stristr($driv, ',', true);
	$drvprenom 	= substr(stristr($driv, ','), 1);
	
	$etach	= $mysqli->query("SELECT chauf_state AS ETA FROM wfp_chd_chauffeur WHERE chauf_nom='$drvnom' AND chauf_pnom='$drvprenom' ")->fetch_array();		
	$nbch	= $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargo WHERE cargo_chauf='$driv' AND cargo_vehi='$vehi' ")->fetch_array();		
	
	$dat 	= date("YmdHis");
	$code	= "CARGO".$dat."#".$vehi;
	
	$date 	= date("Y-m-d H:i:s");
	
	$sqlcam	= "SELECT * FROM wfp_chd_cam WHERE cam_plaq='$vehi'" ;
	$reqcam = $mysqli->query( $sqlcam ) ;
	$rescam = $reqcam->fetch_assoc();
	$capa 	= $rescam['cam_capa'];
	$vol 	= $rescam['cam_vol'];
	$stat 	= $rescam['cam_state'];
	$capach	= $rescam['cam_capacharge'];
	$volchg	= $rescam['cam_volcharge'];
	
	if ($tonnch>($capa-$capach))
	{
		header('Location:oops666khalatt.php?cle=CAPACARG');
		exit();
	}
	
	if ($etach['ETA']=="ASSIGNE" && $nbch['nb']==0)
	{
		header('Location:oops666khalatt.php?cle=CHOFCARG');
		exit();
	}

	$sqlins	= "INSERT INTO wfp_chd_cargo (cargo_id, cargo_date, cargo_numberdem, cargo_ref, cargo_vehi, cargo_chauf, cargo_tonncharge, cargo_volcharge, cargo_dcharge, cargo_hcharge, cargo_ddcharge, cargo_hdcharge, cargo_droute, cargo_hroute)
				VALUES ('', '$date', '$numdem', '$code', '$vehi', '$driv', '$tonnch', '$volch', '', '', '', '', '', '')";
	$reqins = $mysqli->query($sqlins) or die($mysqli->connect_errno());
	
	if( $reqins )
	{
  		$sqlveh = "UPDATE wfp_chd_cam SET cam_state='ASSIGNE', cam_capacharge='$tonnch', cam_volcharge='$volch', cam_posi='$posi' WHERE cam_plaq='$vehi' ";
		$mysqli->query($sqlveh) or die ('Erreur '.$sqlveh.' '.$mysqli->error);
		
		$sqldem = "UPDATE wfp_chd_cargodem SET cargodem_tonnecharge='$capdch', cargodem_volcharge='$voldch' WHERE cargodem_id='$id' ";
		$mysqli->query($sqldem) or die ('Erreur '.$sqldem.' '.$mysqli->error);
		
		$sqlchf = "UPDATE wfp_chd_chauffeur SET chauf_state='ASSIGNE', chauf_posi='$posi' WHERE chauf_nom='$drvnom' AND chauf_pnom='$drvprenom'";
		$mysqli->query($sqlchf) or die ('Erreur '.$sqlchf.' '.$mysqli->error);
		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];

		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ASSIGNATION_VEHICULE', '$id $vehi $tonnch') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		if($capdch<$tonnag)
		{			
			header("Location:cargoassignrest.php?page=".$page."&ide=".$id."") ;
			exit();
		}
		else
		{
			$sqldem2 = "UPDATE wfp_chd_cargodem SET cargodem_state='ASSIGNE' WHERE cargodem_id='$id' ";
			$mysqli->query($sqldem2) or die ('Erreur '.$sqldem2.' '.$mysqli->error);
			
			header("Location:askflotteat.php?page=".$page."") ;
			exit();
		}
	}
	else
	{
		header('Location:oops666khalatt.php?cle=ASSIGNCARG');
		exit();
	}
  
?>