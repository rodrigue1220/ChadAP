<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=wfp_chad_automation;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
