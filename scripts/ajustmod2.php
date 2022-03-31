<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


	$id		= $_POST["id"] ;
	$ndem	= $_POST["ndem"] ;
	$comm	= $_POST["comm"] ;
	$sold	= $_POST["sold"] ;
	$dsold	= $_POST["dsold"];
	$nopers = $_POST["nopers"];
	$type	= $_POST["typ"];

	$date 	= date("Y-m-d H:i:s");
		
	$sql = "INSERT INTO wfp_chd_djmvar (lvar_id, lvar_index, lvar_init, lvar_dinit, lvar_ndem, lvar_ltype, lvar_solde, lvar_dsold, lvar_lib1)
			VALUES ('', '$nopers', '$pseudo', '$date', '$ndem', '$type', '$sold', '$dsold', '$comm')";				
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )	
	{
		$sql2 = "UPDATE wfp_chd_djoummah SET leave_statu='ATTENTE' WHERE leave_id='$id' ";
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'INIT_ADJUST', '$sold $dsold') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:ajustsold.php');
		}
			
		else
		{
			echo'Echec Operation <br><br><center><a href="ajustsold.php">retour</a></center>' ;
		}
	}
  
 ?>
