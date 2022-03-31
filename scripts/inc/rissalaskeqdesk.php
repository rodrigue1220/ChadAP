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
	$sqls = "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_ref='$refer' " ;
	$requetes	= $mysqli->query( $sqls );
	$results	= $requetes->fetch_assoc();
	$demandeur	= $results["rqeqpmt_demand"];
	$approver	= $results["rqeqpmt_oic"]; 
	//$nbr		= $results["rqeqpmt_nbr"]; 
	$motif		= $results["rqeqpmt_motif"]; 
	//$item		= $results["rqeqpmt_item"]; 
	
	$sqlz = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz	= $requetez->fetch_assoc();
	$nom		= $resultz["nom"];
	$prenom 	= $resultz["prenom"];
	
	
	/* Construction du message */
    $body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Ch&egrave;re <b>Equipe IT Service Desk</b>,<br /><br />';
	$body	.= 'Une Nouvelle Demande d\'&eacute;quipement cr&eacute;&eacute;e, en ATTENTE de votre SUIVI : <br /><br />';
	$body	.= '<table><tr><td class="ligne">Demandeur </td><td class="ligne"><b>'.$nom.' '.$prenom.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Raison </td><td class="ligne"><b>'.$motif.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Approuv&eacute;e par </td><td class="ligne"><b>'.$approver.'</b></td></tr></table><br />';
	$body	.= 'Merci de vous connecter sur <a href="http://10.109.87.10:8080">la plateforme</a>, pour donner suite &agrave; la demande <br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad IT Service Desk</b><br />';
	$body	.= '-------------------------------------------------------</center></body></html>';


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

	$messagerie	= "chad.itservicedesk@wfp.org";
	$to = $messagerie;

	$mail->AddAddress($to);

	$mail->Subject  = "SUIVI Demande Equipement";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();

} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>