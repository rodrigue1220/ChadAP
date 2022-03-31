<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	
	$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$ref' ")->fetch_array();
	if($existe['ID'] == 0)
	{
		$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='ANNULE' WHERE rqeqpmt_ref='$ref'";
		$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
		
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'DEM_EQPMT_ANNULE', '$ref') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		//include("inc/rissalaskfour.php");
		header('Location:accueil.php') ;
	}
	
	else
	{
		header("Location:details1attente2.php?id=".$ref."") ;
	}	
?>
