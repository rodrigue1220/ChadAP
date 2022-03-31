<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
  	include("connexion.php");

	$id  	= $_GET["id"] ;
	$mot  	= $_GET["cle"] ;
	$nopers = $_GET["nopers"] ;
	$date  	= date("Y-m-d H:i:s");
	
	if($mot=="DCT")
	{
		$sql = "UPDATE wfp_chd_djoummah SET leave_statu='INACTIF' WHERE leave_id='$id' ";    
		$requete =  $mysqli->query($sql) ;
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'DESACTIVATION', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:ajustsold2.php?nopers=".$nopers."") ;
		}
	}
	elseif($mot=="ACT")
	{
		$sql = "UPDATE wfp_chd_djoummah SET leave_statu='' WHERE leave_id='$id' ";    
		$requete =  $mysqli->query($sql) ;
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ACTIVATION', '$id') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header("Location:ajustsold2.php?nopers=".$nopers."") ;
		}
	}
	else
	{
		echo'<font size="+2"><i>Echec DESACTIVATION</i></font></td></tr></table><br><br>
		<center><a href="simple.php">retour</a></center>' ;
	}

?>
    
  