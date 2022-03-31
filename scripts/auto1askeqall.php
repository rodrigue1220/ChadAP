<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
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
		
		$sqlsan = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='AUTO' WHERE rqeqv_ref='$refer' AND rqeqv_state='SOUMIS' ";
		$requete = $mysqli->query($sqlsan) or die( $mysqli->connect_errno()) ;

		if( $requete )
		{
			if ($type =="FOURN")
			{
				$sqlf = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='ADMINATT', rqeqpmt_doic='$date'
				WHERE rqeqpmt_ref='$refer'";
				$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
				include("inc/rissalaskfour.php");
				header('Location:askapprv.php') ;
			}
			else 
			{
				$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='ATTENTE2', rqeqpmt_doic='$date'
				WHERE rqeqpmt_ref='$refer'";
				$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);
				include("inc/rissalaskeqdesk.php");
				header('Location:askapprv.php') ;
			}
		}
		else
		{
			header('Location:askapprv.php') ;
		}
	}	
?>
