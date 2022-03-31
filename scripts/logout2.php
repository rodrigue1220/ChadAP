<?php
require_once('config.php');
require_once('verifications.php');
require_once('connexion.php');

$date	= date("Y-m-d H:i:s");
$agent	= $_SERVER['HTTP_USER_AGENT'];
$fich	= $_SERVER['PHP_SELF'];
$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
	VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'LOGOUT', 'LOGOUT') ";
$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);

session_start();
session_unset();
session_destroy();
//header('Location:under.php');
?>