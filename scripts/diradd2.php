<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('connexion.php');
	require_once('config.php');
	require_once('verifications.php');

	//récupération du formulaire
	$fname	= $_POST['nom'];
	$titre	= $_POST['titr'];
	$tel	= $_POST['tel'];
	$tel2	= $_POST['tel2'];
	$tel3	= $_POST['tel3'];
	$ext	= $_POST['ext'];
	$email	= $_POST['mail'];
	$csign	= $_POST['csign'];
	$thur	= $_POST['thuraya'];
	$unite	= $_POST['unit'];
	$buro	= $_POST['duty'];


	$sql = "INSERT INTO wfp_chd_dir (dir_id, dir_fullname, dir_titre, dir_ext, dir_tel1, dir_tel2, dir_tel3, dir_thuraya, dir_csign, dir_mail, dir_unit, dir_duty) 
	VALUES ('', '$fname', '$titre', '$ext', '$tel', '$tel2', '$tel3', '$thur', '$csign', '$email', '$unite', '$buro') ";
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	if ($requete)
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CREATION', '$email $fname') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:directory.php');
	}
?>