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
	$sqlz 		= "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz	= $requetez->fetch_assoc();
	$demandeur	= $resultz["rqeqpmt_demand"];
	$item		= $resultz["rqeqpmt_item"];
	$nbr		= $resultz["rqeqpmt_nbr"];
	
	$sqlw 		= "SELECT * FROM user WHERE pseudo='$demandeur' " ;
	$requetew	= $mysqli->query( $sqlw );
	$resultw	= $requetew->fetch_assoc();
	$messagerie	= $resultw['email'];
	$nom		= $resultw['nom'];
	$prenom		= $resultw['prenom'];
	
	/* Construction du message */
    $body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Votre Demande d\'&eacute;quipement cr&eacute;&eacute;e a &eacute;t&eacute; REJETEE par le OIC / IT : <br /><br />';
	$body	.= '<table><tr><td class="ligne">R&eacute;f&eacute;rence Demande </td><td class="ligne"><b>'.$refer.'</b></td></tr></table><br />';
	//$body	.= '<tr><td class="ligne">Quantit&eacute; </td><td class="ligne"><b>'.$nbr.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Raison Rejet</td><td class="ligne"><b>'.$comm.'</b></td></tr></table><br />';
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

	$mail->AddReplyTo("chad.itservicedesk@wfp.org","Chad IT Service Desk");

	$mail->From       = "chad.itservicedesk@wfp.org";
	$mail->FromName   = "Chad IT Service Desk";

	$to = $messagerie;
	$toto = "chad.itservicedesk@wfp.org";

	$mail->AddAddress($to);
	$mail->AddCC($toto);

	$mail->Subject  = "Demande Equipement REJETEE";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>