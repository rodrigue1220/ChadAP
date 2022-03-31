<?php
require('ctrl.php');
require_once('connexion.php');
require_once('config.php');
require_once('verifications.php');

//récupération du formulaire
$yom 	= $_POST['wakit'];
$saa1	= $_POST['deb'];
$saa2	= $_POST['fin'];
$dem	= $pseudo;
$alyom 	= date("Y-m-d H:i:s");
$jour	= date('l', strtotime($yom)); 
$yom2 	= date('Y-m-d',strtotime($yom));

/*echo $yom; echo '<br />';
echo date('l', strtotime($yom)); echo '<br />';
echo $saa1; echo '<br />';
echo $saa2;
	*/
	$exist	= $mysqli->query("SELECT pgym_id AS ID FROM wfp_chd_progym WHERE pgym_jour='$jour' AND pgym_deb='$saa1' AND pgym_fin='$saa2' ")->fetch_array();		
	if ($exist["ID"]==0)
	{
		header('Location:oops662.php?cle=NPLAN');
		exit();
	}
	
	$pgymeq	= $mysqli->query("SELECT pgym_eqp AS ID FROM wfp_chd_progym WHERE pgym_jour='$jour' AND pgym_deb='$saa1' AND pgym_fin='$saa2' ")->fetch_array();		
	$equipe = $pgymeq["ID"];
	
	$result = $mysqli->query("SELECT COUNT(*) AS nbr FROM wfp_chd_progymrv WHERE pgymrv_jour='$yom' AND pgymrv_eqp='$equipe' ")->fetch_array();;
	$nombre	= $result["nbr"];
	if ($nombre >= 5)
	{
		header('Location:oops662.php?cle=NBFULL');
		exit();
	}
	
	$exist3	= $mysqli->query("SELECT pgymrv_id AS NB FROM wfp_chd_progymrv WHERE pgymrv_user='$dem' AND pgymrv_jour='$yom' AND pgymrv_eqp='$equipe' ")->fetch_array();		
	if ($exist3["NB"]!=0)
	{
		header('Location:oops662.php?cle=DOUBL');
		exit();
	}
	
	$sql2 = "INSERT INTO wfp_chd_progymrv (pgymrv_id, pgymrv_jour, pgymrv_user, pgymrv_eqp, pgymrv_date) 
		VALUES ('', '$yom', '$dem', '$equipe', '$alyom')" ;		
	$req2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	//$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
	if ($req2)
	{		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'RESERVATION', '$dem $equipe $yom') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:booksgym.php');
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Reservation <br><br><center><a href=\"booksgym.php\">retour</a></center></span>") ;
	}	
?>