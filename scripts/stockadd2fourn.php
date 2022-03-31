<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');


	$item		= $_POST["item"] ;
	$nbr		= $_POST["nbr"] ;
	$rq			= $_POST["rq"] ;
	$date		= $_POST["date"] ;
	
	$date		= date('Y-m-d',strtotime($date));

	$sqls = "SELECT * FROM wfp_chd_catart WHERE catart_nom='$item' AND catart_type='ART' " ;
	$requetes	= $mysqli->query( $sqls );
	$results	= $requetes->fetch_assoc();
	$cat		= $results["catart_lib"];

	
	$sql2 = "INSERT INTO wfp_chd_sandoukvar (vars_id, vars_item, vars_nbr, vars_sens, vars_rq, vars_date, vars_type)
			VALUES ('', '$item', '$nbr', 'ENTREE', '$rq', '$date', 'FOURN')";
					
	$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	if( $requete2 )
	{	
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_sandouk WHERE stock_item='$item' ")->fetch_array();	
		if($nb['nb']!=0)
		{		

			$nb = $mysqli->query("SELECT stock_nbr AS nb FROM wfp_chd_sandouk WHERE stock_item='$item' ")->fetch_array();	
			$nombre = $nb['nb'];
			$nbr = $nombre+$nbr;
		
			$sql2 = "UPDATE wfp_chd_sandouk SET stock_nbr='$nbr' WHERE stock_item='$item' ";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENTREE STOCK', '$item $nbr') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);		
				header('Location:stockaddfourn.php');
			}
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_sandouk (stock_id, stock_item, stock_nbr, stock_cat, stock_remarks)
				VALUES ('', '$item', '$nbr', '$cat', '$rq')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nvo', '$agent', '$fich', '$date', 'NEW ENTREE STOCK', '$item $nbr') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:stockaddfourn.php');
			}
		}
	}
	
	else
	{
		echo'Echec Ajout <br><br><center><a href="stockadd.php">retour</a></center>' ;
	}	  
?>
