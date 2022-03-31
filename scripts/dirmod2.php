<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('connexion.php');
	require_once('config.php');
	require_once('verifications.php');

	//récupération du formulaire
	$id 	= $_POST['cle'];
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


	$sql = "UPDATE wfp_chd_dir SET dir_fullname='$fname', dir_titre='$titre', dir_ext='$ext', dir_tel1='$tel',
	dir_tel2='$tel2', dir_tel3='$tel3', dir_thuraya='$thur', dir_csign='$csign', dir_mail='$email',
	dir_unit='$unite', dir_duty='$buro' WHERE dir_id='$id' ";
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	if ($requete)
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MODIFICATION', '$id $email') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header("Location:dirdet.php?ide=".$id."");
	}
?>