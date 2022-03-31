<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require ("D:/Apps/www/scripts/inc/class.phpmailer.php");
include ("D:/Apps/www/scripts/connexion.php");
try {

	/*$body             = file_get_contents("D:/Apps/www/scripts/inc/confirmation.php");
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes */

		$mail = new PHPMailer(true); //New instance, with exceptions enabled	
		
		$supnom		= stristr($sup, ',', true);
		$suprnom 	= substr(stristr($sup, ','), 1);
		$messup 	= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$supnom' AND prenom='$suprnom'")->fetch_array();
		$emailsup	= $messup['EM'];
		
		$oicnom		= stristr($oic, ',', true);
		$oicprnom 	= substr(stristr($oic, ','), 1);
		$messoic 	= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprnom'")->fetch_array();
		$emailoic	= $messoic['EM'];
				
		$sqlz 		= "SELECT * FROM user WHERE indexid='$nopers' " ;
		$requetez 	= $mysqli->query( $sqlz ) ;
		$resultz 	= $requetez->fetch_assoc();
	
		$adnom		= $resultz["nom"];
		$adprenom 	= $resultz["prenom"];
		$messagerie	= $resultz["email"];

	
		/* Construction du message */
		$body	 = '<b><i>Cet Email est g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i></b><br /><br />';
		$body	.= 'Suite au mail de confirmation de reprise de cong&eacute; : <br /><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Initiateur : <b>'.$adnom.' '.$adprenom.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Index : <b>'.$nopers.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type de Cong&eacute;: <b>'.$type.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cong&eacute; Du : <b>'.$deb.'</b> Au : <b>'.$ret.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demande sur Self Service : <b>'.$choix.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date de Reprise : <b>'.$repriz.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm&eacute; le : <b>'.$date.'</b><br /><br />';
		$body	.= 'Cordialement<br />';		
		$body	.= '-------------------------------------------------------------------------------------';


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
		
		$to		= $messagerie;
		$tohr 	= "chad.hrservicedesk@wfp.org";
		
		if ($emailoic == $emailsup)
		{
			$mail->AddAddress($to);
			$mail->AddCC($emailoic);
			$mail->AddCC($tohr);
		}
		else
		{
			$mail->AddAddress($to);
			$mail->AddCC($emailsup);
			$mail->AddCC($emailoic);
			$mail->AddCC($tohr);
		}
				
		$mail->Subject  = "Confirmation de retour de conges";
		$mail->AltBody 	= "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
		
		$date 		= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nopers', 'SYS_AUTO', '', '$date', 'CONF_MAIL_REPRISE', '$sup $repriz $oic') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		$to			= NULL;
		$emailoic 	= NULL;
		$emailsup 	= NULL;
		$tohr		= NULL;
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>