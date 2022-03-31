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
	
	$sql = "SELECT * FROM user WHERE profil='AdminSDR' " ;
	$requete = $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
		$sqlz = "SELECT * FROM user WHERE pseudo='$deman' " ;
		$requetez	= $mysqli->query( $sqlz );
		$resultz	= $requetez->fetch_assoc();
		$nom		= $resultz["nom"];
		$prenom 	= $resultz["prenom"];
		
		$adnom		= $result["nom"];
		$adprenom 	= $result["prenom"];
		$messagerie	= $result["email"];

	
		/* Construction du message */
		$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
		$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
		$body	.= 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';
		$body	.= 'Une Nouvelle Demande de R&eacute;servation de SDR cr&eacute;&eacute;e, en ATTENTE de votre APPROBATION : <br /><br />';
		$body	.= '<table><tr><td class="ligne">Demandeur </td><td class="ligne"><b>'.$nom.' '.$prenom.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Raison </td><td class="ligne"><b>'.$motif.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Salle </td><td class="ligne"><b>'.$salle.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">D&eacute;but </td><td class="ligne"><b>'.$datedeb.' '.$heurdeb.'h'.$mindeb.'mn</b></td></tr>';
		$body	.= '<tr><td class="ligne">Fin </td><td class="ligne"><b>'.$datefin.' '.$heurfin.'h'.$minfin.'mn</b></td></tr></table><br />';
		$body	.= 'Merci de vous connecter sur la plateforme: http://10.11.234.39:8080, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
		$body	.= 'Email envoy&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!<br />';
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
		$mail->Subject  = "Nouvelle Demande de SDR";
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