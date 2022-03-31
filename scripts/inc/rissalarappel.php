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
	include("D:/Apps/www/scripts/connexion.php");
	$sql 		= "SELECT DISTINCT MSISDN_NO FROM wfp_chd_bilpp WHERE STATE='ATTENTE' " ;
	$requete 	= $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$phone		= $result['MSISDN_NO'];
		
		$exis = $mysqli->query("SELECT id AS ID FROM user WHERE tel='$phone' OR tel2='$phone' ")->fetch_array();
		if($exis['ID'] != 0)
		{
		$sqlw 		= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' " ;
		$requetew	= $mysqli->query( $sqlw );
		$resultw	= $requetew->fetch_assoc();
		$messagerie	= $resultw['email'];
		$nom		= $resultw['nom'];
		$prenom		= $resultw['prenom'];
	
	
		/* Construction du message */
		$body	 = 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
		$body	.= 'Vous avez de (s) Facture (s) en Attente d\'identification : <br />';
		$body	.= 'Merci de faire le necessaire avant la g&eacute;n&eacute;ration des FACTURES. Lien de la plateforme http://10.11.234.39:8080 <br /><br />';
		$body	.= 'Cordialement,<br />';
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
		$mail->FromName   = "CHAD.ITSERVICEDESK";

		$to = $messagerie;

		$mail->AddAddress($to);

		$mail->Subject  = "RAPPEL IDENTIFICATION";

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap

		$mail->MsgHTML($body);

		$mail->IsHTML(true); // send as HTML

		$mail->Send();
		}
		
	}
	include("D:/Apps/www/scripts/gestgourouss.php");
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>