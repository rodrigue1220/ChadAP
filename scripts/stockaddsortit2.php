<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');


	$nitem	= $_POST["item"] ;
	$nbr	= $_POST["nbr"] ;
	$rq		= $_POST["rq"] ;
	$es		= $_POST["sens"] ;
	$refer	= $_POST["refer"] ;
	$date	= $_POST["date"] ;
	$date	= date('Y-m-d',strtotime($date));
	$wakit	= date("Y-m-d H:i:s");
	
	$item 	= stristr($nitem, '>', true);
	$code 	= substr(stristr($nitem, '>'), 1);
	
	$cat 	= $mysqli->query("SELECT catart_lib AS LIB FROM wfp_chd_catart WHERE catart_code='$code' ")->fetch_array();	
	$catg	= $cat['LIB'];
	
	$nb 	= $mysqli->query("SELECT stock_nbr AS nb FROM wfp_chd_sandouk WHERE stock_item='$code' ")->fetch_array();	
	$nombre = $nb['nb'];
		
	if ($es == "ENTREE")
	{
		$nbrstk	= $nombre+$nbr;
	}
	elseif ($es == "SORTIE") 
	{
		$nbrstk	= $nombre-$nbr;
	}
	
	$sql2 = "INSERT INTO wfp_chd_sandoukvar (vars_id, vars_ref, vars_item, vars_nbr, vars_sens, vars_date)
			VALUES ('', '$refer', '$code', '$nbr', '$es', '$date')";
					
	$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	if( $requete2 )
	{	
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_sandouk WHERE stock_item='$code' ")->fetch_array();	
		if($nb['nb']!=0)
		{		
			$sqlf2 = "UPDATE wfp_chd_sandouk SET stock_nbr='$nbrstk' WHERE stock_item='$code' ";
			$mysqli->query($sqlf2) or die ('Erreur '.$sqlf2.' '.$mysqli->error);
	
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENTREE STOCK', '$item $nbr') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);		
			header('Location:stockaddsortit.php');
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_sandouk (stock_id, stock_item, stock_nbr, stock_cat, stock_remarks)
				VALUES ('', '$code', '$nbr', '$catg', '$rq')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nvo', '$agent', '$fich', '$date', 'NEW_ENTREE_STOCK', '$item $nbr') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:stockaddsortit.php');
			}
		}
		
		$sqlf2 = "UPDATE wfp_chd_sandouk SET stock_nbr='$nbrstk' WHERE stock_item='$code' ";
		$mysqli->query($sqlf2) or die ('Erreur '.$sqlf2.' '.$mysqli->error);

		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO tb_cbt_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
		VALUES ( '', '$pseudo', '$agent', '$fich', '$wakit', 'ENTREE-STOCK', '$code $item $nbr') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		header('Location:stockaddsortit.php');
	}
	
	else
	{
		echo'Echec Ajout <br><br><center><a href="stockaddsortit.php">retour</a></center>' ;
	}	  
?>
