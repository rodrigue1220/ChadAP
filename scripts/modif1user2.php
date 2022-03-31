<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

session_start();
require_once('connexion.php');
require_once('config.php');
require_once('verifications.php');

//récupération du formulaire
$id 		= $_POST['cle'];

$nouv_passe	= $_POST['nouv_passe'];
$nouv_passe2= $_POST['nouv_passe2'];


	$mdb	 	= $nouv_passe;
	$nouv_passe	= md5($nouv_passe);
	
	$requete = mysql_query("UPDATE user SET passe='$nouv_passe' WHERE pseudo='$id' ") or die ('Erreur : '.mysql_error());
	
	if ($requete)
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'RESET_PASSWORD', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("modif1user3.php");
	}
?>