<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	include('connexion.php');
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');

	$id 	= $_GET["id"];
	$date	= date("Y-m-d H:i:s");
  
		$sql = "UPDATE wfp_chd_sandoukvar SET vars_state='AUTO' WHERE vars_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;

		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$date 	= date("Y-m-d H:i:s");
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPROBATION OIC', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			
			/*if ($item == 'FOURN')
			{
				include("inc/rissalaskfour.php");
				header('Location:simple.php') ;
			}
			else if ($item == '')
			{
				include("inc/rissalaskeqdesk.php");
				header('Location:simple.php') ;
			}*/			
		}			
		else
		{
			echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="simple.php">retour</a></center>' ;
		}
	include('auto1askeqrecap.php');
?>
