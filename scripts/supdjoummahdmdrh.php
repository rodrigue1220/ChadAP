<?php
	require_once('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("connexion.php");

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminRH")
	{
		header('Location:simple.php');
	}

	$cle  	= $_GET["id"] ;
	$nopers  	= $_GET["nopers"] ;
	$date  	= date("Y-m-d H:i:s");
	
	$sql = "DELETE FROM wfp_chd_rqdjoummah WHERE lv_id='$cle' ";     
	$requete =  $mysqli->query($sql) ;
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'SUPPRESSION', '$cle $nopers') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:rechdjmrh2.php?nopers='.$nopers.'');
	}
	else
	{
		echo'<font size="+2"><i>Echec Suppression</i></font></td></tr></table><br><br>
		<center><a href="rechdjmrh2.php?cle=$nopers">retour</a></center>' ;
	}

?>
    
  