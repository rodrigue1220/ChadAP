<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require ("D:/Apps/www/scripts/inc/class.phpmailer.php");

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	/*$body             = file_get_contents("D:/Apps/www/scripts/inc/confirmation.php");
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes */
	
	/* Construction du message */
    $body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Bienvenue sur la plateforme Chad AP v1.0 ! Veuillez contacter CHAD IT SERVICE DESK pour l\'activation de votre compte.<br />';
	$body	.= 'Une fois le compte ACTIF, vous pouvez acc&eacute;der en utilisant ce lien http://10.11.234.39:8080 et vos informations d\'identification suivantes: <br />';
	$body	.= '<table><tr><td class="ligne">Nom d\'utilisateur ou Pseudo </td><td class="ligne"><b>'.$pseudo.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Mot de passe </td><td class="ligne"><b>'.$mdb.'</b></td></tr></table><br />';
	$body	.= 'Si vous avez des questions, merci de bien vouloir les envoyer &agrave; l\'adresse suivante:  chad.itservicedesk@wfp.org <br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad IT Team</b><br />';
	$body	.= '-------------------------------------------------------------------------------------</center></body></html>';


	$mail->IsSMTP();                           // tell the class to use SMTP
	
	$mail->Mailer = "smtp";

	$mail->SMTPAuth = false; // turn off SMTP authentication
	$mail->SMTPKeepAlive = true;

	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "smtprelay.global.wfp.org"; // SMTP server
	$mail->Username   = "SMTPUSERNAME";     // SMTP server username
	$mail->Password   = "SMTPPASS";            // SMTP server password

	$mail->AddReplyTo("chad.itservicedesk@wfp.org","Chad IT Service Desk");

	$mail->From       = "chad.itservicedesk@wfp.org";
	$mail->FromName   = "Chad IT Service Desk";

	$to = $email;

	$mail->AddAddress($to);

	$mail->Subject  = "Confirmation de votre Compte";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	include("D:/Apps/www/scripts/confirmcnx.php");
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>