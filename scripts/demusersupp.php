<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include("connexion.php");

	$id		= $_GET["id"] ;
	$date  	= date("Y-m-d H:i:s");
	
	$sql 		= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_id='$id' " ;
	$requete	= $mysqli->query( $sql );
	$result		= $requete->fetch_assoc();
	$item		= $result["rqeqv_item"];
	$nombre 	= $result["rqeqv_nbr"];
	$type	 	= $result["rqeqv_type"];

	$sqldel	= "DELETE FROM wfp_chd_requesteqpmtvar WHERE rqeqv_id='$id' ";    
	$requet =  $mysqli->query($sqldel) ;
	if($requet)
	{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'SUPPRESSION', '$id $item $nombre') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			
			if($type == "FOURN")
			{
				header("Location:askfour.php") ;
			}
			else
			{
				header("Location:askeqpmform.php?cle=IT") ;
			}
	}
	else
	{
		echo("<font size=\"+2\"><i>Echec Suppression</i></font></td></tr></table><br><br>
		<center><a href=\"simple.php\">retour</a></center>") ;
	}
?>
    
  