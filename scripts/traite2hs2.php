<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$heurret	= $_POST["heurr"] ;
	$heurdep	= $_POST["heurd"] ;
	$minret		= $_POST["minr"] ;
	$mindep	 	= $_POST["mind"] ;
	$motif		= addslashes($_POST["lib"]) ;
	$datedep	= $_POST["deb"] ;
	$id			= $_POST["id"] ;
	require('ctrl4.php');
	$saaa		= $heurdep.":".$mindep.":00";
	$saar		= $heurret.":".$minret.":00";
	$alyom 		= date("Y-m-d H:i:s");
	
	$datedep 	= date('Y-m-d',strtotime($datedep));
	
	$datet 		= $datedep." ".$saaa;
	$dater 		= $datedep." ".$saar;
	
	$h1=strtotime($saar);
	$h2=strtotime($saaa);
	$dure = gmdate('H:i:s',$h1-$h2);

	if ($datedep=="1970-01-01")
	{
		header('Location:oops666khalatt.php?cle=DDCTO');
		exit();
	}
	if (strtotime($dater)<=strtotime($datet))
	{
		header('Location:oops666khalatt.php?cle=DSCTO');
		exit();
	}
		
	$sql2 = "UPDATE wfp_chd_djmcto SET cto_deb2='$datedep', cto_hdeb2='$saaa', cto_hfin2='$saar', cto_raison='$motif', cto_dapprover2='$alyom', cto_dure='$dure', cto_statut='EFFECTUE' WHERE cto_id='$id' ";
				
	$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	if( $requete2 )
	{			
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'EFFECTUE', '$motif $datedep') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rissalaskctosup2.php");
		header('Location:va2compenscto.php');
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"va2compenscto.php\">retour</a></center></span>") ;
	}  
?>
