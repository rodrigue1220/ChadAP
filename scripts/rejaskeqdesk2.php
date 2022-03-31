<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');

	$id		= $_POST["id"];
	$comm	= addslashes($_POST["comm"]);
	$date	= date("Y-m-d H:i:s");

	$ref	= $mysqli->query("SELECT vars_ref AS RF FROM wfp_chd_sandoukvar WHERE vars_id='$id' ")->fetch_array();
	$refer	= $ref['RF'];
  
	$sqlsan = "UPDATE wfp_chd_sandoukvar SET vars_state='REJDSK', vars_lib='$comm' WHERE vars_id='$id' ";
	$requet = $mysqli->query($sqlsan) or die ( $mysqli->connect_errno());
	
	if($requet)
	{	
		$existe = $mysqli->query("SELECT vars_id AS ID FROM wfp_chd_sandoukvar WHERE vars_ref='$refer' AND vars_state='AUTO' ")->fetch_array();
		if($existe['ID'] == 0)
		{
			$existe2 = $mysqli->query("SELECT vars_id AS ID FROM wfp_chd_sandoukvar WHERE vars_ref='$refer' AND vars_state='APRV1' ")->fetch_array();
			if($existe2['ID'] == 0)
			{
				$sql = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_sdesk='$pseudo', rqeqpmt_state='REJETSDESK', rqeqpmt_dsdesk='$date', rqeqpmt_lib='$comm'
				WHERE rqeqpmt_ref='$refer'";
				$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
				//include("inc/rissalarejaskeqdesk.php");
			}
			else
			{
				$sql = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_state='APPROUVE1', rqeqpmt_sdesk='$pseudo', rqeqpmt_dsdesk='$date'
				WHERE rqeqpmt_ref='$refer'";
				$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
				//include("inc/rissalaskeqit.php");
			}
		}
		header('Location:listaskeqpmt.php') ;
	}			
	/*else
	{
		echo'<font size="+2"><i>Echec Assignation</i></font><br><br><center><a href="listaskeqpmt.php">retour</a></center>' ;
	}

	$sql = "UPDATE wfp_chd_requesteqpmt SET rqeqpmt_sdesk='$pseudo', rqeqpmt_state='REJETSDESK', rqeqpmt_dsdesk='$date', rqeqpmt_lib='$comm'
			WHERE rqeqpmt_id='$id'";
			
	$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;		
	if( $requete )
	{
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTION REJET SDESK', '$id') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		include("inc/rissalarejaskeqdesk.php");
		header('Location:listaskeqpmt.php') ;
	}*/		
	else
	{
		echo'<font size="+2"><i>Echec REJET</i></font><br><br><center><a href="listaskeqpmt.php">retour</a></center>' ;
	}
?>
