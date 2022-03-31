<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('connexion2.php');
	require_once('config.php');
	require_once('verifications.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];

	if ($profil == "AdminFLEET")
	{
		include("inc/headers.php");
		include("inc/botoune.php");
		include("inc/botounekabir1.php");
		echo ("<br /><br /><br />");
	}
	else if ($profil == 'AdminFLEETSO')
	{
		include("inc/headers.php");
		include("inc/taarikh.php");
		include("inc/botoune.php");
		include("inc/botounekabir4.php");
		echo ("<br /><br /><br />");
	}
	else if ($pseudo == "administrateur")
	{
		//include("inc/headers.php");
		include("inc/taarikh.php");
		//include("inc/botoune.php");
		include("inc/botounekabir.php");
		echo ("<br /><br /><br />");
	}
	else if ($profil == 'AdminSDR')
	{
		include("inc/headers.php");
		include("inc/taarikh.php");
		//include("inc/botoune.php");
		include("inc/botounekabir3.php");
		//echo ("<br /><br /><br />");
	}
	else
	{
		include("inc/headers.php");
		//include("inc/botoune.php");
		
		include("inc/taarikh.php");
		include("inc/botounekabir2.php");
		//echo ("<br /><br /><br />");
	}
        

?>