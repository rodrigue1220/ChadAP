<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	$pro	= $mysqli->query("SELECT cto_approver AS OIC FROM wfp_chd_djmcto WHERE cto_id='$id'")->fetch_array();
	$sup	= $pro["OIC"];
	
	$sql	 = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
	$requete = $mysqli->query( $sql );
	$result	 = $requete->fetch_assoc();
	$nom 	 = $result["nom"];
	$prenom  = $result["prenom"];
			
	if ($sup != "$nom,$prenom")
	{
		header('Location:simple.php');
		exit();
	}
?>