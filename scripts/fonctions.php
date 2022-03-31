<?php

function formulaires($valeur)
	{
	$valeur=trim(htmlspecialchars(addslashes($valeur)));
	return $valeur;
	}

function echappe_car($string)
	{
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		// Pour tous les autres types
		else
		{
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		
		return $string;
	}
?>