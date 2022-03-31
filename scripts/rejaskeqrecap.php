<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	//Traitement pour vérif si tout OK
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

		$existe = $mysqli->query("SELECT rqeqv_id AS ID FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='SOUMIS' ")->fetch_array();
		if($existe['ID'] == 0)
		{
			$sqlf = "UPDATE tb_cbt_requesteqpmt SET rqeqpmt_state='REJET1', rqeqpmt_doic='$date'
			WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqlf) or die ('Erreur '.$sqlf.' '.$mysqli->error);
				//include("inc/rissalaskfour.php");
			header('Location:askapprv.php') ;
		}
		else
		{
			header('Location:askapprv.php') ;
		}
	}	
?>
