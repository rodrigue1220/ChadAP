<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($pseudo != "administrateur" && $profil!= "ADMINSYS")
	{
		header('Location:simple.php');
	}
	
  	include("connexion.php");

	$id  = $_GET["id"] ;
	$date  = date("Y-m-d H:i:s");
	
	$pro2	= $mysqli->query("SELECT profil AS PROF FROM user WHERE id='$id'")->fetch_array();
	$prof2	= $pro2["PROF"];
	
	if($prof2=="ADMINSYS" && $pseudo != "administrateur")
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'TENTA_SUPPRESSION PROFIL', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:oopsad.php');
	}
	else
	{
		$sql = "UPDATE user SET profil='' WHERE id='$id' ";
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'SUPPRESSION PROFIL', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:userprofil.php") ;
		}
		else
		{
			echo'<font size="+2"><i>Echec Suppression</i></font></td></tr></table><br><br>
			<center><a href="userprofil.php">retour</a></center>' ;
		}
	}
?>