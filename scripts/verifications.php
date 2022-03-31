<?php

$session=formulaires($_SESSION['session']);
if(!@$_SESSION['session'])
{
	header('Location:log_admin.php?erreur=connexion');
	return false;
}
	
$verif=mysql_query("SELECT * FROM user WHERE session='$session'") or die ('Erreur : '.mysql_error());	
$verif=mysql_num_rows($verif);
if($verif == 0)
{
	header('Location:log_admin.php?erreur=connexion');
	session_unset();
	session_destroy();
	return false;
}

$sql=mysql_query("SELECT * FROM user WHERE session='$session'") or die ('Erreur : '.mysql_error());
while ($resultat = mysql_fetch_array($sql) )
	{
	$email = $resultat['email'];
	$pseudo = $resultat['pseudo'];
	$id = $resultat['id'];
	}
?>