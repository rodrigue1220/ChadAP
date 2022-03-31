<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	
	$id = $_GET["id"];
	$date	= date("Y-m-d H:i:s");
  
	$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz 	= $requetez->fetch_assoc();
	
	$nopers		= $resultz['lv_nopers'];		
	$superv		= $resultz['lv_sup'];	
	$deb1		= $resultz['lv_deb1'];
	$fin1		= $resultz['lv_fin1'];
	$typ1		= $resultz['lv_type1'];
	$nbre1		= $resultz['lv_nbr1'];
	$deb2		= $resultz['lv_deb2'];
	$fin2		= $resultz['lv_fin2'];
	$typ2		= $resultz['lv_type2'];
	$nbre2		= $resultz['lv_nbr2'];
	$deb3		= $resultz['lv_deb3'];
	$fin3		= $resultz['lv_fin3'];
	$typ3		= $resultz['lv_type3'];
	$nbre3		= $resultz['lv_nbr3'];
	$deb4		= $resultz['lv_deb4'];
	$fin4		= $resultz['lv_fin4'];
	$typ4		= $resultz['lv_type4'];
	$nbre4		= $resultz['lv_nbr4'];
	$reprise	= $resultz['lv_rep'];
	$soldap 	= $resultz['lv_soldap'];
	$soldav 	= $resultz['lv_soldav'];
	$opt		= $resultz['lv_selfs'];
	$firstday	= $resultz['lv_dateav'];
	$lastday 	= $resultz['lv_dateap'];
	

	$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='ATTENTE' WHERE lv_id='$id'";			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'AUTORISATION_RH', 'Demande $id $date') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rslaskdjmsupdmd.php");
		header('Location:listdjoummahaskhr.php') ;
	}
			
	else
	{
		echo'<font size="+2"><i>Echec Autorisation</i></font><br><br><center><a href="listdjoummahaskhr.php">retour</a></center>' ;
	}  
?>
