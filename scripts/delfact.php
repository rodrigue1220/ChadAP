<?php
	require_once('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("connexion.php");

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminBILLING")
	{
		header('Location:simple.php');
	}

	$mois  	= $_GET["cle"] ;
	$phone  = $_GET["tel"] ;
	$opt	= $_GET["opt"] ;
	$page	= $_GET["page"] ;
	$date  	= date("Y-m-d H:i:s");
	
	if ($opt=="archv")
	{
		$sql = "UPDATE wfp_chd_bilpp_archv SET STATE='ANNULE' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";     
	}
	else
	{
		$sql = "UPDATE wfp_chd_bilpp SET STATE='ANNULE' WHERE MSISDN_NO='$phone' AND MONTH='$mois' ";     
	}
	$requete =  $mysqli->query($sql) ;
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'SUPPRESSION-ANNUL', '$id $opt') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:rechfactnidenpm.php?cle='.$mois.'&page='.$page.'');
	}
	else
	{
		echo'<font size="+2"><i>Echec Suppression</i></font></td></tr></table><br><br>
		<center><a href="rechfactnidenpm.php?cle=$mois">retour</a></center>' ;
	}

?>
    
  