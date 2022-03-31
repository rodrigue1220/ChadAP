<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require ("D:/Apps/www/scripts/inc/class.phpmailer.php");

try {
	
	include("D:/Apps/www/scripts/connexion.php");

	$sql = "SELECT DISTINCT (maj_mail), maj_tel, maj_nom, maj_pnom FROM wfp_chd_majbilling WHERE maj_mail!='' AND maj_id>3063" ;
	$requete = $mysqli->query( $sql ) ;
	while( $result = $requete->fetch_assoc()  )
	{	
		$mail = new PHPMailer(true); //New instance, with exceptions enabled

		/*$body             = file_get_contents("D:/Apps/www/scripts/inc/confirmation.php");
		$body             = preg_replace('/\\\\/','', $body); //Strip backslashes */

		$nom		= $result["maj_nom"];
		$pnom		= $result["maj_pnom"];
		$numero		= $result["maj_tel"];
		$email		= $result["maj_mail"];
		
		/* Construction du message */
		$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
		$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
		$body	.= 'Cher(e) <b>'.$nom.' '.$pnom.'</b>,<br /><br />';
		$body	.= 'Ceci est une notification<br />';
		$body	.= 'Vous avez de(s) Nouvelle(s) Facture(s) Airtel en Attente d\'identification (<b>'.$numero.'</b>)<br />';
		$body	.= 'Merci de faire le necessaire avant la g&eacute;n&eacute;ration automatique (dans 4 semaines).<br /> Lien de la plateforme http://10.11.234.39:8080 <br /><br />';
		$body	.= 'Cordialement,<br /><br />';
		$body	.= '<i>Email g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i><br />';
		$body	.= '-------------------------------------------------------------------------------------------------------</center></body></html>';



		$mail->IsSMTP();                           // tell the class to use SMTP
	
		$mail->Mailer = "smtp";

		$mail->SMTPAuth = false; // turn off SMTP authentication
		$mail->SMTPKeepAlive = true;

		$mail->Port       = 25;                    // set the SMTP server port
		$mail->Host       = "smtprelay.global.wfp.org"; // SMTP server
	
		$mail->Username   = "SMTPUSERNAME";     // SMTP server username
		$mail->Password   = "SMTPPASS";            // SMTP server password
 
		$mail->AddReplyTo("chad.telephonebilling@wfp.org","Chad TelephoneBillingSys");

		$mail->From       = "chad.telephonebilling@wfp.org";
		$mail->FromName   = "Chad TelephoneBillingSys";
	
		$to = $email;

		$mail->AddAddress($to);

		$mail->Subject  = "NOTIFICATION IDENTIFICATION APPELS";

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap

		$mail->MsgHTML($body);

		$mail->IsHTML(true); // send as HTML

		$mail->Send();
		
		$date 	= date("Y-m-d H:i:s");

		$fich	= $_SERVER['PHP_SELF'];

		$sql1 = "UPDATE wfp_chd_majbilling SET maj_lrap='$date', maj_nbre='1'
				WHERE maj_tel='$numero' ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		$sql2 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$numero', 'SYS_AUTO', '$fich', '$date', 'NEW_IDEN', '$nom $pnom') ";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);
		
		$to	= NULL;
	}
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>