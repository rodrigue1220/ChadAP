<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$demandeur	= $pseudo ;
	$sqle		= $mysqli->query("SELECT unite AS UN FROM user WHERE pseudo='$demandeur' ")->fetch_array();									
	$unite		= $sqle['UN'];
	$sofo		= substr(stristr($unite, '/'), 1);

	$heurret	= $_POST["heurr"] ;
	$heurdep	= $_POST["heurd"] ;
	$minret		= $_POST["minr"] ;
	$mindep	 	= $_POST["mind"] ;
	$officer	= $_POST["oic"] ;
	$motif		= addslashes($_POST["motif"]) ;
	$desti	 	= addslashes($_POST["dest"]) ;
	$datedep	= $_POST["dep"] ;
	$dateret	= $_POST["ret"] ;
	$details 	= $_POST["det"] ;

	$hassa		= date("H:i:s");
	$alyom		= date("Y-m-d");
	
	$saaa		= $heurdep.":".$mindep.":00";
	$saar		= $heurret.":".$minret.":00";
	$date 		= date("Y-m-d H:i:s");
	
	$datedep 	= date('Y-m-d',strtotime($datedep));
	$dateret	= date('Y-m-d',strtotime($dateret));
	
	$datet 		= $datedep." ".$saaa;
	$dater 		= $dateret." ".$saar;

		if ($datedep=="1970-01-01" OR $dateret=="1970-01-01")
		{
			header('Location:oops5.php');
		}
		if (strtotime($dater)<=strtotime($datet))
		{
			header('Location:oops6.php');
		}
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$demandeur' AND reqst_dep='$datedep' AND reqst_heurd='$heurdep' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"add1ask.php\">retour</a></center></span>") ;
		}
		
		else 
		{
			if (strtotime($datet)-strtotime($date)<=5400)
			{
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ECHEC DEMANDE', '$motif moins de 90mn $saaa') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				header('Location:oops4.php');
			}
			else
			{
				$sql2 = "INSERT INTO wfp_chd_request (reqst_id, reqst_date, reqst_nom, reqst_motif, reqst_dest, reqst_passag, reqst_dep, reqst_ret, reqst_saa, reqst_saaret, reqst_heurd, reqst_mind, reqst_heurr, reqst_minr, reqst_oic, reqst_chauf, reqst_kmdep, reqst_kmret, reqst_statoic, reqst_state, reqst_sens)
					VALUES ('', '$date', '$demandeur', '$motif', '$desti', '$details', '$datedep', '$dateret', '$saaa', '$saar', '$heurdep', '$mindep', '$heurret', '$minret', '$officer', 'NA', '0', '0', 'ATTENTE', 'ATTENTE', '$sofo')";
					
				$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
				if( $requete2 )
				{			
					$agent	= $_SERVER['HTTP_USER_AGENT'];
					$fich	= $_SERVER['PHP_SELF'];
					$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
					VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$motif') ";
					$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
					include("inc/rissalanask.php");
					header('Location:http://10.11.234.128:13013/cgi-bin/sendsms?username=kannel&password=root&to=66993806&text=Demande de transport en attente de votre autorisation. Merci de vous connecter sur la plateforme ChadAP');	
					header('Location:simple.php');
				}			
				else
				{
					echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"add1ask.php\">retour</a></center></span>") ;
				}
			}
		}
  
  ?>
