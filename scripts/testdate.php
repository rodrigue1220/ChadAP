<?php
	$mois	= date('Y-m', strtotime('-1 month'));
	$mois2	= date('Y-m');
	$mois	= $mois.'-01';
	$mois2	= $mois2.'-01';
	
	echo $mois;
	echo '<br />';
	echo $mois2;
?>