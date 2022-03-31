<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	include('connexion.php');

	$sqlp = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requetep	= $mysqli->query( $sqlp );
	$resultp	= $requetep->fetch_assoc();
	$nperso		= $resultp["nom"];
	$pperso 	= $resultp["prenom"];
	$messcc		= $resultp["email"];

	
	$id 	= $_POST["idt"];
	$date	= date("Y-m-d H:i:s");
	$comm 	= addslashes($_POST["librej"]);
  
	$sqlz	 	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz 	= $requetez->fetch_assoc();
	$nopers		= $resultz['lv_nopers'];
	$oic		= $resultz['lv_oic'];
	$superv		= $resultz['lv_sup'];
	$ldate		= $resultz['lv_dateap'];
	$solde		= $resultz['lv_soldap'];
	
	$oicnom		= stristr($oic, ',', true);
	$oicprenom 	= substr(stristr($oic, ','), 1);
	$mess 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprenom'")->fetch_array();
	$messagerie	= $mess['EM'];
	
	$supnom		= stristr($superv, ',', true);
	$suprenom 	= substr(stristr($superv, ','), 1);
	$mess2 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$supnom' AND prenom='$suprenom'")->fetch_array();
	$messcc		= $mess2['EM'];
  
	if (($nperso==$supnom) && ($pperso==$suprenom))
	{
		if (($nperso==$oicnom) && ($pperso==$oicprenom))
		{
			$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='REJET2', lv_datesup='$date', lv_dateoic='$date', lv_lib='$comm' WHERE lv_id='$id'";			
			$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
			if( $requete )
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'REJET', 'Demande $id REJET SUP+OIC') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);

				include("inc/rissalaskdjmrj.php");
				header('Location:simple.php') ;
			}
			
			else
			{
				echo'<font size="+2"><i>Echec REJET</i></font><br><br><center><a href="simple.php">retour</a></center>' ;
			}
		}
		else
		{
			$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='REJET1', lv_datesup='$date', lv_lib='$comm' WHERE lv_id='$id'";			
			$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
			if( $requete )
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'REJET', 'Demande $id REJET SUP') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalarjdjmoic.php");
				header('Location:simple.php') ;
			}		
			else
			{
				echo'<font size="+2"><i>Echec REJET</i></font><br><br><center><a href="simple.php">retour</a></center>' ;
			}
		}
	}
	else if (($nperso==$oicnom) && ($pperso==$oicprenom))
	{
  		$sql = "UPDATE wfp_chd_rqdjoummah SET lv_state='REJET2', lv_dateoic='$date', lv_lib='$comm' WHERE lv_id='$id'";			
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
			
		if( $requete )
		{
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'REJET', 'Demande $id REJET OIC') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			
			include("inc/rissalaskdjmrj.php");
			header('Location:simple.php') ;
		}
			
		else
		{
			echo'<font size="+2"><i>Echec REJET</i></font><br><br><center><a href="simple.php">retour</a></center>' ;
		}
	}
  
?>
