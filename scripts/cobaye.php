<?php
	require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php');
	require_once('connexion.php');
  

		$sql1 = "DELETE FROM wfp_chd_sandouk WHERE stock_nbr='0' ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);

  ?>
