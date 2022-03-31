<?php
	require_once('config.php');
	require_once('verifications.php');
	$date	= date("Y-m-d H:i:s");
	if ($pseudo != "zimbos" && $pseudo!="guest")
	{
		/*$agent	= $_SERVER['HTTP_USER_AGENT']; ($pseudo != "administrateur" && $date>"2020-12-14 07:30:59")
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'LOGOUT', 'LOGOUT') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);*/
		//require("logout2.php");
		header('Location:under.php');
	}
?>