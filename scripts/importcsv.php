<?php

/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	include('connexion_csv.php');

	if (isset($_POST["import"])) 
	{	
		$fileName = $_FILES["file"]["tmp_name"];
		$line = file($fileName);
		$line = count($line);
		
		if ($_FILES["file"]["size"] > 0) 
		{	
			$file = fopen($fileName, "r");
			
			while (($column = fgetcsv($file, 0, ",")) !== FALSE) 
			{
				$sql = "INSERT INTO wfp_chd_bilpp (ID, MSISDN_NO, CALLED_NO, CALL_DURATION, START_TIME, ORIGINAL_CALL_TYPE, ORIGINATING_COUNTRY,
				TERMINATING_COUNTRY, CHARGABLE_AMOUNT, MONTH, PRIV_OFF, STATE, DATE_IDEN, TYPE_SIM)
					   VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "',
					   '" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "','" . $column[10] . "','" . $column[11] . "',
					   '" . $column[12] . "','" . $column[13] . "')";
					   
				$mysqli->query($sql) or die ('Erreur '.$sql.' '.$mysqli->error);
				
				/*if (! empty($result))
				{
					header('Location:importcsvdwn.php?cle=OUI');
					exit;
				}
				else 
				{
					header('Location:importcsvdwn.php?cle=NON');
				}*/
			}
			fclose($file); 
			header('Location:importcsvdwn.php?cle=OUI&nb='.$line.'');
			exit;
		}
	}
?>