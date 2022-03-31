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
	$sqlz 		= "SELECT * FROM wfp_chd_request WHERE reqst_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz	= $requetez->fetch_assoc();
	$demandeur	= $resultz["reqst_nom"];
	$passager	= $resultz["reqst_passag"];
	$motif		= $resultz["reqst_motif"];
	$desti		= $resultz["reqst_dest"];
	
	$sqlw 		= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
	$requetew	= $mysqli->query( $sqlw );
	$resultw	= $requetew->fetch_assoc();
	$messagerie	= $resultw['email'];
	$nom		= $resultw['nom'];
	$prenom		= $resultw['prenom'];
	
	/* Construction du message */
    $body	 = 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Votre Demande de Transport cr&eacute;&eacute;e a &eacute;t&eacute; REJETEE par le Fleet Manager : <br /><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Passager (s) : <b>'.$passager.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motif : <b>'.$motif.'</b><br />';
	$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destination : <b>'.$desti.'</b><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '-------------------------------------------------------------------------------------</center></body></html>';


	$mail->IsSMTP();                           // tell the class to use SMTP
	
	$mail->Mailer = "smtp";

	$mail->SMTPAuth = false; // turn off SMTP authentication
	$mail->SMTPKeepAlive = true;

	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "smtprelay.global.wfp.org"; // SMTP server
	$mail->Username   = "SMTPUSERNAME";     // SMTP server username
	$mail->Password   = "SMTPPASS";            // SMTP server password

	$mail->AddReplyTo("chad.admservicedesk@wfp.org","Chad ADM Service Desk");

	$mail->From       = "chad.admservicedesk@wfp.org";
	$mail->FromName   = "Chad ADM Service Desk";

	$to = $messagerie;

	$mail->AddAddress($to);

	$mail->Subject  = "Demande de Transport REJETEE";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>