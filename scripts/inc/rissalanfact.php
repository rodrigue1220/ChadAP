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
    $body	.= '<b>Chers Coll&egrave;gues</b>,<br /><br />';
	$body	.= 'Les Factures Airtel de : <br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<b>Ao&ucirc;t</b><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<b>Septembre</b><br />Sont disponibles et en Attente d\'identification,<br />';
	$body	.= 'Merci de faire le necessaire avant la g&eacute;n&eacute;ration AUTOMATIQUE des FACTURES. Lien de la plateforme http://10.11.234.39:8080 <br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad IT Service Desk</b><br />';
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
	
	$email= "co_chd_user_list@wfp.org";
	$to = $email;

	$mail->AddAddress($to);

	$mail->Subject  = "FACTURE (S) EN ATTENTE D'IDENTIFICATION";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>