<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($pseudo != "zimbos" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}

	$id		= $_POST["id"] ;
	$idex	= $_POST["idex"] ;
  		
	$sql = "UPDATE user SET indexid='$idex' WHERE id='$id' ";		
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MODIFICATION INDEX', '$nom $prenom $idex') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:indexlist.php') ;
	}
		
	else
	{
		echo'<font size="+2"><i>Echec Assignation</i></font><br><br><center><a href="simple.php">retour</a></center>' ;
	}
  
?>