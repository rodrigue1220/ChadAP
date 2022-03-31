<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	include('connexion.php');
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminSTOCK")
	{
		header('Location:simple.php');
	}

	$date	= date("Y-m-d H:i:s");
	
	$refer	= $_GET["ref"];
	
	$sql4 		= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='APRV2'" ;
	$requete4 	= $mysqli->query( $sql4 ) ;
	
	while( $result4 = $requete4->fetch_assoc()  )
	{
		$ident	= $result4["rqeqv_id"];
		$nbr	= $result4["rqeqv_nbraprv"];
		$item	= $result4["rqeqv_item"];
		$item2	= $result4["rqeqv_itemaprv"];
		
		if($item2 =="")
		{
			$article = $item;
		}
		else
		{
			$article = $item2;
		}
		
		$stk 	= $mysqli->query("SELECT stock_nbr AS NB FROM wfp_chd_sandouk WHERE stock_item='$article' ")->fetch_array();
		$nbrstk	= $stk["NB"];
			
		$nnbr	= $nbrstk-$nbr;
			
		$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_itemaprv='$article', rqeqv_state='TRT' WHERE rqeqv_id='$ident' ";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		if( $requete )
		{
			$sqlw = "INSERT INTO wfp_chd_sandoukvar (vars_id, vars_ref, vars_item, vars_nbr, vars_sens, vars_date)
				VALUES ('', '$refer', '$article', '$nbr', 'SORTIE', '$date')";
			$mysqli->query($sqlw) or die( $mysqli->connect_errno()) ;
		
			$sqleq = "UPDATE wfp_chd_sandouk SET stock_nbr='$nnbr' WHERE stock_item='$article'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
			//include("inc/rissalatraitaskeq.php");
			//header("Location:askfourappro.php") ;
		}
		else
		{
			echo("<font size=\"+2\"><i>Echec Traitement</i></font><br><br><center><a href=\"listdeqpmtdet.php?id=".$refer."\">retour</a></center>") ;
		}
	}
	
	$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='TRAITE', rqeqpmt_appro='$pseudo', rqeqpmt_dappro='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
	include("inc/rissalatraitaskeq.php");
	header("Location:listdeqpmt.php") ;
?>
