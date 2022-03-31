<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	include('connexion.php');
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

	$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	$prof2 = $result["profil2"];
	$unite = $result["unite"];
				
	if($prof2!="AdminSU" AND $unite!="ADMIN-FINANCE/CO NDJAMENA")
	{
		header('Location:simple.php');
	}
	
	$date	= date("Y-m-d H:i:s");
	$refer	= $_GET["ref"];
	
	$sql4 		= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_ref='$refer' AND rqeqv_state='AUTO'" ;
	$requete4 	= $mysqli->query( $sql4 ) ;
	
	while( $result4 = $requete4->fetch_assoc()  )
	{
		$ide	= $result4["rqeqv_id"];
		$nbr 	= $result4["rqeqv_nbr"];
		$nbrapr = $result4["rqeqv_nbraprv"];
		$item 	= $result4["rqeqv_item"];
		
		if ($nbrapr==0)
		{
			$nbrapr = $nbr;
		}
	
		$sql = "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_state='APRV2', rqeqv_itemaprv='$item', rqeqv_nbraprv='$nbrapr' WHERE rqeqv_id='$ide' ";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$sqleq = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE2', rqeqpmt_oicit='$pseudo', rqeqpmt_doicit='$date' WHERE rqeqpmt_ref='$refer'";
			$mysqli->query($sqleq) or die ('Erreur '.$sqleq.' '.$mysqli->error);	
		}
		else
		{
			echo("<font size=\"+2\"><i>Echec Approbation</i></font><br><br><center><a href=\"listdeqpmtatit.php\">retour</a></center>") ;
		}

		header("Location:listdefourn.php") ;
	}	
?>
