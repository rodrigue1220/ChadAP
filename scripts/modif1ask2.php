<?php
require('ctrl.php');
require_once('config.php');
require_once('verifications.php');
include('connexion.php');

  $nom			= $pseudo ;
  $id	 		= $_POST["id"] ;
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
  
	$date 		= date("Y-m-d H:i:s");
	$datedep 	= date('Y-m-d',strtotime($datedep));
	$dateret	= date('Y-m-d',strtotime($dateret));


			$sql2 = "UPDATE wfp_chd_request SET reqst_nom='$nom', reqst_motif='$motif', reqst_dest='$desti', 
					reqst_passag='$details', reqst_dep='$datedep', reqst_ret='$dateret', reqst_heurd='$heurdep',
					reqst_mind='$mindep', reqst_heurr='$heurret', reqst_minr='$minret', reqst_oic='$officer'
					WHERE reqst_id='$id' ";
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				$agent	= $_SERVER['HTTP_USER_AGENT'];
				$fich	= $_SERVER['PHP_SELF'];
				$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$pseudo', '$agent', '$fich', '$date', 'MODIFICATION', 'Demande $id') ";
				$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
				include("inc/rissalanask.php");
				header('Location:accueil.php');
			}
			
			else
			{
				echo("<span class=\"alert alert-danger\">Echec Modification <br><br><center><a href=\"modif1ask.php?id=$id\">retour</a></center></span>") ;
			}
  
  ?>
