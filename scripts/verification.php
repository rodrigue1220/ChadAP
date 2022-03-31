<?php

session_start();
require_once('config.php');
$titre_page='Inscription';
$email=formulaires($_POST['email']);
$pseudo=formulaires($_POST['pseudo']);
$mdp=formulaires($_POST['mdp']);
$mdp2=formulaires($_POST['mdp2']);
$nom=formulaires($_POST['nom']);
$prenom=formulaires($_POST['pnom']);


if(!$mdp || !$mdp2 || strlen($mdp) < 5)
	{
	echo'Votre mot de passe ou sa confirmation est inexisant ou votre mot de passe fait moins de 5 carractères<br /><a href="inscription.php" onClick="history.back()">Retour</a>';

return FALSE;
	}
if($mdp!=$mdp2)
	{
	echo'Votre mot de passe n\'est pas le meme que sa confirmation<br /><a href="inscription.php" onClick="history.back()">Retour</a>';

return FALSE;
	}
if(!$pseudo || strlen($pseudo) > 15)
	{
	echo'Votre pseudo est inexisant ou fait plus de 15 carractères<br /><a href="inscription.php" onClick="history.back()">Retour</a>';

return FALSE;
	}
if(!$email)
   	{
	echo'Votre e-mail est innexistant.<br /><a href="inscription.php" onClick="history.back()">Retour</a>';

return FALSE;
   	}
	

$reponse_mail=mysql_query("SELECT email FROM user WHERE email='$email'") or die ('Erreur : '.mysql_error());	
$count_mail=mysql_num_rows($reponse_mail);
if($count_mail == 1)
	{
	echo'Cet e-mail existe déjà.<br /><a href="inscription.php" onClick="history.back()">Retour</a>';

return FALSE;
	}
$reponse_pseudo=mysql_query("SELECT pseudo FROM user WHERE pseudo='$pseudo'") or die ('Erreur : '.mysql_error());	//verification si pseudo existe déjà
$count_pseudo=mysql_num_rows($reponse_pseudo);
if($count_pseudo == 1)
	{
	echo 'Ce pseudo existe déjà.<br /><a href="inscription.php" onClick="history.back()">Retour</a>';

return FALSE;
	}
		
	for ($ligne=0;$ligne<30;$ligne++)		//Création d'un identifiant aléatoire
		{
		@$session.=substr('0123456789AZERTYUIOPMLKJHGFDSQWXCVBN',(rand()%(strlen('0123456789AZERTYUIOPMLKJHGFDSQWXCVBN'))),1);
		}

		$mdp=md5($mdp);		//Codage du mot de passe
		mysql_query("INSERT INTO user (id, session, pseudo, passe, email, nom, prenom) VALUES ('', '$session', '$pseudo', '$mdp', '$email', '$nom', '$prenom')") or die ('Erreur : '.mysql_error());	//insertion dans la bdd
		echo'<br><br><br><center>Vous venez de créer votre compte<br /><a href="../index.php">Identifiez vous !</a></center>';

?>