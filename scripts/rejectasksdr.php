<?php
include('connexion.php');

  $id	= $_GET["id"];
  $date	= date("Y-m-d H:i:s");
  
  		$sql = "UPDATE wfp_chd_requestsdr SET reqsdr_state='REJET', reqsdr_dateact='$date'
				WHERE reqsdr_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION REJET', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:accueil.php') ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Rejet</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
?>
