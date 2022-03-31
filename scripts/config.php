<?php

$serveur='localhost';
$user='root';	
$mdp='';	
$base='wfp_chad_automation';

$localite='local';	


@$connect=mysql_connect($serveur, $user, $mdp) or die ('Erreur : '.mysql_error());
@mysql_select_db($base) or die ('Erreur : '.mysql_error());
require_once('fonctions.php');

?>