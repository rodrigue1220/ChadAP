<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');	
	
	$id = $_GET["id"];
	$date	= date("Y-m-d H:i:s");
	
	$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz 	= $requetez->fetch_assoc();
	
	$nopers		= $resultz['lv_nopers'];
	
	/*$cpt	= $mysqli->query("SELECT rh_contrat AS CONT FROM wfp_chd_personnel WHERE rh_nopers='$nopers'")->fetch_array();
	$contrat= $cpt["CONT"];
	
	if ($contrat != "SC" && $contrat != "SS")
	{
		header('Location:auto1askdjft.php?id='.$id.'');
	}
	
	else
	{*/

	$sqlp 		= "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requetep	= $mysqli->query( $sqlp );
	$resultp	= $requetep->fetch_assoc();
	$nperso		= $resultp["nom"];
	$pperso 	= $resultp["prenom"];

	$oic		= $resultz['lv_oic'];
	$superv		= $resultz['lv_sup'];
	/*$ldate		= $resultzz['lv_dateap'];
	$solde		= $resultzz['lv_soldap'];
	$choix		= $resultzz['lv_rr'];
	$repriz		= $resultzz['lv_rep'];*/
	$deb1		= $resultz['lv_deb1'];
	$fin1		= $resultz['lv_fin1'];
	$typ1		= $resultz['lv_type1'];
	$nbre1		= $resultz['lv_nbr1'];
	$deb2		= $resultz['lv_deb2'];
	$fin2		= $resultz['lv_fin2'];
	$typ2		= $resultz['lv_type2'];
	$nbre2		= $resultz['lv_nbr2'];
	$deb3		= $resultz['lv_deb3'];
	$fin3		= $resultz['lv_fin3'];
	$typ3		= $resultz['lv_type3'];
	$nbre3		= $resultz['lv_nbr3'];
	$deb4		= $resultz['lv_deb4'];
	$fin4		= $resultz['lv_fin4'];
	$typ4		= $resultz['lv_type4'];
	$nbre4		= $resultz['lv_nbr4'];
	$reprise	= $resultz['lv_rep'];
	$pivot		= $resultz['lv_rr'];
	$opt		= $resultz['lv_selfs'];

	
	$oicnom		= stristr($oic, ',', true);
	$oicprenom 	= substr(stristr($oic, ','), 1);
	$mess 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprenom'")->fetch_array();
	$messoic	= $mess['EM'];
	
	$supnom		= stristr($superv, ',', true);
	$suprenom 	= substr(stristr($superv, ','), 1);
	$mess2 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$supnom' AND prenom='$suprenom'")->fetch_array();
	$messcc		= $mess2['EM'];
  
	if (($nperso==$supnom) && ($pperso==$suprenom))
	{
		if (($nperso==$oicnom) && ($pperso==$oicprenom))
		{
			$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='APPROUVE2', lv_datesup='$date', lv_dateoic='$date' WHERE lv_id='$id'";			
			$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
			if( $requete )
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPROBATION', 'Demande $id APPRV SUP+OIC $pivot') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				
				include("inc/rissalaskdjmokdmd.php");
				header('Location:djoummahapprv.php') ;

			}
			
			else
			{
				echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="djoummahapprv.php">retour</a></center>' ;
			}
		}
		else
		{
			$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='APPROUVE1', lv_datesup='$date' WHERE lv_id='$id'";			
			$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
			if( $requete )
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPROBATION', 'Demande $id APPRV SUP $pivot') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalaskdjmoicdmd.php");
				header('Location:djoummahapprv.php') ;
			}		
			else
			{
				echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="djoummahapprv.php">retour</a></center>' ;
			}
		}
	}
	else if (($nperso==$oicnom) && ($pperso==$oicprenom))
	{
  		$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='APPROUVE2', lv_dateoic='$date' WHERE lv_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'APPROBATION', 'Demande $id APPRV OIC $pivot') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			include("inc/rissalaskdjmokdmd.php");
			header('Location:djoummahapprv.php') ;
		}
			
		else
		{
			echo'<font size="+2"><i>Echec Approbation</i></font><br><br><center><a href="djoummahapprv.php">retour</a></center>' ;
		}
	}
?>
