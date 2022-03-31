<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

  $nom		= $_POST["nom"] ;
  $prenom	= $_POST["pnom"] ;
  $unite	= $_POST["unit"] ;


		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_officer WHERE off_unit='$unite' AND off_nom='$nom' AND off_pnom='$prenom' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo'Cet Enregistrement existe deja <br><br><center><a href="addunite.php">retour</a></center>' ;
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_officer(off_id, off_nom, off_pnom, off_unit)
					VALUES ('', '$nom', '$prenom', '$unite')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$nom $unite') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:addunite.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addchauf.php">retour</a></center>' ;
			}
		}
  
  ?>
