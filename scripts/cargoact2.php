<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}
	
	$id		= $_POST["ide"] ;
	$option	= $_POST["choix"] ;
	$page	= $_POST["page"] ;
	$wakit	= $_POST["wakit"] ;
	$heurd	= $_POST["heurd"] ;
	$mind	= $_POST["mind"] ;
	
	$sqlvc 	= "SELECT * FROM wfp_chd_cargo WHERE cargo_id='$id' ";
	$reqvc  = $mysqli->query( $sqlvc );
	$resvc  = $reqvc->fetch_assoc();
	$vehi   = $resvc["cargo_vehi"];
	$driv	= $resvc["cargo_chauf"];
	$demand	= $resvc["cargo_numberdem"];
	$number	= $resvc["cargo_ref"];
	$drvnom		= stristr($driv, ',', true);
	$drvprenom 	= substr(stristr($driv, ','), 1);
	
	$wakit 	= date('Y-m-d',strtotime($wakit));
	$saaa	= $heurd.":".$mind.":00";	
	$wasaa	= $wakit." ".$saaa;
	
	$dept	= $mysqli->query("SELECT cargodem_depart AS DEP FROM wfp_chd_cargodem WHERE cargodem_number='$demand'")->fetch_array();
	$orig	= $dept["DEP"];
  	

	if($option=="CHRG")
	{
		$sqlup	 = "UPDATE wfp_chd_cargo SET cargo_state='CHARGE', cargo_dcharge='$wakit', cargo_hcharge='$saaa' WHERE cargo_id='$id' ";
		$requp	 = $mysqli->query($sqlup) or die( $mysqli->connect_errno()) ;
	
		if( $requp )
		{
			$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargo WHERE cargo_state='' AND cargo_numberdem='$demand' ")->fetch_array();		
			if($nb['nb']==0)
			{
				$sqldem = "UPDATE wfp_chd_cargodem SET cargodem_state='CHARGE' WHERE cargodem_number='$demand' ";
				$mysqli->query($sqldem) or die ('Erreur '.$sqldem.' '.$mysqli->error);
			}
		
			$sqlcam = "UPDATE wfp_chd_cam SET cam_state='CHARGE' WHERE cam_plaq='$vehi' ";
			$mysqli->query($sqlcam) or die ('Erreur '.$sqlcam.' '.$mysqli->error);
		
			$sqlchf = "UPDATE wfp_chd_chauffeur SET chauf_state='CHARGE' WHERE chauf_nom='$drvnom' AND chauf_pnom='$drvprenom'";
			$mysqli->query($sqlchf) or die ('Erreur '.$sqlchf.' '.$mysqli->error);
			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION_CHARGEMENT', '$id $number') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:gestcharge.php") ;
		}
		else
		{
			header('Location:oops666khalatt.php?cle=ASSIGNCARG');
			exit();
		}
	}
	else if ($option=="MSERTE")
	{
		$sql = "UPDATE wfp_chd_cargo SET cargo_state='EN_ROUTE', cargo_droute='$wakit', cargo_hroute='$saaa' WHERE cargo_id='$id' ";
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		
		if( $requete )
		{
			$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargo WHERE cargo_state='CHARGE' AND cargo_numberdem='$demand' ")->fetch_array();		
			if($nb['nb']==0)
			{
				$sqldem = "UPDATE wfp_chd_cargodem SET cargodem_state='EN_ROUTE' WHERE cargodem_number='$demand' ";
				$mysqli->query($sqldem) or die ('Erreur '.$sqldem.' '.$mysqli->error);
			}
			
			$sqlcam = "UPDATE wfp_chd_cam SET cam_state='EN_ROUTE' WHERE cam_plaq='$vehi' ";
			$mysqli->query($sqlcam) or die ('Erreur '.$sqlcam.' '.$mysqli->error);
		
			$sqlchf = "UPDATE wfp_chd_chauffeur SET chauf_state='EN_ROUTE' WHERE chauf_nom='$drvnom' AND chauf_pnom='$drvprenom'";
			$mysqli->query($sqlchf) or die ('Erreur '.$sqlchf.' '.$mysqli->error);
			
						
			$sql2 = "INSERT INTO wfp_chd_cargotrack (ctrack_id, ctrack_ref, ctrack_posi, ctrack_wakit, ctrack_obs)
					VALUES ('', '$number', '$orig', '$wasaa', 'DEPART')";
			$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION_MISE_EN_ROUTE', '$id $number') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:gestcharge.php") ;
		}
		else
		{
			header('Location:oops666khalatt.php?cle=ASSIGNCARG');
			exit();
		}
	}
	else
	{
		$sql = "UPDATE wfp_chd_cargo SET cargo_state='DECHARGE', cargo_ddcharge='$wakit', cargo_hdcharge='$saaa' WHERE cargo_id='$id' ";
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		
		if( $requete )
		{
			$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargo WHERE cargo_state='EN_ROUTE' AND cargo_numberdem='$demand' ")->fetch_array();		
			if($nb['nb']==0)
			{
				$sqldem = "UPDATE wfp_chd_cargodem SET cargodem_state='DECHARGE' WHERE cargodem_number='$demand' ";
				$mysqli->query($sqldem) or die ('Erreur '.$sqldem.' '.$mysqli->error);
			}
			
			$sqlcam = "UPDATE wfp_chd_cam SET cam_state='DECHARGE' WHERE cam_plaq='$vehi' ";
			$mysqli->query($sqlcam) or die ('Erreur '.$sqlcam.' '.$mysqli->error);
		
			$sqlchf = "UPDATE wfp_chd_chauffeur SET chauf_state='DECHARGE' WHERE chauf_nom='$drvnom' AND chauf_pnom='$drvprenom'";
			$mysqli->query($sqlchf) or die ('Erreur '.$sqlchf.' '.$mysqli->error);
			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION_DECHARGEMENT', '$id $number') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:gestcharge.php") ;
		}
		else
		{
			header('Location:oops666khalatt.php?cle=ASSIGNCARG');
			exit();
		}
	}
?>