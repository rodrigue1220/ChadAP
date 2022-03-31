<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


  $desc		= $_POST["desc"] ;
  $lib		= $_POST["lib"] ;
  $ft		= $_POST["ft"] ;
  $sc		= $_POST["sc"] ;
  $ssa		= $_POST["ssa"] ;


		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_contcong WHERE contcong_type='CONG' AND contcong_nom='$lib' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo'Cet Enregistrement existe deja <br><br><center><a href="addcontcong.php">retour</a></center>' ;
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_contcong (contcong_id, contcong_type, contcong_nom, contcong_lib, contcong_ft, contcong_sc, contcong_ssa)
					VALUES ('', 'CONG', '$lib', '$desc', '$ft', '$sc', '$ssa')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$article') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:gestcontcong.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addcontcong.php">retour</a></center>' ;
			}
		}
  
  ?>
