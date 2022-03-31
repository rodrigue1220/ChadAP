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
	
	$mois		= date('Y-m', strtotime('-1 month'));
	$mois2		= date('Y-m');
	
	$sql	 = "SELECT DISTINCT(cto_index) FROM wfp_chd_djmcto WHERE (cto_deb LIKE '$mois%' OR cto_deb2 LIKE '$mois%') 
				AND (cto_statut='APPROUVE' OR cto_statut='EFFECTUE' OR cto_statut='ATTENTE') " ;
	$requete = $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
		$nopers		= $result["cto_index"];
		
		$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
		$requetet	= $mysqli->query( $sqlt );
		$resultt	= $requetet->fetch_assoc();
		
		$adnom		= $resultt["nom"];
		$adprenom 	= $resultt["prenom"];
		$messagerie	= $resultt["email"];

	
		/* Construction du message */
		$body	 = '<i>**Ceci est un message envoy&eacute; automatiquement!!! Merci de ne pas y r&eacute;pondre**</i><br /><br />';
		$body	.= 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';		
		$body	.= 'Vous avez des demandes d\'heures suppl&eacute;mentaires qui sont APPROUVEES / EN ATTENTE dans le syst&egrave;me,<br />';
		$body	.= 'merci de les soumettre ou voir le Superviseur pour Certification avant qu\'elles ne soient prises en compte par les RH.<br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mois : <b>'.$mois.'</b><br /><br />';
		$body	.= 'Apr&egrave;s le <b>'.$mois2.'-07</b>, le syst&egrave;me ne les prendra plus en compte.<br /><br />';
		$body	.= 'Cordialement!<br />';
		$body	.= '--------------------------------------------------------';


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
		$mail->AddAddress($to);
		$mail->Subject  = "RAPPEL CERTIFICATION HSUP";
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
		
		$date 		= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nopers', 'SYS_AUTO', '', '$date', 'RAP_CERTIF_HSUP', '$mois') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		$to = NULL;
	}
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>