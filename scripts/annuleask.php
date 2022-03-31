<?php
include('connexion.php');

  $id	= $_GET["id"];
  $date	= date("Y-m-d H:i:s");
  
  		$sql = "UPDATE wfp_chd_request SET reqst_state='ATTENTE', reqst_dateaction='$date'
				WHERE reqst_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			header('Location:accueil.php') ;
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
  ?>
