<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');
	
	$id		= $_POST["id"];
	$page	= $_POST["pg"];
	
	$wh		= $_POST["wh"];
	$matd	= $_POST["mdesc"];
	$batch	= $_POST["batch"];
	$wbs	= $_POST["wbs"];
	$grnt	= $_POST["gnum"];
	$grntd	= $_POST["gdesc"];
	$slbbd	= $_POST["bbd"];
	$total	= $_POST["total"];
	$gtdd	= $_POST["gtdd"];
	
	$sql 	= "UPDATE wfp_chd_logtransit SET logt_destiwh='$wh', logt_desc='$matd', logt_batch='$batch', logt_wbs='$wbs', logt_grantnum='$grnt', 
				logt_grantdesc='$grntd', logt_bbd='$slbbd', logt_netdeliv='$total', logt_tddgrant='$gtdd' 
				WHERE logt_id='$id' ";
	
	$req	= $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	if( $req )
	{			
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$alyom 	= date("Y-m-d H:i:s");
		
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ('', '$pseudo', '$agent', '$fich', '$alyom', 'MODIFICATION', '$id $wh $total')";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);

		header("Location:rechlogtrzreport.php?pwh=".$wh."");
	}			
	else
	{
		echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"rechlogtrzreport.php?pwh=".$wh."\">retour</a></center></span>") ;
	}

?>