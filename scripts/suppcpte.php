<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
  	include("connexion.php");

	$id  	= $_GET["id"] ;
	$pg		= $_GET["page"] ;
	$date   = date("Y-m-d H:i:s");
	
	$sql1	= "SELECT * FROM wfp_chd_personnel WHERE rh_id='$id'" ;
	$req1	= $mysqli->query( $sql1 ) ;
	$res1	= $req1->fetch_assoc();
	
	$npers	= $res1['rh_nopers'];
	$lnom	= $res1['rh_lname'];
	$fnom	= $res1['rh_fname'];
	
    $sql = "DELETE FROM wfp_chd_personnel WHERE rh_id = '$id' ";    

	$requete =  $mysqli->query($sql) ;
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'SUPPRESSION', '$id $npers $lnom $fnom') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header("Location:employlist.php") ;
	}
	else
	{
		echo'<font size="+2"><i>Echec Suppression</i></font></td></tr></table><br><br>
		<center><a href="employlist.php">retour</a></center>' ;
	}

?>
    
  