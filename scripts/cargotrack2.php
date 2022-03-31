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
	
	$ref	= $_POST["ref"] ;
	$wakit	= $_POST["wakit"] ;
	$posi 	= $_POST["posi"] ;
	$heur 	= $_POST["heure"] ;
	$min 	= $_POST["min"] ;
	$lib 	= $_POST["obs"] ;
	
	$wakit 	= date('Y-m-d',strtotime($wakit));
	$saaa	= $heur.":".$min.":00";	
	$wasaa	= $wakit." ".$saaa;
	
	$sqlvc 	= "SELECT * FROM wfp_chd_cargo 
				INNER JOIN wfp_chd_cargodem
				ON cargo_numberdem = cargodem_number
				WHERE cargo_ref='$ref' ";
	$reqvc  = $mysqli->query( $sqlvc );
	$resvc  = $reqvc->fetch_assoc();
	$vehi   = $resvc["cargo_vehi"];
	$driv	= $resvc["cargo_chauf"];
	$desti	= $resvc["cargodem_desti"];
	$demand	= $resvc["cargo_numberdem"];
	$drvnom		= stristr($driv, ',', true);
	$drvprenom 	= substr(stristr($driv, ','), 1);
	
	if ($posi==$desti)
	{
		$sqlcar = "UPDATE wfp_chd_cargo SET cargo_state='ARRIVE' WHERE cargo_ref='$ref' ";
		$mysqli->query($sqlcar) or die ('Erreur '.$sqlcar.' '.$mysqli->error);
		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargo WHERE cargo_state='EN_ROUTE' AND cargo_numberdem='$demand' ")->fetch_array();		
		if($nb['nb']==0)
		{
			$sqldem = "UPDATE wfp_chd_cargodem SET cargodem_state='ARRIVE' WHERE cargodem_number='$demand' ";
			$mysqli->query($sqldem) or die ('Erreur '.$sqldem.' '.$mysqli->error);
		}

		$sqlcam = "UPDATE wfp_chd_cam SET cam_state='ARRIVE', cam_posi='$desti' WHERE cam_plaq='$vehi' ";
		$mysqli->query($sqlcam) or die ('Erreur '.$sqlcam.' '.$mysqli->error);
		
		$sqlchf = "UPDATE wfp_chd_chauffeur SET chauf_state='ARRIVE', chauf_posi='$desti' WHERE chauf_nom='$drvnom' AND chauf_pnom='$drvprenom'";
		$mysqli->query($sqlchf) or die ('Erreur '.$sqlchf.' '.$mysqli->error);
		
		$lib	="ARRIVE";
	}

	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cargotrack WHERE ctrack_ref='$ref' AND ctrack_posi='$posi' ")->fetch_array();
	if($nb['nb']!=0)
	{
		header('Location:oops666khalatt.php?cle=ADDCTRACK');
		exit();
	}
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_cargotrack (ctrack_id, ctrack_ref, ctrack_posi, ctrack_wakit, ctrack_obs)
				VALUES ('', '$ref', '$posi', '$wasaa', '$lib')";
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			
		if( $requete2 )
		{	
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$code $dem') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:cargotrack.php');
		}
			
		else
		{
			echo'Echec Ajout <br><br><center><a href="cargotrack.php">retour</a></center>' ;
		}
	}
?>
