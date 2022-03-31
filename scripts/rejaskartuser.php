<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$id		= $_GET["id"];
	$sql4	= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_id='$id' ";	
	$req4 	= $mysqli->query( $sql4 ) ;
	$res4 	= $req4->fetch_assoc(); 
	$ref	= $res4["rqeqv_ref"];
	$item	= $res4["rqeqv_item"];
	$nbr	= $res4["rqeqv_nbr"];
	
	$date	= date("Y-m-d H:i:s");
  
	$sql = "DELETE FROM wfp_chd_requesteqpmtvar WHERE rqeqv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;

	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'DEM_EQPMT_SUPPART', '$id $ref $item $nbr') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);		
	}			
	else
	{
		echo("<font size=\"+2\"><i>Echec SUPPRESSION</i></font><br><br><center><a href=\"details1attente2.php?id=".$ref."\">retour</a></center>") ;
	}
	include('rejaskartuserecap.php');  		
?>
