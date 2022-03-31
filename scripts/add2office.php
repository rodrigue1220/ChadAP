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
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
  $type		= $_POST["type"] ;
  $lieu		= $_POST["lieu"] ;
  $details 	= $_POST["det"] ;

		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_gestoffu WHERE goffu_type='$type' AND goffu_offlieu='$lieu' ")->fetch_array();
		
		if($nb['nb']!=0)
		{
			header('Location:oops666khalatt.php?cle=ADDUNI');
			exit();
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_gestoffu (goffu_id, goffu_type, goffu_offlieu, goffu_details)
					VALUES ('', '$type', '$lieu', '$details')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$type $lieu') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:simple.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addflotte.php">retour</a></center>' ;
			}
		}
  
  ?>
