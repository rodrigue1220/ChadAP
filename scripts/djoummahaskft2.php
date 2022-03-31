<?php

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	/*$choix		="N/D";
	$demandeur	= $pseudo;
	$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$demandeur' ")->fetch_array();
	$nopers = $exis['ID'];*/

	/*$typ2		= $_POST["ltyp2"] ;
	$typ3		= $_POST["ltyp3"] ;
	$datedep2 	= $_POST["deb2"] ;
	$dateret2	= $_POST["ret2"] ;
	$datedep3 	= $_POST["deb3"] ;
	$dateret3	= $_POST["ret3"] ;*/
	
	$choix		= "N/D";
	$nopers		= $_POST["nopers"] ;
	$typ		= $_POST["ltyp"] ;	
	$officer	= $_POST["oic2"] ;
	$sup		= $_POST["oic"] ;
	$daterep	= $_POST["drep"] ;
	$choix		= $_POST["opt"] ;
	$adresse	= addslashes($_POST["addr"]) ;
	$datedep 	= $dep 		= $_POST["deb"] ;
	$dateret	= $dret		= $_POST["ret"] ;

	$date 		= date("Y-m-d H:i:s");
	$datedep 	= date('Y-m-d',strtotime($datedep));
	$dateret	= date('Y-m-d',strtotime($dateret));
	$daterep	= date('Y-m-d',strtotime($daterep));
	/*$datedep2 	= date('Y-m-d',strtotime($datedep2));
	$dateret2	= date('Y-m-d',strtotime($dateret2));
	$datedep3 	= date('Y-m-d',strtotime($datedep3));
	$dateret3	= date('Y-m-d',strtotime($dateret3));
	
	if ($typ == "AL")
	{
	
	}
	else if ($typ == "R&R")
	{
	
	}
	else if ($typ == "PL")
	{
	
	}
	else if ($typ == "ML")
	{
	
	}
	else if ($typ == "CTO")
	{
	
	}
	
	$drep	= mktime(0,0,0,substr($ret,5,2),substr($ret,8,2)+1,substr($ret,0,4));
	
	$reprise= date("Y-m-d",$drep);
	$reprise= getJoursFerie($reprise);*/
	
	$nbjour = getJourNouv($datedep,$dateret);
	
	/*
	$drep	= mktime(0,0,0,substr($reprise,5,2),substr($reprise,8,2),substr($reprise,0,4));

	if (date("w", $drep)==6)
	{
		$drep = mktime(0,0,0,substr($reprise,5,2),substr($reprise,8,2)+2,substr($reprise,0,4));
	}
	else if (date("w", $drep)==0)
	{
		$drep = mktime(0,0,0,substr($reprise,5,2),substr($reprise,8,2)+1,substr($reprise,0,4));
	}
		
	$reprise= date("Y-m-d",$drep);	*/
	
	$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_deb='$dep' AND lv_ret='$dret' AND lv_type='$typ' AND (lv_state='ATTENTE' OR lv_state='APPROUVE1') ")->fetch_array();		
	if($nb['nb']!=0)
	{
		echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"djoummahaskft.php\">retour</a></center></span>") ;
	}
		
	else 
	{
			
		if ($nbjour>4)
		{
			header('Location:oops66.php');
		}
		else {
		$sql2 = "INSERT INTO wfp_chd_rqdjoummah (lv_id, lv_nopers, lv_type, lv_deb, lv_ret, lv_rep, lv_addr, lv_nombre, lv_sup, lv_oic, lv_date, lv_rr)
			VALUES ('', '$nopers', '$typ', '$datedep', '$dateret', '$daterep', '$adresse', '$nbjour', '$sup', '$officer', '$date', '$choix')";
					
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{		
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', 'Du $datedep Au $dateret Nbre $nbjour $typ Self-S $choix') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:vadjoummahaskft.php');
		}
			
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"djoummahaskft.php\">retour</a></center></span>") ;
		}
		}
	}
		
	function getJours($datedeb,$datefin)
	{
		$nb_jours=0;
		$dated=explode('-',$datedeb);
		$datef=explode('-',$datefin);
		$timestampcurr=mktime(0,0,0,$dated[1],$dated[2],$dated[0]);
		$timestampf=mktime(0,0,0,$datef[1],$datef[2],$datef[0]);
		while($timestampcurr<$timestampf)
		{
			if((date('w',$timestampcurr)!=0)&&(date('w',$timestampcurr)!=6))
			{
				$nb_jours++;
			}
		
			$timestampcurr=mktime(0,0,0,date('m',$timestampcurr),(date('d',$timestampcurr)+1)   ,date('Y',$timestampcurr));
		}
		if ((date('w',$timestampf)!=0)&&(date('w',$timestampf)!=6))
		{
			return $nb_jours+1;
		}
		else
		{
			return $nb_jours;
		}
	}
	
	function getJoursFerie($datereprise)
	{
		include('connexion.php');
		$dater=strtotime($datereprise);

		$sqls = "SELECT * FROM wfp_chd_crualjf " ;
		$requetes = $mysqli->query( $sqls ) ;
		while( $results = $requetes->fetch_assoc()  )
		{
			$datexy = $results['jf_date'];
			$datexy = strtotime($datexy);
			if($dater==$datexy)
			{
				$dater=$dater+86400;
			}
		}	
		return date("Y-m-d",$dater);
	}
	
	function getJours2($datedeb,$datefin,$nombre)
	{
		include('connexion.php');
		$nb_jours=$nombre;
		$dated=strtotime($datedeb);
		$datef=strtotime($datefin);

		while($dated<=$datef)
		{
			$sqls = "SELECT * FROM wfp_chd_crualjf " ;
			$requetes = $mysqli->query( $sqls ) ;
			while( $results = $requetes->fetch_assoc()  )
			{
				$datexy = $results['jf_date'];
				$datexy = strtotime($datexy);
				if($dated==$datexy)
				{
					$nb_jours--;
				}
			}	
			$dated=$dated+86400;
		}
		return $nb_jours;
	}
	
	function getJourNouv($datedeb,$datefin)
	{
		$nb_jours=0;
		$dated=explode('-',$datedeb);
		$datef=explode('-',$datefin);
		$timestampcurr=mktime(0,0,0,$dated[1],$dated[2],$dated[0]);
		$timestampf=mktime(0,0,0,$datef[1],$datef[2],$datef[0]);
		while($timestampcurr<=$timestampf)
		{
			$nb_jours++;	
			$timestampcurr=mktime(0,0,0,date('m',$timestampcurr),(date('d',$timestampcurr)+1)   ,date('Y',$timestampcurr));
		}

		return $nb_jours;
	}
?>

	