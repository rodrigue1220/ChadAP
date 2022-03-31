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

	$plaque	= $_POST["plaq"] ;
	$marque	= $_POST["marq"] ;
	$capaci = $_POST["capa"] ;
	$volume = $_POST["vol"] ;
		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_cam WHERE cam_plaq='$plaque' ")->fetch_array();
		
		if($nb['nb']!=0)
		{
			header('Location:oops666khalatt.php?cle=ADDCAM');
			exit();
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_cam (cam_id, cam_plaq, cam_marq, cam_capa, cam_vol)
					VALUES ('', '$plaque', '$marque', '$capaci', '$volume')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$plaque') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:addcam.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addcam.php">retour</a></center>' ;
			}
		}
  
  ?>
