<?php

session_start();
require_once('connexion.php');
require_once('config.php');
require_once('verifications.php');
$user	= $pseudo;
$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$user'")->fetch_array();
$profil	= $pro["PROF"];

//récupération du formulaire
$id 		= $_POST['cle'];
$tel		= $_POST['tel'];
$nom		= $_POST['nom'];
$pnom		= $_POST['pnom'];
$email		= $_POST['mail'];
$loguser	= $_POST['pseudo'];
$nouv_passe	= $_POST['nouv_passe'];
$nouv_passe2= $_POST['nouv_passe2'];


	$mdb =$nouv_passe;
	$nouv_passe=md5($nouv_passe);
	mysql_query("UPDATE user SET passe='$nouv_passe' WHERE id='$id' ") or die ('Erreur : '.mysql_error());

	$requete = mysql_query("UPDATE user SET nom='$nom', prenom='$pnom', email='$email', tel='$tel' WHERE id='$id' ") or die ('Erreur : '.mysql_error());
	if ($requete)
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$user', '$agent', '$fich', '$date', 'RESET PASSWORD', '$nom $pnom') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rissalamodu.php");
	}
?>