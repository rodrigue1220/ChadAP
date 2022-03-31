<?php
// Simple browser and OS detection script. This will not work if User Agent is false.
$agent = $_SERVER['HTTP_USER_AGENT'];

include ('connexion2.php');

$hote	= gethostbyaddr ($_SERVER['REMOTE_ADDR']);
$fich	= $_SERVER['PHP_SELF'];
$date	= date("Y-m-d H:i:s");
$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1)
				VALUES ( '', '$pseudo', '$hote || $agent', '$fich', '$date', 'CONSULTATION') ";
			
$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
?>

