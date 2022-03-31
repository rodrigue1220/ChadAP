<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


	$desc		= $_POST["desc"] ;
	$cat		= $_POST["cat"] ;

	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_catart WHERE catart_nom='$cat' AND catart_type='CAT' ")->fetch_array();	
	if($nb['nb']!=0)
	{		
		echo 'Cette Cat&eacute;gorie existe deja<br><br><center><a href="catadd.php">retour</a></center>' ;
	}
	
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_catart (catart_id, catart_nom, catart_type, catart_desc)
			VALUES ('', '$cat', 'CAT', '$desc')";
					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{	
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$cat') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:catadd.php');
		}
			
		else
		{
			echo'Echec Ajout <br><br><center><a href="catadd.php">retour</a></center>' ;
		}
	}		
	
?>
