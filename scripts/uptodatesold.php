<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');
include("inc/fonctionscalc.php");

	$wakit	 	= date("Y-m-d");		
	$sqlz 		= "SELECT * FROM wfp_chd_djoummah WHERE leave_type='AL' " ;
	$requetez	= $mysqli->query( $sqlz );
	
	while( $resultz = $requetez->fetch_assoc())
	{
		$id		= $resultz["leave_id"];
		$solde	= $resultz["leave_solde"];
		$ldate	= $resultz["leave_ldate"];

		if (strtotime($wakit)>strtotime($ldate))
		{
			$nbjourcong = getEstimCalc($ldate,$wakit);
			$total		= $nbjourcong+$solde;
	
			$sql2 = "UPDATE wfp_chd_djoummah SET leave_ldate='$wakit', leave_solde='$total' WHERE leave_id='$id' ";
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		
			if( $requete2 )
			{		
				$date 		= date("Y-m-d H:i:s");
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MAJ', 'Au $wakit') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			}
			
			else
			{
				echo'Echec Mise à jour <br><br><center><a href="soldeleave.php">retour</a></center>' ;
			}
		}
	}
	header('Location:soldeleave.php');
?>
