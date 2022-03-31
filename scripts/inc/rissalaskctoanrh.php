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
	
	$sqlz	 	= "SELECT * FROM wfp_chd_djmcto WHERE cto_id='$id' " ;
	$requetez	= $mysqli->query( $sqlz );
	$resultz 	= $requetez->fetch_assoc();
	$nopers		= $resultz['cto_index'];
	$oic		= $resultz['cto_approver'];
	$debut		= $resultz['cto_deb'];
	$comm		= stripslashes($comm);
	
	$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
	$requetet	= $mysqli->query( $sqlt );
	$resultt	= $requetet->fetch_assoc();
	$nom		= $resultt["nom"];
	$prenom 	= $resultt["prenom"];
	$messagerie = $resultt["email"];
	
	$oicnom		= stristr($oic, ',', true);
	$oicprenom 	= substr(stristr($oic, ','), 1);
	$mess 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprenom'")->fetch_array();
	$messoic	= $mess['EM'];

	
	/* Construction du message */
	$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Votre Demande de CTO / HS a &eacute;t&eacute; ANNULE / RH: <br /><br />';
	$body	.= '<table><tr><td class="ligne">Num&eacute;ro demande </td><td class="ligne"><b>'.$id.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Date pr&eacute;vue </td><td class="ligne"><b>'.$debut.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Motif ANNULATION </td><td class="ligne"><b>'.utf8_decode($comm).'</b></td></tr></table><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad HR Service Desk</b><br />';
	$body	.= '--------------------------------------------------------</center></body></html>';


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
	$toto = "chad.hrservicedesk@wfp.org";
	
	$mail->AddAddress($to);
	$mail->AddCC($messoic);
	$mail->AddCC($toto);

	$mail->Subject  = "Demande CTO-HS ANNULEE";
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