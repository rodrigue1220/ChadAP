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
	
	$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
	$requetet	= $mysqli->query( $sqlt );
	$resultt	= $requetet->fetch_assoc();
	$nom		= $resultt["nom"];
	$prenom 	= $resultt["prenom"];
	$messagerie = $resultt["email"];
	$comm		= stripslashes($comm);

	
	/* Construction du message */
	$body	 = 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Votre Demande de Cong&eacute;s cr&eacute;&eacute;e a &eacute;t&eacute; REJETEE / OIC: <br /><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OIC : <b>'.$oicnom.' '.$oicprenom.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Superviseur : <b>'.$supnom.' '.$suprenom.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Du : <b>'.$resultz['lv_deb'].'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Au : <b>'.$resultz['lv_ret'].'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre de Jour : <b>'.$resultz['lv_nombre'].'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date de reprise : <b>'.$resultz['lv_rep'].'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motif REJET : <b>'.utf8_decode($comm).'</b><br /><br />';
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
	$mail->AddCC($messcc);
	$mail->Subject  = "Demande Conges REJETEE";
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