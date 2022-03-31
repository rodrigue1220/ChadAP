<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

session_start();
require_once('config.php');
include("connexion.php");

//récupération des variables
$pseudo = addslashes($_POST['pseudo']);
$mdp = addslashes($_POST['mdp']);

$mdp=md5($mdp);	//Codage du mdp

if ($mdp == "" || $pseudo == "")
{
	header('Location:../index.php');
}

if(!$pseudo)
{
	header('Location:log_admin.php?erreur=pseudo');
}
if(!$mdp)
{
	header('Location:log_admin.php?erreur=passe');
}

$reponse_cores=$mysqli->query("SELECT * FROM user WHERE pseudo='$pseudo' AND passe='$mdp' AND state='ACTIF' ") or die ('Erreur : '.$mysqli->connect_errno());
$count_cores= $reponse_cores->num_rows;
if($count_cores == 0 )
{
	header('Location:log_admin.php?erreur=connexion');		//on vérifie la correspondance
}
else
{
	for ($ligne=0;$ligne<30;$ligne++)		//Création d'un identifiant aléatoire
	{
		@$session.=substr('0123456789AZERTYUIOPMLKJHGFDSQWXCVBN',(rand()%(strlen('0123456789AZERTYUIOPMLKJHGFDSQWXCVBN'))),1);
	}
	
	$mysqli->query("UPDATE user SET session='$session-$pseudo' WHERE passe='$mdp' AND pseudo='$pseudo' ") or die ('Erreur : '.$mysqli->connect_errno());
	$_SESSION['session'] = "$session-$pseudo";		//création de la session
	header('Location:log_admin.php');			//redirection vers l'index
}
	
mysql_close();
?>
