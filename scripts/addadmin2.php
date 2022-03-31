<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
	
	$pro	= $mysqli->query("SELECT profil AS PROF FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$profil	= $pro["PROF"];
	
	if ($profil != "AdminLOGFLEET")
	{
		header('Location:simple.php');
	}

	$reg	= $_POST["reg"] ;
	$dept	= $_POST["dept"] ;
	$sp 	= $_POST["sp"] ;
	$lieu 	= $_POST["area"] ;
	$tzone 	= $_POST["typezone"] ;
		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_adminar WHERE adm_reg='$reg' AND adm_dept='$dept' AND adm_sp='$sp' AND adm_lieu='$lieu' AND adm_tpzone='$tzone'")->fetch_array();
		
		if($nb['nb']!=0)
		{
			header('Location:oops666khalatt.php?cle=ADDADM');
			exit();
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_adminar (adm_id, adm_reg, adm_dept, adm_sp, adm_lieu, adm_tpzone)
					VALUES ('', '$reg', '$dept', '$sp', '$lieu', '$tzone')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$date 	= date("Y-m-d H:i:s");
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$lieu') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:addadmin.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addadmin.php">retour</a></center>' ;
			}
		}
  
  ?>
