<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	session_start();
	require_once('config.php');

	$titre_page	='Inscription';
	$email		=echappe_car($_POST['email']);
	$utilis		=echappe_car($_POST['dem']);
	$mdp		=echappe_car($_POST['mdp']);
	$mdp2		=echappe_car($_POST['mdp2']);
	$nom		=echappe_car($_POST['nom']);
	$prenom		=echappe_car($_POST['pnom']);
	$phone		=echappe_car($_POST['tel']);
	$unite		=echappe_car($_POST['service']);
	$nadoum		=$_POST['adm'];


	if(!$mdp || !$mdp2 || strlen($mdp) < 5)
	{
		header('Location:oops661user.php?cle=MDPS2');
		exit();
		echo'Votre mot de passe ou sa confirmation est inexisant ou votre mot de passe fait moins de 5 carractères<br /><a href="add1user.php" onClick="history.back()">Retour</a>';
		return FALSE;
	}
	
	if($mdp!=$mdp2)
	{
		header('Location:oops661user.php?cle=MDPS1');
		exit();
	}
	
	if(!$utilis || strlen($utilis) > 15)
	{
		header('Location:oops661user.php?cle=PSDO2');
		exit();
	}
	
	if(!$email)
   	{
		echo'Votre e-mail est innexistant.<br /><a href="add1user.php" onClick="history.back()">Retour</a>';
		return FALSE;
   	}
	
	$reponse_mail=mysql_query("SELECT email FROM user WHERE email='$email'") or die ('Erreur : '.mysql_error());	
	$count_mail=mysql_num_rows($reponse_mail);
	if($count_mail == 1)
	{
		echo'Cet e-mail existe déjà.<br /><a href="add1user.php" onClick="history.back()">Retour</a>';
		return FALSE;
	}
	
	$reponse_pseudo=mysql_query("SELECT pseudo FROM user WHERE pseudo='$pseudo'") or die ('Erreur : '.mysql_error());	//verification si pseudo existe déjà
	$count_pseudo=mysql_num_rows($reponse_pseudo);
	if($count_pseudo == 1)
	{
		echo 'Ce pseudo existe déjà.<br /><a href="add1user.php" onClick="history.back()">Retour</a>';
		return FALSE;
	}
		
	for ($ligne=0;$ligne<30;$ligne++)		//Création d'un identifiant aléatoire
	{
		@$session.=substr('0123456789AZERTYUIOPMLKJHGFDSQWXCVBN',(rand()%(strlen('0123456789AZERTYUIOPMLKJHGFDSQWXCVBN'))),1);
	}
	
	$mdp=md5($mdp);		//Codage du mot de passe
	mysql_query("INSERT INTO user (id, session, pseudo, passe, email, nom, prenom, unite) VALUES ('', '$session', '$pseudo', '$mdp', '$email', '$nom', '$prenom', '$unite')") or die ('Erreur : '.mysql_error());	//insertion dans la bdd
	
		$agent	= $_SERVER['HTTP_USER_AGENT'];
		$fich	= $_SERVER['PHP_SELF'];
		$date 	= date("Y-m-d H:i:s");
		mysql_query("INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2) VALUES ( '', 'administrateur', '$agent', '$fich', '$date', 'ENREGISTREMENT', '$nom $unite')") or die ('Erreur: '.mysql_error());
	
	include_once("supercnxadmin.php");	
?>