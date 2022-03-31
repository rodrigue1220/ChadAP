<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$marque	= $_POST["marq"] ;
	$plaque	= $_POST["immat"] ;
	$details 	= $_POST["det"] ;
	
	$sqle		= $mysqli->query("SELECT unite AS UN FROM user WHERE pseudo='$pseudo' ")->fetch_array();									
	$unite		= $sqle['UN'];
	$sofo		= substr(stristr($unite, '/'), 1);

		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_flotte WHERE flot_marq='$marque' AND flot_immat='$plaque' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo'Cet Enregistrement existe deja <br><br><center><a href="addflotte.php">retour</a></center>' ;
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_flotte (flot_id, flot_marq, flot_immat, flot_det, flot_sens)
					VALUES ('', '$marque', '$plaque', '$details', '$sofo' )";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$marque $plaque') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:simple.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addflotte.php">retour</a></center>' ;
			}
		}
  
  ?>
