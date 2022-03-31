<?php
	
	$exist	 = $mysqli->query("SELECT lv_id AS ID FROM wfp_chd_rqdjoummah WHERE lv_rr='$pivot' ")->fetch_array();
	$identif = $exist['ID'];//echo '<br />';
	
	$wakit	= $datedep;//echo '<br />';
	$ret	= $dateret;//echo '<br />';
	
	/*$drep	= mktime(0,0,0,substr($ret,5,2),substr($ret,8,2)+1,substr($ret,0,4));
	
	$reprise= date("Y-m-d",$drep);
	$reprise= getJoursFerie($reprise);*/
	
	$nbjour = getJourNouv($wakit,$ret);
	
	/*$nbjour = getJours2($datedep,$dateret,$nbjour);
	
	$drep	= mktime(0,0,0,substr($reprise,5,2),substr($reprise,8,2),substr($reprise,0,4));

	if (date("w", $drep)==6)
	{
		$drep = mktime(0,0,0,substr($reprise,5,2),substr($reprise,8,2)+2,substr($reprise,0,4));
	}
	else if (date("w", $drep)==0)
	{
		$drep = mktime(0,0,0,substr($reprise,5,2),substr($reprise,8,2)+1,substr($reprise,0,4));
	}
		
	$reprise= date("Y-m-d",$drep);	
	/*$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_rqdjoummah WHERE lv_nopers='$nopers' AND lv_deb='$dep' AND lv_ret='$dret' ")->fetch_array();		
	if($nb['nb']!=0)
	{
		echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"djoummahask.php\">retour</a></center></span>") ;
	}
		
	else 
	{*/
	if ($type == "PL")
	{
		$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_pldeb='$wakit', lv_plfin='$ret', lv_plnbr='$nbjour' 
				WHERE lv_nopers='$nopers' AND lv_id='$identif' ";
	}
	else if ($type == "ML")
	{
		$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_mldeb='$wakit', lv_mlfin='$ret', lv_mlnbr='$nbjour' 
				WHERE lv_nopers='$nopers' AND lv_id='$identif' ";
	}	
	
	$mysqli->query($sql2) or die( $mysqli->connect_errno()) ;	
	/*
		$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
		if( $requete2 )
		{		
			$agent	= $_SERVER['HTTP_USER_AGENT'];
			$fich	= $_SERVER['PHP_SELF'];
			$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', 'Du $datedep Au $dateret Nbre $nbjour RR $choix') ";
			$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
			header('Location:vadjoummahask.php');
		}
			
		else
		{
			echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"djoummahask.php\">retour</a></center></span>") ;
		}
	}*/
			
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