<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
  	include("connexion.php");

	$id 	= $_POST["idt"];
	$page 	= $_POST["pg"];
	$date	= date("Y-m-d H:i:s");
	$comm 	= addslashes($_POST["librej"]);
	
    $sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='ANNULE', lv_lib='$comm' WHERE lv_id='$id' ";    

	$requete =  $mysqli->query($sql) ;
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ANNULATION_RH', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		//include("inc/rissalaskdjanrh.php");
		header("Location:rapdjmrh.php?page=".$page."") ;
	}
	else
	{
		echo("<font size=\"+2\"><i>Echec ANNULATION</i></font></td></tr></table><br><br>
		<center><a href=\"rapdjmrh.php?page=".$page."\">retour</a></center>") ;
	}

?>
    
  