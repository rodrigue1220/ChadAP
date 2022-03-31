<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

  $id	 		= $_POST["id"] ;
  $heurf	 	= $_POST["heurf"] ;
  $heurd		= $_POST["heurd"] ;
  $minf			= $_POST["minf"] ;
  $mind		 	= $_POST["mind"] ;
  $salle		= $_POST["sdr"] ;
  $raison		= $_POST["motif"] ;
  $nbr		 	= $_POST["nbr"] ;
  $datedeb		= $_POST["deb"] ;
  $datefin		= $_POST["fin"] ;
  $otreq 		= $_POST["otreq"] ;
  $otrpc 		= $_POST["otrpc"] ;
  
  	$saaa		= $heurd.":".$mind.":00";
	$saar		= $heurf.":".$minf.":00";
	
	$date 		= date("Y-m-d H:i:s");


			$sql2 = "UPDATE wfp_chd_requestsdr SET reqsdr_date='$date', reqsdr_raison='$raison', reqsdr_salle='$salle', 
					reqsdr_nbr='$nbr', reqsdr_deb='$datedeb', reqsdr_fin='$datefin', reqsdr_heurd='$heurd',
					reqsdr_mind='$mind', reqsdr_heurf='$heurf', reqsdr_minf='$minf', reqsdr_horaire1='$saaa', reqsdr_horaire2='$saar',
					reqsdr_mmedia='$otreq', reqsdr_pc='$otrpc' WHERE reqsdr_id='$id' ";
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MODIFICATION', 'Demande $id') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				
				header('Location:details1attente.php');
			}
			
			else
			{
				echo("<span class=\"alert alert-danger\">Echec Modification <br><br><center><a href=\"modif1asksdr.php?id=$id\">retour</a></center></span>") ;
			}
  
  ?>
