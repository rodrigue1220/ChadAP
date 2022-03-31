<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');
				
  $heurdeb	 	= $_POST["heurd"] ;
  $heurfin		= $_POST["heurf"] ;
  $mindeb		= $_POST["mind"] ;
  $minfin	 	= $_POST["minf"] ;
  $salle		= $_POST["sdr"] ;
  $activite		= $_POST["actv"] ;
  $motif		= addslashes($_POST["motif"]) ;
  $nombre	 	= $_POST["nbr"] ;
  $datedeb		= $_POST["deb"] ;
  $datefin		= $_POST["fin"] ;
  $autreq		= addslashes($_POST["otreq"]) ;
  $autrep		= addslashes($_POST["otrpc"]) ;
  $deman		= $pseudo;
  
	$saaa		= $heurdeb.":".$mindeb.":00";
	$saar		= $heurfin.":".$minfin.":00";
	
	$jour = strtotime(date("Y-m-d"));
	$date3 = strtotime($datedeb);
		
	$diff = $date3-$jour;
	$diff = $diff/86400;
	
	if(!isset($_POST['pc']))
	{
		$choixpc = $autrep;
	} else $choixpc = implode(',', $_POST['pc']).",".$autrep;

	if(!isset($_POST['eqpmt']))
	{
		$choixeq = $autreq;
	} else $choixeq = implode(',', $_POST['eqpmt']).",".$autreq;
	
	if ($diff>0)
	{
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_requestsdr WHERE reqsdr_deb='$datedeb' AND reqsdr_deman='$deman' AND reqsdr_raison='$motif' AND reqsdr_heurd='$heurdeb' AND reqsdr_salle='$salle' ")->fetch_array();		
		if($nb['nb']!=0)
		{
			echo("<span class=\"alert alert-danger\">Cette Demande existe deja <br><br><center><a href=\"add1asksdr.php\">retour</a></center></span>") ;
		}
		
		else 
		{
			$date 		= date("Y-m-d H:i:s");
			$datedeb 	= date('Y-m-d',strtotime($datedeb));
			$datefin	= date('Y-m-d',strtotime($datefin));
	
			$sql2 = "INSERT INTO wfp_chd_requestsdr (reqsdr_id, reqsdr_deman, reqsdr_date, reqsdr_raison, reqsdr_actvt, reqsdr_salle, reqsdr_nbr, reqsdr_deb, 
			reqsdr_fin, reqsdr_heurd, reqsdr_mind, reqsdr_heurf, reqsdr_minf, reqsdr_horaire1, reqsdr_horaire2, reqsdr_mmedia, reqsdr_pc, reqsdr_state)
				VALUES ('', '$deman', '$date', '$motif', '$activite', '$salle', '$nombre', '$datedeb', '$datefin', '$heurdeb', '$mindeb', '$heurfin', '$minfin', 
				'$saaa', '$saar', '$choixeq', '$choixpc', 'ATTENTE')";
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
					VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$motif $salle') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalanasksdr.php");
				header('Location:simple.php');
			}
			else
			{
				echo("<span class=\"alert alert-danger\">Echec Ajout <br><br><center><a href=\"add1asksdr.php\">retour</a></center></span>") ;
			}
		}
	}
	else
	{
		header('Location:oops.php');
	} 
?>
