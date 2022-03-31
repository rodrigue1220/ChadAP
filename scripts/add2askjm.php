<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

  $demandeur	= $pseudo ;
  $heurret	 	= $_POST["heurr"] ;
  $heurdep		= $_POST["heurd"] ;
  $minret		= $_POST["minr"] ;
  $mindep	 	= $_POST["mind"] ;
  $officer		= $_POST["oic"] ;
  $motif		= $_POST["motif"] ;
  $desti	 	= $_POST["dest"] ;
  $datedep		= $_POST["dep"] ;
  $dateret		= $_POST["ret"] ;
  $details 		= $_POST["det"] ;
  $lieudep		= $_POST["ldep"] ;
  $sens			= $_POST["sens"] ;
  
	$date 		= date("Y-m-d H:i:s");
	$datedep 	= date('Y-m-d $heurdep:$mindep:00',strtotime($datedep));
	$dateret	= date('Y-m-d',strtotime($dateret));

		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_date='$date' AND reqst_nom='$demandeur' AND reqst_dep='$datedep' AND reqst_heurd='$heurdep' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"add1ask.php\">retour</a></center></span>") ;
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_request (reqst_id, reqst_date, reqst_nom, reqst_motif, reqst_dest, reqst_passag, reqst_dep, reqst_ret, reqst_heurd, reqst_mind, reqst_heurr, reqst_minr, reqst_oic, reqst_chauf, reqst_kmdep, reqst_kmret, reqst_statoic, reqst_state, reqst_sens)
					VALUES ('', '$date', '$demandeur', '$motif', '$desti', '$details', '$datedep', '$dateret', '$heurdep', '$mindep', '$heurret', '$minret', '$officer', '', '', '', 'ATTENTE', 'ATTENTE', '$sens')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
		
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$motif') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalanask.php");
				header('Location:simple.php');
			}
			
			else
			{
				echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"add1ask.php\">retour</a></center></span>") ;
			}
		}
  
  ?>
