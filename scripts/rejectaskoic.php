<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$id	= $_GET["id"];
	$date	= date("Y-m-d H:i:s");
  
	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$nomoic = $result["nom"];
	$prenomoic = $result["prenom"];

	$existoic = $mysqli->query("SELECT off_id AS ID FROM wfp_chd_officer WHERE off_nom='$nom' AND off_pnom='$prenom'")->fetch_array();
	if($existoic['ID'] = 0)
	{
		header('Location:simple.php');
	}
  		
		$sql = "UPDATE wfp_chd_request SET reqst_statoic='REJET', reqst_state='N/A', reqst_dateactionoic='$date'
				WHERE reqst_id='$id'";
			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;

		$type	= $mysqli->query("SELECT catart_lib AS CAT FROM wfp_chd_catart WHERE catart_nom='$item'")->fetch_array();
		$type	= $type["CAT"];

		if( $requete )
		{
			if ($type == 'FOURN')
			{
				include("inc/rissalarejoicaskfour.php");
				header('Location:simple.php') ;
			}
			else
			{
				include("inc/rissalarejoicaskeq.php");
				header('Location:simple.php') ;	
			}
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION REJET', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		}
			
		else
		{
		echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="accueil.php">retour</a></center>' ;
		}
  
  ?>
