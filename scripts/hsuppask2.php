<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$demandeur	= $pseudo ;
	$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$demandeur' ")->fetch_array();
	$nopers = $exis['ID'];

	$heurret	= $_POST["heurr"] ;
	$heurdep	= $_POST["heurd"] ;
	$minret		= $_POST["minr"] ;
	$mindep	 	= $_POST["mind"] ;
	$officer	= $_POST["oic"] ;
	$motif		= addslashes($_POST["lib"]) ;
	$datedep	= $_POST["deb"] ;
	$choix		= $_POST["opt"] ;
	if ($choix =="")
	{
		$choix="N/D";
	}
	
	$saaa		= $heurdep.":".$mindep.":00";
	$saar		= $heurret.":".$minret.":00";
	$alyom 		= date("Y-m-d H:i:s");
	
	$datedep 	= date('Y-m-d',strtotime($datedep));
	
	$datet 		= $datedep." ".$saaa;
	$dater 		= $datedep." ".$saar;

	if ($datedep=="1970-01-01" || $datedep=="0000-00-00")
	{
		header('Location:oops5.php');
	}
	if (strtotime($dater)<=strtotime($datet))
	{
		header('Location:oops6.php');
	}
		
	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djmcto WHERE cto_dem='$demandeur' AND cto_deb='$datedep' AND cto_hdeb='$saaa' AND cto_hfin='$saar' AND cto_statut='ATTENTE' ")->fetch_array();	
	if($nb['nb']!=0)
	{	
		echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"compenscto.php\">retour</a></center></span>") ;
	}
		
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_djmcto (cto_id, cto_date, cto_index, cto_dem, cto_deb, cto_hdeb, cto_hfin, cto_choix, cto_raison, cto_approver, cto_statut)
			VALUES ('', '$alyom', '$nopers', '$demandeur', '$datedep', '$saaa', '$saar', '$choix', '$motif', '$officer', 'ATTENTE') ";
				
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$alyom', 'ENREGISTREMENT', '$motif $datedep') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			include("inc/rissalaskctosup1.php");
			header('Location:compenscto.php');
		}			
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"compenscto.php\">retour</a></center></span>") ;
		}
	}  
?>
