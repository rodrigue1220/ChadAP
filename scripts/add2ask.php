<?php
require('ctrl.php');
include('connexion.php');

  $nom			= $_POST["nom"] ;
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

		
		$nb = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_date='$date' AND reqst_nom='$nom' AND reqst_dep='$datedep' AND reqst_heurd='$heurdep' ")->fetch_array();
		
		if($nb['nb']!=0){
		
			echo'Cette Demande existe deja <br><br><center><a href="addask.php">retour</a></center>' ;
		}
		
		else 
		{
			$sql2 = "INSERT INTO wfp_chd_request (reqst_id, reqst_date, reqst_nom, reqst_motif, reqst_dest, reqst_passag, reqst_dep, reqst_ret, reqst_heurd, reqst_mind, reqst_heurr, reqst_minr, reqst_oic, reqst_chauf, reqst_kmdep, reqst_kmret, reqst_statoic, reqst_state)
					VALUES ('', '$date', '$nom', '$motif', '$desti', '$details', '$datedep', '$dateret', '$heurdep', '$mindep', '$heurret', '$minret', '$officer', '', '', '', 'ATTENTE', 'ATTENTE')";
					
			$requete2 = $mysqli->query($sql2) or die( $mysqli->connect_errno()) ;
			if( $requete2 )
			{	
				header('Location:addask.php');
			}
			
			else
			{
				echo'Echec Ajout <br><br><center><a href="addask.php">retour</a></center>' ;
			}
		}
  
  ?>
