<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');



	$nom	= $_POST["nom"] ;
	$pnom	= $_POST["pnom"] ;
	$nopers	= $_POST["nopers"] ;
	$sex	= $_POST["sex"] ;
	$titre	= $_POST["titre"] ;
	$statu	= $_POST["stat"] ;
	$cont	= $_POST["cont"] ;
	$duty	= $_POST["duty"] ;
	$eod	= $_POST["eod"] ;
	$nte	= $_POST["nte"] ;
	$eod 	= date('Y-m-d',strtotime($eod));
	$nte	= date('Y-m-d',strtotime($nte));


		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_personnel WHERE rh_nopers='$nopers' AND rh_fname='$nom' AND rh_lname='$pnom'")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo'Cet Enregistrement existe deja <br><br><center><a href="addcontcongp.php">retour</a></center>' ;
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_personnel (rh_id, rh_nopers, rh_lname, rh_fname, rh_genre, rh_titre, rh_state, rh_duty, rh_contrat, rh_eod, rh_nte)
					VALUES ('', '$nopers', '$pnom', '$nom', '$sex', '$titre', '$statu', '$duty', '$cont', '$eod', '$nte')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$nopers $nom $pnom') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:addcontcongp.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addcontcongp.php">retour</a></center>' ;
			}
		}
  
  ?>
