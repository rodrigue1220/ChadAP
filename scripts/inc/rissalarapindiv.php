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

	$phone		= $_GET['tel'];
	$mois		= $_GET['cle'];	

	$sqlw 		= "SELECT * FROM user WHERE tel='$phone' OR tel2='$phone' " ;
	$requetew	= $mysqli->query( $sqlw );
	$resultw	= $requetew->fetch_assoc();
	$messagerie	= $resultw['email'];
	$nom		= $resultw['nom'];
	$prenom		= $resultw['prenom'];
	
	
	/* Construction du message */
	$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Vous avez la Facture de <b>'.$mois.'</b> toujours en Attente d\'identification : <br />';
	$body	.= 'Merci de faire le necessaire avant la g&eacute;n&eacute;ration des FACTURES. Lien de la plateforme http://10.11.234.39:8080 <br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '-------------------------------------------------------------------------------------</center></body></html>';


	$mail->IsSMTP();                           // tell the class to use SMT
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

	$date	= date("Y-m-d H:i:s");
	$agent	= $_SERVER['HTTP_USER_AGENT'];
	$fich	= $_SERVER['PHP_SELF'];
	$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
			VALUES ( '', '$mois', '$agent', '$fich', '$date', 'RAPPEL IDENTIFICATION', '$nom $prenom') ";
	$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
	echo 'Message envoyeacute;'; header ('Location:../rechfactnidenpm.php?cle='.$mois.'');
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>