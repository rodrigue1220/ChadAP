<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require('config.php');
	require('verifications.php');
	require('connexion.php');
	
	$id   = $_GET["id"];
	$date = date("Y-m-d H:i:s");

	//récupération des données
	$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	
	$nopers	= $result['lv_nopers'];		
	$superv	= $result['lv_sup'];	
	$deb1	= $result['lv_deb1'];
	$fin1	= $result['lv_fin1'];
	$typ1	= $result['lv_type1'];
	$nbre1	= $result['lv_nbr1'];
	$deb2	= $result['lv_deb2'];
	$fin2	= $result['lv_fin2'];
	$typ2	= $result['lv_type2'];
	$nbre2	= $result['lv_nbr2'];
	$deb3	= $result['lv_deb3'];
	$fin3	= $result['lv_fin3'];
	$typ3	= $result['lv_type3'];
	$nbre3	= $result['lv_nbr3'];
	$deb4	= $result['lv_deb4'];
	$fin4	= $result['lv_fin4'];
	$typ4	= $result['lv_type4'];
	$nbre4	= $result['lv_nbr4'];
	$reprise= $result['lv_rep'];
	$soldap = $result['lv_soldap'];
	$soldav = $result['lv_soldav'];
	$opt	= $result['lv_selfs'];
	$firstday= $result['lv_dateav'];
	$lastday = $result['lv_dateap'];
	
	$restant1 = $soldap-$nbre1;
	$restant2 = $soldap-$nbre2;
	$restant3 = $soldap-$nbre3;
	$restant4 = $soldap-$nbre4;
	
	if (($typ1=="AL" && ($restant1<0 && $restant1>=-10)) || ($typ2=="AL" && ($restant2<0 && $restant2>=-10)) || ($typ3=="AL" && ($restant3<0 && $restant3>=-10)) || ($typ4=="AL" && ($restant4<0 && $restant4>=-10)))
	{	
		$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_state='ATTENTERH', lv_date='$date' WHERE lv_id='$id' ";					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CONFIRMATION', 'Demande $id ATT RH') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			include("inc/rissalaskdjmrhdmd.php");
			header('Location:djoummahatt.php');
			exit();			
		}
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Confirmation <br><br><center><a href=\"vadjoummahaskdmd.php\">retour</a></center></span>") ;
		}
	}

	else
	{
		$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_state='ATTENTE', lv_date='$date' WHERE lv_id='$id' ";					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'CONFIRMATION', 'Demande $id $type ATT SUP/OIC') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			include("inc/rslaskdjmsupdmd.php");	
			header('Location:djoummahatt.php');
			exit();	
		}	
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Confirmation <br><br><center><a href=\"vadjoummahaskdmd.php\">retour</a></center></span>") ;
		}		
	}
?>
