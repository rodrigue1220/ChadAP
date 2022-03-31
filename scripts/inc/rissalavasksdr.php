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
	$sqlz 		= "SELECT * FROM wfp_chd_requestsdr WHERE reqsdr_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz	= $requetez->fetch_assoc();
	$demandeur	= $resultz["reqsdr_deman"];
	$motif		= $resultz["reqsdr_raison"];
	$salle		= $resultz["reqsdr_salle"];
	$datedeb	= $resultz["reqsdr_deb"];
	$datefin	= $resultz["reqsdr_fin"];
	$heurd		= $resultz["reqsdr_heurd"];
	$mind		= $resultz["reqsdr_mind"];
	$heurf		= $resultz["reqsdr_heurf"];
	$minf		= $resultz["reqsdr_minf"];
	$comm		= $resultz["reqsdr_lib"];
	
	if ($comm =='')
	{
		$comm='RAS';
	}
	
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
	$body	.= 'Votre Demande de SDR cr&eacute;&eacute;e a &eacute;t&eacute; APPROUVEE : <br /><br />';
	$body	.= '<table><tr><td class="ligne">Raison (s) </td><td class="ligne"><b>'.utf8_decode($motif).'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Salle Approuv&eacute;e </td><td class="ligne"><b>'.$salle.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">D&eacute;but </td><td class="ligne"><b>'.$datedeb.' '.$heurd.'h'.$mind.'mn</b></td></tr>';
	$body	.= '<tr><td class="ligne">Fin </td><td class="ligne"><b>'.$datefin.' '.$heurf.'h'.$minf.'mn</b></td></tr>';
	$body	.= '<tr><td class="ligne">Commentaires </td><td class="ligne"><b>'.utf8_decode($comm).'</b></td></tr></table><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Admin SDR</b><br />';
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

	$mail->Subject  = "Demande de SDR APPROUVEE";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>