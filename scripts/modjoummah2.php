<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

	$choix		="N/D";
	$demandeur	= $pseudo ;
	$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$demandeur' ")->fetch_array();
	$nopers = $exis['ID'];
	$id			= $_POST["idt"];
	$officer	= $_POST["oic2"] ;
	$sup		= $_POST["oic"] ;
	$adresse	= addslashes($_POST["addr"]) ;
	$datedep 	= $dep 		= $_POST["deb"] ;
	$dateret	= $dret		= $_POST["ret"] ;
	$choix		= $_POST["opt"] ;

	$date 		= date("Y-m-d H:i:s");
	$datedep 	= date('Y-m-d',strtotime($datedep));
	$dateret	= date('Y-m-d',strtotime($dateret));
	
	$bool1		= validateDate($datedep, 'Y-m-d');
	$bool2		= validateDate($dateret, 'Y-m-d');
	
	if ($bool2!=1 || $bool1!=1)
	{
		header('Location:oops5.php');
	}
	/*if ($dep=="1970-01-01" OR $dep=="0000-00-00" OR $dret=="1970-01-01" OR $dret=="0000-00-00")
	{
		header('Location:oops5.php');
	}*/
	else if (strtotime($dep)<0  OR strtotime($dret)<0 OR strtotime($dep)=="" OR strtotime($dret)=="")
	{
		header('Location:oops5.php');
	}
	else if (strtotime($dret)<=strtotime($dep))
	{
		header('Location:oops6.php');
	}
		
	if ($choix=="OUI")
	{
		$datedep	= mktime(0,0,0,substr($datedep,5,2),substr($datedep,8,2)+3,substr($datedep,0,4));
		$dateret	= mktime(0,0,0,substr($dateret,5,2),substr($dateret,8,2)-1,substr($dateret,0,4));
		$datedep	= date("Y-m-d",$datedep);
		$dateret	= date("Y-m-d",$dateret);
	}
			
	$wakit	= $datedep;
	$ret	= $dateret;
	if ($choix=="OUI")
	{
		$drep	= mktime(0,0,0,substr($ret,5,2),substr($ret,8,2)+2,substr($ret,0,4));
	}
	else
	{
		$drep	= mktime(0,0,0,substr($ret,5,2),substr($ret,8,2)+1,substr($ret,0,4));
	}
	
	$reprise= date("Y-m-d",$drep);
	$reprise= getJoursFerie($reprise);
	
	$nbjour = getJours($datedep,$dateret);
	$nbjour = getJours2($datedep,$dateret,$nbjour);
	
	if ($nbjour>=50)
	{
		header('Location:oops5.php');
	}
	
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
		$sql2 = "UPDATE wfp_chd_rqdjoummah SET lv_deb='$dep', lv_ret='$dret', lv_rep='$reprise', lv_addr='$adresse', lv_nombre='$nbjour', lv_sup='$sup', lv_oic='$officer', lv_date='$date', lv_rr='$choix' WHERE lv_id='$id' ";
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
	
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
  
?>