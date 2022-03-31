<?php
/**
* @author Zaki IZZO <izzo.z@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$demandeur	= $pseudo ;
	$motif		= $_POST["motif"] ;
	$oic		= $_POST["oic"] ;
	$refer		= $_POST["cle"] ;
	$motif		= addslashes($motif) ;
	$date 		= date("Y-m-d H:i:s");
	
	/*Recuperer ref dans variation
	$ref	= $mysqli->query("SELECT DISTINCT(vars_ref) AS ID FROM wfp_chd_sandoukvar WHERE vars_state='STDBY' AND vars_sens='SORTIE' AND vars_rq='$demandeur'  ")->fetch_array();			
	$refer	= $ref['ID'];*/

	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$demandeur' AND rqeqpmt_ref ='$refer' AND rqeqpmt_type='FOURN' ")->fetch_array();		
	if($nb['nb']!=0)
	{
		echo("<span class=\"alert alert-danger\">Cette Demande a deja ete soumise <br><br><center><a href=\"askfour.php\">retour</a></center></span>") ;
	}
		
	else 
	{
		$sql2 = "INSERT INTO wfp_chd_requesteqpmt (rqeqpmt_id, rqeqpmt_ref, rqeqpmt_demand, rqeqpmt_motif, rqeqpmt_date, rqeqpmt_oic, rqeqpmt_state, rqeqpmt_type)
			VALUES ('', '$refer', '$demandeur', '$motif', '$date', '$oic', 'ATTENTE', 'FOURN')";
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		
		if( $requete2 )
		{		
			$sqlv = "UPDATE wfp_chd_sandoukvar SET vars_state='ATTENTE' WHERE vars_ref='$refer'";
			$mysqli->query($sqlv) or die ('Erreur '.$sqlv.' '.$mysqli->error);
				
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'DEM_FOURN_SUBMIT', '$refer $oic') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			//include("inc/rissalanaskeqpmt.php");
			header('Location:askfour.php');
		}
			
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"askfour.php\">retour</a></center></span>") ;
		}
	}
?>
