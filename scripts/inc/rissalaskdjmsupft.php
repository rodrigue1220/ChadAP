<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require ("D:/Apps/www/scripts/inc/class.phpmailer.php");

try {
	/*$body             = file_get_contents("D:/Apps/www/scripts/inc/confirmation.php");
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes */

	$mail = new PHPMailer(true); //New instance, with exceptions enabled
	
	$oicnom		= stristr($superv, ',', true);
	$oicprenom 	= substr(stristr($superv, ','), 1);
	$mess 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprenom'")->fetch_array();
	$messagerie	= $mess['EM'];
	
	$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
	$requetet	= $mysqli->query( $sqlt );
	$resultt	= $requetet->fetch_assoc();
	$nom		= $resultt["nom"];
	$prenom 	= $resultt["prenom"];

	
	/* Construction du message */
	$body	 = 'Cher(e) <b>'.$oicnom.' '.$oicprenom.'</b>,<br /><br />';
	$body	.= 'Une Nouvelle Demande de Cong&eacute;s <b>'.$type.'</b> cr&eacute;&eacute;e, en ATTENTE de votre APPROBATION / Superviseur : <br /><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demandeur : <b>'.$nom.' '.$prenom.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Du : <b>'.$wakit.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Au : <b>'.$ret.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre de Jour : <b>'.$nbjour.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demande sur Self Service: <b>'.$choix.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date de reprise : <b>'.$drep.'</b><br />';
	$body	.= 'Merci de vous connecter sur la plateforme: http://10.11.234.39:8080, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= 'Chad HR Service Desk<br />';
	$body	.= '--------------------------------------------------------';


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
	$to = $messagerie;
	$mail->AddAddress($to);
	$mail->Subject  = "APPROBATION Demande Conges";
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap
	$mail->Charset ="iso-8859-1";
	$mail->MsgHTML($body);
	$mail->IsHTML(true); // send as HTML
	
	$mail->Send();
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>