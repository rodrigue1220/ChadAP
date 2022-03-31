<?php
/**
* @author Zaki IZZO <izzo.z@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	include('connexion.php');
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

	$sql 		= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete	= $mysqli->query( $sql );
	$result		= $requete->fetch_assoc();
	$nomoic		= $result["nom"];
	$pnomoic 	= $result["prenom"];
	$date		= date("Y-m-d H:i:s");
	
	$sql3 		= "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_oic='$nomoic,$pnomoic' AND rqeqpmt_state='ATTENTE'" ;
	$requete3 	= $mysqli->query( $sql3 ) ;
	while( $result3 = $requete3->fetch_assoc()  )
	{
		$refer	= $result3['rqeqpmt_ref'];
		$type	= $result3['rqeqpmt_type'];
		
		$sqlsan = "UPDATE wfp_chd_sandoukvar SET vars_state='REJ1' WHERE vars_ref='$refer' AND vars_state='ATTENTE' ";
		$mysqli->query($sqlsan) or die ('Erreur '.$sqlsan.' '.$mysqli->error);

		$existe = $mysqli->query("SELECT vars_id AS ID FROM wfp_chd_sandoukvar WHERE vars_ref='$refer' AND vars_state='AUTO' ")->fetch_array();
		if($existe['ID'] == 0)
		{
			$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='REJET1', rqeqpmt_doic='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
			//include("inc/rissalaskfour.php");
			header('Location:accueil.php') ;
		}
		else if($existe['ID'] != 0)
		{
			if ($type =="FOURN")
			{
				$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='ADMINATT', rqeqpmt_doic='$date'
				WHERE rqeqpmt_ref='$refer'";
				$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
				//include("inc/rissalaskfour.php");
				header('Location:accueil.php') ;
			}
			else 
			{
				$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='ATTENTE2', rqeqpmt_doic='$date'
				WHERE rqeqpmt_ref='$refer'";
				$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
				//include("inc/rissalaskeqdesk.php");
				header('Location:accueil.php') ;
			}
		}
		else
		{
			header('Location:accueil.php') ;
		}
	}	
?>
