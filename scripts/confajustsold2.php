<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');


	$id		= $_GET["id"] ;

	$date 	= date("Y-m-d H:i:s");
		
	$sql = "UPDATE wfp_chd_djmvar SET lvar_apprv='$pseudo', lvar_dapprv='$date' WHERE lvar_id='$id' ";				
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
	
	if( $requete )	
	{
		$sqlt = "SELECT * FROM wfp_chd_djmvar WHERE lvar_id='$id' " ;
		$requetet	= $mysqli->query( $sqlt );
		$resultt	= $requetet->fetch_assoc();
		$nopers		= $resultt["lvar_index"];
		$type	 	= $resultt["lvar_ltype"];
		$solde		= $resultt["lvar_solde"];
		$dsolde	 	= $resultt["lvar_dsold"];
	
		$sql2 = "UPDATE wfp_chd_djoummah SET leave_statu='', leave_ldate='$dsolde', leave_solde='$solde' WHERE leave_nopers='$nopers' AND leave_type='$type' ";
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		
		if( $requete2 )
		{			
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPRV_ADJUST', '$solde $dsolde') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:confajustsold.php');
		}
			
		else
		{
			echo'Echec Operation <br><br><center><a href="ajustsold.php">retour</a></center>' ;
		}
	}
  
 ?>
