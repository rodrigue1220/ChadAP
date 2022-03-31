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
	$sqlz = "SELECT * FROM user WHERE pseudo='$user' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz	= $requetez->fetch_assoc();
	$nom		= $resultz["nom"];
	$prenom 	= $resultz["prenom"];
		
	/* Construction du message */
	$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>IZZO Abderrahman Zaki</b>,<br /><br />';
	$body	.= 'Une Nouvelle SUGGESTION / COMMENTAIRE est soumis(e) sur ChadAP pour vos appr&eacute;ciations<br />';
	$body	.= 'D&eacute;tails :<br /><br />';
	$body	.= '<table><tr><td class="ligne">Soumis (e) par </td><td class="ligne"><b>'.$nom.' '.$prenom.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Module </td><td class="ligne"><b>'.utf8_decode($module).'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Lib&eacute;ll&eacute; </td><td class="ligne"><b>'.utf8_decode($rmrq).'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Proposition </td><td class="ligne"><b>'.utf8_decode($propos).'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Le </td><td class="ligne"><b>'.$date.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">D&eacute;sire &ecirc;tre Contact&eacute; </td><td class="ligne"><b>'.$choix.'</b></td></tr></table><br />';
	$body	.= 'Cordialement,<br /><br />';
	$body	.= '<i>Email Envoy&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i><br />';
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
	
	$to = "izzo.zaki@wfp.org";

	$mail->AddAddress($to);

	$mail->Subject  = "SUGGESTION/COMMENTAIRE";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>