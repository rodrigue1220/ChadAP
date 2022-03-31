<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require ("D:/Apps/www/scripts/inc/class.phpmailer.php");
include ("D:/Apps/www/scripts/connexion.php");
try {

	/*$body             = file_get_contents("D:/Apps/www/scripts/inc/confirmation.php");
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes */
	
	$mois		= date('Y-m', strtotime('-1 month'));
	$mois2		= date('Y-m');
	
	$sqldj	= "SELECT * FROM wfp_chd_djmcto WHERE (cto_deb LIKE '$mois%' OR cto_deb2 LIKE '$mois%') 
				AND (cto_statut='APPROUVE' OR cto_statut='EFFECTUE' OR cto_statut='ATTENTE') " ;

	$reqdj	= $mysqli->query($sqldj) ;
	
	while($resudj = $reqdj->fetch_assoc())
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled

		$nopers		= $resudj["cto_index"];
		$sup		= $resudj["cto_approver"];
		$statut		= $resudj["cto_statut"];
		$debut		= $resudj["cto_deb"];
		$ldate 		= date("Y-m-d");
		
		$supnom		= stristr($sup, ',', true);
		$suprnom 	= substr(stristr($sup, ','), 1);
		$messup 	= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$supnom' AND prenom='$suprnom'")->fetch_array();
		$emailsup	= $messup['EM'];
				
		$sql 		= "SELECT * FROM user WHERE indexid='$nopers' " ;
		$requete 	= $mysqli->query( $sql ) ;
		$result 	= $requete->fetch_assoc();
	
		$adnom		= $result["nom"];
		$adprenom 	= $result["prenom"];
		$messagerie	= $result["email"];

		if ($statut == "ATTENTE")
		{
			$destinom	= $supnom;
			$destipnom	= $suprnom;
			$to			= $emailsup;
			$to2		= $messagerie;

			/* Construction du message */
			$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
			$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
			$body	.= 'Cher(e) <b>'.$destinom.' '.$destipnom.'</b>,<br /><br />';
			$body	.= 'Ceci est un RAPPEL<br />';
			$body	.= 'Il y a de(s) Demande(s) d\'ex&eacute;cution d\'Heures Suppl&eacute;mentaires en ATTENTE de votre AUTORISATION, Superviseur / OIC<br />';
			$body	.= 'Merci de donner suite &agrave; ces demandes. Lien de <a href="http://10.109.87.10:8080">la plateforme</a> <br /><br />';
			$body	.= '<table><tr><td class="ligne">Mois </td><td class="ligne"><b>'.$mois.'</b></td></tr></table><br />';
			$body	.= 'Apr&egrave;s le <b>'.$mois2.'-04</b>, le syst&egrave;me ne les prendra plus en compte.<br /><br />';
			$body	.= 'Cordialement,<br /><br />';
			$body	.= '<i>Email g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i><br />';
			$body	.= '-------------------------------------------------------------------------------------------------------------------------</center></body></html>';		
		}
		else if ($statut == "APPROUVE")
		{
			$destinom	= $adnom;
			$destipnom	= $adprenom;
			$to2		= $emailsup;
			$to			= $messagerie;
			
			/* Construction du message */
			$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
			$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
			$body	.= 'Cher(e) <b>'.$destinom.' '.$destipnom.'</b>,<br /><br />';
			$body	.= 'Ceci est un RAPPEL<br />';
			$body	.= 'Il y a de(s) Demande(s) d\'ex&eacute;cution d\'Heures Suppl&eacute;mentaires AUTORISEE par votre Superviseur / OIC<br />';
			$body	.= 'Les demandes ex&eacute;cut&eacute;es doivent &ecirc;tre soumis pour CERTIFICATION. Lien de <a href="http://10.109.87.10:8080">la plateforme</a><br /><br />';
			$body	.= '<table><tr><td class="ligne">Mois </td><td class="ligne"><b>'.$mois.'</b></td></tr></table><br />';
			$body	.= 'Apr&egrave;s le <b>'.$mois2.'-04</b>, le syst&egrave;me ne les prendra plus en compte.<br /><br />';
			$body	.= 'Cordialement,<br /><br />';
			$body	.= '<i>Email g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i><br />';
			$body	.= '-------------------------------------------------------------------------------------------------------------------------</center></body></html>';			
		
		}		
		else if ($statut == "EFFECTUE")
		{
			$destinom	= $supnom;
			$destipnom	= $suprnom;
			$to			= $emailsup;
			$to2		= $messagerie;

			/* Construction du message */
			$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
			$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
			$body	.= 'Cher(e) <b>'.$destinom.' '.$destipnom.'</b>,<br /><br />';
			$body	.= 'Ceci est un RAPPEL<br />';
			$body	.= 'Il y a de(s) Demande(s) d\'Heures Suppl&eacute;mentaires en ATTENTE de votre CERTIFICATION, Superviseur / OIC<br />';
			$body	.= 'Merci de donner suite &agrave; ces demandes. Lien de <a href="http://10.109.87.10:8080">la plateforme</a><br /><br />';
			$body	.= '<table><tr><td class="ligne">Mois </td><td class="ligne"><b>'.$mois.'</b></td></tr></table><br />';
			$body	.= 'Apr&egrave;s le <b>'.$mois2.'-04</b>, le syst&egrave;me ne les prendra plus en compte.<br /><br />';
			$body	.= 'Cordialement,<br /><br />';
			$body	.= '<i>Email g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i><br />';
			$body	.= '-------------------------------------------------------------------------------------------------------------------------</center></body></html>';			
		}

		$mail->IsSMTP();                           // tell the class to use SMTP
	
		$mail->Mailer = "smtp";

		$mail->SMTPAuth = false; // turn off SMTP authentication
		$mail->SMTPKeepAlive = true;

		$mail->Port       = 25;                    // set the SMTP server port
		$mail->Host       = "smtprelay.global.wfp.org"; // SMTP server
		$mail->Username   = "SMTPUSERNAME";     // SMTP server username
		$mail->Password   = "SMTPPASS";            // SMTP server password

		$mail->AddReplyTo("chad.hrservicedesk@wfp.org","Chad HR Service Desk");
		$mail->From       = "chad.hrservicedesk@wfp.org";
		$mail->FromName   = "Chad HR Service Desk";
		
		$mail->AddAddress($to);
		$mail->AddCC($to2);
			
		$mail->Subject  = "RAPPEL DEMANDES CTO";
		$mail->AltBody 	= "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
		
		$date 		= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nopers', 'SYS_AUTO', '', '$date', 'RAPPEL_DEM_CTO', '$sup $statut $to $to2') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		$to		= NULL;
		$to2 	= NULL;

	}
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>