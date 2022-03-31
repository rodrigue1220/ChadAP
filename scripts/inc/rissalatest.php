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
	
	$sql = "SELECT * FROM user WHERE profil='AdminSTDESK' " ;
	$requete = $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
		$adnom		= $result["nom"];
		$adprenom 	= $result["prenom"];
		$messagerie	= $result["email"];

	
		/* Construction du message */
		$body	 = 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';
		$body	.= 'Ceci est un test envoy&eacute; automatiquement!!! Merci de ne pas tenir compte<br /><br />';
		$body	.= 'Cordialement,<br />';
		$body	.= 'Sys Auto<br />';
		$body	.= '--------------------------------------------------------';


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
		
		$to = $messagerie;
		$mail->AddAddress($to);
		$mail->Subject  = "TEST";
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
		$to = NULL;

	}
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>