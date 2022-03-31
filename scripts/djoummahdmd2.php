<?php

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('inc/fonctionscalcul.php');	
include('connexion.php');

	$demandeur	= $pseudo;
	$exis = $mysqli->query("SELECT indexid AS ID FROM user WHERE pseudo='$demandeur' ")->fetch_array();
	$nopers = $exis['ID'];

	$typ1		= $_POST["ltyp"] ;
	$typ2		= $_POST["ltyp2"] ;
	$typ3		= $_POST["ltyp3"] ;
	$typ4		= $_POST["ltyp4"] ;
	$datedep2 	= $_POST["deb2"] ;
	$dateret2	= $_POST["ret2"] ;
	$datedep3 	= $_POST["deb3"] ;
	$dateret3	= $_POST["ret3"] ;
	$datedep4 	= $_POST["deb4"] ;
	$dateret4	= $_POST["ret4"] ;
	$drep		= $_POST["drep"] ;
	$officer	= $_POST["oic2"] ;
	$sup		= $_POST["oic"] ;
	$opt		= $_POST["opt"] ;
	$adresse	= addslashes($_POST["addr"]) ;
	$datedep1 	= $dep 		= $_POST["deb"] ;
	$dateret1	= $dret		= $_POST["ret"] ;

	$date 		= date("Y-m-d H:i:s");
	$datedep1 	= date('Y-m-d',strtotime($datedep1));
	$dateret1	= date('Y-m-d',strtotime($dateret1));
	$datedep2 	= date('Y-m-d',strtotime($datedep2));
	$dateret2	= date('Y-m-d',strtotime($dateret2));
	$datedep3 	= date('Y-m-d',strtotime($datedep3));
	$dateret3	= date('Y-m-d',strtotime($dateret3));
	$datedep4 	= date('Y-m-d',strtotime($datedep4));
	$dateret4	= date('Y-m-d',strtotime($dateret4));
	$drep		= date('Y-m-d',strtotime($drep));
	
	$pivot	= $nopers."-".$date;
	if ($opt=="")
	{
		$opt	= "N/D";
		$drep 	= "1970-01-01";
	}
	
	if ($opt=="NON")
	{
		$drep 	= "1970-01-01";
	}
	
	if ($typ2=="")
	{
		$datedep2 	= "1970-01-01";
		$dateret2	= "1970-01-01";
		$nbjour2	= 0;
	}
	if ($typ3=="")
	{
		$datedep3 	= "1970-01-01";
		$dateret3	= "1970-01-01";
		$nbjour3	= 0;
	}
	if ($typ4=="")
	{
		$datedep4 	= "1970-01-01";
		$dateret4	= "1970-01-01";
		$nbjour4	= 0;
	}
	
	
	//tester si un type de congés n'est pas choisi deux fois
	if ($typ1 == $typ2 || $typ1 == $typ3 || $typ1 == $typ4 || ($typ2 == $typ3 && $typ2!=""))
	{
		header('Location:oops661.php?cle=TYP');
		exit();
	}
	
	include ("inc/varecup.php");
	
	//tester si la date de reprise ne sort pas du NTE
	$datefin= $mysqli->query("SELECT rh_nte AS DT FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();
	$nte	= $datefin['DT'];
	
	$retour	 = max($dateret1, $dateret2, $dateret3, $dateret4, $drep);
	$reprise = getDateRep($retour);
	$reprise = getJoursFerie($reprise);
	if (strtotime($nte)<strtotime($reprise))
	{
		header('Location:oops31.php');
		exit();
	}

	//tests sur le premier choix de congés
	if ($typ1 == "AL" || $typ1 == "CTO")
	{
		//calcul du nombre de jour entre les deux dates
		$nbjour1 = getJours($datedep1,$dateret1);
		$nbjour1 = getJours2($datedep1,$dateret1,$nbjour1);
		
		//calculer le solde à partir de la date de début du congés AL
		if ($typ1 == "AL")
		{				
			$firstday	= getFinMois1($datedep1);
			$lastday 	= getFinMois2($dateret1);
			$calcav		= getCalcJours($dt1,$firstday);
			$calcap		= getCalcJours($dt1,$lastday);

			$soldav		= $nb1 + $calcav;
			$soldap		= $nb1 + $calcap;
			
			if ($nbjour1>$soldap+10)
			{
				header('Location:oops661.php?cle='.$typ1.'');
				exit();
			}
		}
		
		elseif ($typ1 == "CTO")
		{
			if ($nbjour1>$nb1)
			{
				header('Location:oops661.php?cle='.$typ1.'');
				exit();
			}
		}
	}
	
	elseif ($typ1 == "PL" || $typ1 == "ML")
	{
		//Tester si la date choisie ne sort pas de la limite du ML/PL
		if (strtotime($dt1)<=strtotime($dateret1))
		{
			header('Location:oops661.php?cle=MPLNON');
			exit();
		}
		else
		{
			$nbjour1 = getJourNouv($datedep1,$dateret1);
			if ($nbjour1>$nb1)
			{
				header('Location:oops661.php?cle='.$typ1.'');
				exit();
			}
		}
	}
	
	elseif ($typ1 == "R&R")
	{
		$nb		= $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$dates	= $nb['DT'];
		$nombre = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$nbjour	= (strtotime($datedep1)-strtotime($dates))/86400;
		
		//Tester: Nationaux ont droit à 4 jours de R&R après 56 jours sur le Field...  
		if(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="National"))
		{
			$nbjour1 = getJourNouv($datedep1,$dateret1);
			if ($nbjour1>4)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat hors de BOL ont droit à 7 jours de R&R après 56 jours sur le Field...  
		elseif(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty!="BOL"))
		{
			$nbjour1 = getJourNouv($datedep1,$dateret1);
			if ($nbjour1>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat de BOL ont droit à 7 jours de R&R après 42 jours sur le Field...  
		elseif(($nbjour>=42) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty=="BOL"))
		{
			$nbjour1 = getJourNouv($datedep1,$dateret1);
			if ($nbjour1>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		else
		{
			header('Location:oops661.php?cle=RRNON');
			exit();
		}
	}
	
	//tests sur le deuxième choix de congés
	if ($typ2 == "AL" || $typ2 == "CTO")
	{
		//calcul du nombre de jour entre les deux dates
		$nbjour2 = getJours($datedep2,$dateret2);
		$nbjour2 = getJours2($datedep2,$dateret2,$nbjour2);
		
		//calculer le solde à partir de la date de début du congés AL
		if ($typ2 == "AL")
		{				
			$firstday	= getFinMois1($datedep2);
			$lastday 	= getFinMois2($dateret2);
			$calcav		= getCalcJours($dt2,$firstday);
			$calcap		= getCalcJours($dt2,$lastday);

			$soldav		= $nb2 + $calcav;
			$soldap		= $nb2 + $calcap;
			
			if ($nbjour2>$soldap+10)
			{
				header('Location:oops661.php?cle='.$typ2.'');
				exit();
			}
		}
		
		elseif ($typ2 == "CTO")
		{
			if ($nbjour2>$nb2)
			{
				header('Location:oops661.php?cle='.$typ2.'');
				exit();
			}
		}
	}
	
	elseif ($typ2 == "PL" || $typ2 == "ML")
	{
		//Tester si la date choisie ne sort pas de la limite du ML/PL
		if (strtotime($dt2)<=strtotime($dateret2))
		{
			header('Location:oops661.php?cle=MPLNON');
			exit();
		}
		else
		{
			$nbjour2 = getJourNouv($datedep2,$dateret2);
			if ($nbjour2>$nb2)
			{
				header('Location:oops661.php?cle='.$typ2.'');
				exit();
			}
		}
	}
	
	elseif ($typ2 == "R&R")
	{
		$nb		= $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$dates	= $nb['DT'];
		$nombre = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$nbjour	= (strtotime($datedep2)-strtotime($dates))/86400;
		
		//Tester: Nationaux ont droit à 4 jours de R&R après 56 jours sur le Field...  
		if(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="National"))
		{
			$nbjour1 = getJourNouv($datedep2,$dateret2);
			if ($nbjour2>4)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat hors de BOL ont droit à 7 jours de R&R après 56 jours sur le Field...  
		elseif(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty!="BOL"))
		{
			$nbjour2 = getJourNouv($datedep2,$dateret2);
			if ($nbjour2>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat de BOL ont droit à 7 jours de R&R après 42 jours sur le Field...  
		elseif(($nbjour>=42) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty=="BOL"))
		{
			$nbjour2 = getJourNouv($datedep2,$dateret2);
			if ($nbjour2>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		else
		{
			header('Location:oops661.php?cle=RRNON');
			exit();
		}
	}
	
	//tests sur le troisième choix de congés
	if ($typ3 == "AL" || $typ3 == "CTO")
	{
		//calcul du nombre de jour entre les deux dates
		$nbjour3 = getJours($datedep3,$dateret3);
		$nbjour3 = getJours2($datedep3,$dateret3,$nbjour3);
		
		//calculer le solde à partir de la date de début du congés AL
		if ($typ3 == "AL")
		{				
			$firstday	= getFinMois1($datedep3);
			$lastday 	= getFinMois2($dateret3);
			$calcav		= getCalcJours($dt3,$firstday);
			$calcap		= getCalcJours($dt3,$lastday);

			$soldav		= $nb3 + $calcav;
			$soldap		= $nb3 + $calcap;
			
			if ($nbjour3>$soldap+10)
			{
				header('Location:oops661.php?cle='.$typ3.'');
				exit();
			}
		}
		
		elseif ($typ3 == "CTO")
		{
			if ($nbjour3>$nb3)
			{
				header('Location:oops661.php?cle='.$typ3.'');
				exit();
			}
		}
	}
	
	elseif ($typ3 == "PL" || $typ3 == "ML")
	{
		//Tester si la date choisie ne sort pas de la limite du ML/PL  
		if (strtotime($dt3)<=strtotime($dateret3))
		{
			header('Location:oops661.php?cle=MPLNON');
			exit();
		}
		else
		{
			$nbjour3 = getJourNouv($datedep3,$dateret3);
			if ($nbjour3>$nb3)
			{
				header('Location:oops661.php?cle='.$typ3.'');
				exit();
			}
		}
	}
	
	elseif ($typ3 == "R&R")
	{
		$nb		= $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$dates	= $nb['DT'];
		$nombre = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$nbjour	= (strtotime($datedep3)-strtotime($dates))/86400;
		
		//Tester: Nationaux ont droit à 4 jours de R&R après 56 jours sur le Field...  
		if(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="National"))
		{
			$nbjour3 = getJourNouv($datedep3,$dateret3);
			if ($nbjour3>4)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat hors de BOL ont droit à 7 jours de R&R après 56 jours sur le Field...  
		elseif(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty!="BOL"))
		{
			$nbjour3 = getJourNouv($datedep3,$dateret3);
			if ($nbjour3>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat de BOL ont droit à 7 jours de R&R après 42 jours sur le Field...  
		elseif(($nbjour>=42) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty=="BOL"))
		{
			$nbjour3 = getJourNouv($datedep3,$dateret3);
			if ($nbjour3>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		else
		{
			header('Location:oops661.php?cle=RRNON');
			exit();
		}
	}
	
	//tests sur le quatrième choix de congés
	if ($typ4 == "AL" || $typ4 == "CTO")
	{
		//calcul du nombre de jour entre les deux dates
		$nbjour4 = getJours($datedep4,$dateret4);
		$nbjour4 = getJours2($datedep4,$dateret4,$nbjour4);
		
		//calculer le solde à partir de la date de début du congés AL
		if ($typ4 == "AL")
		{				
			$firstday	= getFinMois1($datedep4);
			$lastday 	= getFinMois2($dateret4);
			$calcav		= getCalcJours($dt4,$firstday);
			$calcap		= getCalcJours($dt4,$lastday);

			$soldav		= $nb4 + $calcav;
			$soldap		= $nb4 + $calcap;
			
			if ($nbjour4>$soldap+10)
			{
				header('Location:oops661.php?cle='.$typ4.'');
				exit();
			}
		}
		
		elseif ($typ4 == "CTO")
		{
			if ($nbjour4>$nb4)
			{
				header('Location:oops661.php?cle='.$typ4.'');
				exit();
			}
		}
	}
	
	elseif ($typ4 == "PL" || $typ4 == "ML")
	{
		//Tester si la date choisie ne sort pas de la limite du ML/PL  
		if (strtotime($dt4)<strtotime($dateret4))
		{
			header('Location:oops661.php?cle=MPLNON');
			exit();
		}
		else
		{
			$nbjour4 = getJourNouv($datedep4,$dateret4);
			if ($nbjour4>$nb4)
			{
				header('Location:oops661.php?cle='.$typ4.'');
				exit();
			}
		}
	}
	
	elseif ($typ4 == "R&R")
	{
		$nb		= $mysqli->query("SELECT leave_ldate AS DT FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$dates	= $nb['DT'];
		$nombre = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='R&R' ")->fetch_array();		
		$nbjour	= (strtotime($datedep3)-strtotime($dates))/86400;
		
		//Tester: Nationaux ont droit à 4 jours de R&R après 56 jours sur le Field...  
		if(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="National"))
		{
			$nbjour4 = getJourNouv($datedep4,$dateret4);
			if ($nbjour4>4)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat hors de BOL ont droit à 7 jours de R&R après 56 jours sur le Field...  
		elseif(($nbjour>=56) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty!="BOL"))
		{
			$nbjour4 = getJourNouv($datedep4,$dateret4);
			if ($nbjour4>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		//Tester: Expat de BOL ont droit à 7 jours de R&R après 42 jours sur le Field...  
		elseif(($nbjour>=42) && ($nombre['nb']!=0) && ($etat=="Expat") && ($duty=="BOL"))
		{
			$nbjour4 = getJourNouv($datedep4,$dateret4);
			if ($nbjour4>7)
			{
				header('Location:oops661.php?cle=RR');
				exit();
			}
		}
		else
		{
			header('Location:oops661.php?cle=RRNON');
			exit();
		}
	}
	
	//si tout est bon, enregistrer les données dans la BDD
	$sql2 = "INSERT INTO wfp_chd_rqdjoummah (lv_id, lv_nopers, lv_type, lv_type1, lv_deb1, lv_fin1, lv_nbr1, lv_type2, lv_deb2, lv_fin2, lv_nbr2, lv_type3, lv_deb3, lv_fin3, lv_nbr3, lv_type4, lv_deb4, lv_fin4, lv_nbr4, lv_deb, lv_ret, lv_rep, lv_addr, lv_nombre, lv_sup, lv_oic, lv_date, lv_datesup, lv_dateoic, lv_dateav, lv_soldav, lv_dateap, lv_soldap, lv_state, lv_statetrt, lv_rr, lv_selfs, lv_dselfs, lv_lib)
		VALUES ('', '$nopers', '', '$typ1', '$datedep1', '$dateret1', '$nbjour1', '$typ2', '$datedep2', '$dateret2', '$nbjour2', '$typ3', '$datedep3', '$dateret3', '$nbjour3', '$typ4', '$datedep4', '$dateret4', '$nbjour4', '', '', '$reprise', '$adresse', '', '$sup', '$officer', '$date', '', '', '$firstday', '$soldav', '$lastday', '$soldap', '', '', '$pivot', '$opt', '$drep', '')" ;		
	$req2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
	
	if ($req2)
	{
		$reste1	= $nb1-$nbjour1;
		$reste2	= $nb2-$nbjour2;
		$reste3	= $nb3-$nbjour3;
		$reste4	= $nb4-$nbjour4;
		if ($typ1=="AL")
			$reste1 = $soldap-$nbjour1;
		if ($typ2=="AL")
			$reste2 = $soldap-$nbjour2;
		if ($typ3=="AL")
			$reste3 = $soldap-$nbjour3;
		if ($typ4=="AL")
			$reste4 = $soldap-$nbjour4;
		
		$sql3 = "INSERT INTO wfp_chd_rqdjmhtemp (lvtmp_id, lvtmp_type1, lvtmp_nbr1, lvtmp_type2, lvtmp_nbr2, lvtmp_type3, lvtmp_nbr3, lvtmp_type4, lvtmp_nbr4, lvtmp_pivot)
		VALUES ('',  '$typ1', '$reste1', '$typ2', '$reste2', '$typ3', '$reste3', '$typ4', '$reste4', '$pivot')" ;		
		$mysqli->query($sql3) or die( $mysqli->connect_errno()) ;
		
		header('Location:vadjoummahaskdmd.php');
	}
?>

	