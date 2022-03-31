<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$id			= $_POST["id"] ;
	$page		= $_POST["pg"] ;
	$genre		= $_POST["sex"] ;
	$poste		= addslashes($_POST["titre"]) ;
	$zone	 	= $_POST["duty"] ;
	$contrat	= $_POST["cont"] ;
	$eod		= $_POST["eod"] ;
	$nopers		= $_POST["nopers"] ;
	$nte		= $_POST["nte"] ;
	
	$alyom 		= date("Y-m-d H:i:s");
	
	$eod 		= date('Y-m-d',strtotime($eod));
	$nte 		= date('Y-m-d',strtotime($nte));
	

	if ($eod=="1970-01-01" || $eod=="0000-00-00" || $nte=="1970-01-01" || $nte=="0000-00-00")
	{
		header('Location:oops5.php');
	}
	if (strtotime($nte)<=strtotime($eod))
	{
		header('Location:oops6.php');
	}
		
	$sql2 = "UPDATE wfp_chd_personnel SET rh_nopers='$nopers', rh_genre='$genre', rh_titre='$poste', rh_duty='$zone', rh_contrat='$contrat', rh_eod='$eod', rh_nte='$nte' WHERE rh_id='$id' ";
				
	$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	if( $requete2 )
	{			
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'MODIFICATION $id', 'Du $eod au $nte $contrat $poste') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header("Location:employlist.php?page=".$page."");
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Modification <br><br><center><a href=\"employlist.php?page=".$page."\">retour</a></center></span>") ;
	}  
?>
