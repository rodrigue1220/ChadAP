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
	$exitem		= $resultz["rqeqpmt_item"];
	$item		= $resultz["rqeqpmt_itemaprv"];
	$motif		= $resultz["rqeqpmt_motif"];
	$oicit		= $resultz["rqeqpmt_oicit"];
	
	$oicnom		= stristr($oicit, ',', true);
	$oicprenom 	= substr(stristr($oicit, ','), 1);
	$mess 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprenom'")->fetch_array();
	$messagit	= $mess['EM'];
	
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
	$body	.= 'Votre Demande de fourniture cr&eacute;&eacute;e a &eacute;t&eacute; TRAITEE : <br /><br />';
	$body	.= '<table><tr><td class="ligne">Item Demand&eacute; </td><td class="ligne"><b>'.$exitem.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Item Approuv&eacute; </td><td class="ligne"><b>'.$item.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Quantit&eacute; approuv&eacute;e </td><td class="ligne"><b>'.$nbrd.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Raison </td><td class="ligne"><b>'.utf8_decode($motif).'</b></td></tr></table><br />';
	$body	.= 'Merci de prendre contact avec Le Gestionnaire de Stock Administration pour la suite<br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad ADM Service Desk</b><br />';
	$body	.= '-------------------------------------------------------</center></body></html>';


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
	$mail->AddCC($messagit);
	
	$mail->Subject  = "Demande de Fourniture TRAITEE";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>