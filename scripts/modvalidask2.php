<?php
include('connexion.php');
require_once('config.php');
require_once('verifications.php');

  $id		= $_POST["id"];
  $chauf	= $_POST["chauf"];
  $vehicle	= $_POST["vehi"];
  $date	= date("Y-m-d H:i:s");
  
  		$sql = "UPDATE wfp_chd_request SET reqst_chauf='$chauf', reqst_vehicle='$vehicle', reqst_state='VALIDE', reqst_dateaction='$date'
				WHERE reqst_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
					VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MODIFICATION', 'Demande $id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:simple.php') ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Modification</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
  ?>
