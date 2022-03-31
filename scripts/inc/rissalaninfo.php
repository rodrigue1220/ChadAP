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
	$body	.= '<u><b><i>Ce Message est envoy&eacute; &agrave; tout le Staff CO CHAD</i></b></u><br /><br />';
	$body	.= '<b>Chers Coll&egrave;gues</b>,<br /><br />';
	$body	.= 'Dans le cadre des efforts constants d&eacute;ploy&eacute;s pour am&eacute;liorer les services informatiques, nous effectuerons des activit&eacute;s de maintenance sur la plate-forme Chad AP. <br /><br />';
	$body	.= '<table><tr><td class="ligne">Date et heure</td><td class="ligne"><b> Jeudi 31 Octobre 2019 de 08h00 &agrave; 17h00</b></td></tr>';
	$body	.= '<tr><td class="ligne">Objectif de la maintenance</td><td class="ligne"><b> ajout des patches sur le module Leaves System, migration des donn&eacute;es</b></td></tr></table><br />';
	$body	.= 'Durant cette p&eacute;riode, la plate-forme ne sera pas disponible.<br />'; 
	$body	.= 'Si vous rencontrez des probl&egrave;mes pour acc&eacute;der &agrave; la plate-forme apr&egrave;s la p&eacute;riode de maintenance, n\'h&eacute;sitez pas &agrave; nous contacter.<br /><br />Nous nous excusons pour tout inconv&eacute;nient que cette interruption pourrait causer.<br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad IT Team</b><br />';
	$body	.= '--------------------------------------------------------</center></body></html>';


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
	$email2= "leopold.happy@wfp.org";
	$to = $email;

	$mail->AddCC($email2);
	$mail->AddBCC($to);

	$mail->Subject  = "CHAD AP - Maintenance Planifiee";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>