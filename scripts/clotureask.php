<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

  $id		= $_POST["id"];
  $heurd	= $_POST["heurd"];
  $mind		= $_POST["mind"];
  $heurr	= $_POST["heurr"];
  $minr		= $_POST["minr"];
  $date	= date("Y-m-d H:i:s");
  
  		$sql = "UPDATE wfp_chd_request SET reqst_deffectif='$heurd $mind', reqst_reffectif='$heurr $minr', reqst_state='EFFECTUE' WHERE reqst_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
					VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CLOTURE', 'Demande $id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:simple.php') ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
  ?>
