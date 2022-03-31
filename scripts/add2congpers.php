<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


	$cong	= $_POST["cong"] ;
	$nopers	= $_POST["nopers"] ;
	$nombre	= $_POST["nbre"] ;
	$dsold	= $_POST["dsold"] ;
	$dsold	= date('Y-m-d',strtotime($dsold));
	$etat	= "";

		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$cong' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo'Cet Enregistrement existe deja veuillez plutot allez a Ajuster Solde  <br><br><center><a href="addcongpers">retour</a></center>' ;
		}
		
		else 
		{
			$sql 		= "SELECT * FROM wfp_chd_personnel WHERE rh_nopers='$nopers' " ;
			$requete 	= $mysqli->query( $sql ) ;
			$result 	= $requete->fetch_assoc();
	
			$nom		= $result["rh_fname"];
			$prenom 	= $result["rh_lname"];
			$cont		= $result["rh_contrat"];
			
			if ($cong=="AL" && ($cont=="Fixed Term" || $cont=="Continuing"))
			{
				$etat="INACTIF";
			}
		
			$sql2 = "INSERT INTO wfp_chd_djoummah (leave_id, leave_nopers, leave_nom, leave_pnom, leave_type, leave_ldate, leave_solde, leave_statu)
					VALUES ('', '$nopers', '$prenom', '$nom', '$cong', '$dsold', '$nombre', '$etat')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$nopers $nom $prenom') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:addcongpers.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addcongpers.php">retour</a></center>' ;
			}
		}
  
  ?>
