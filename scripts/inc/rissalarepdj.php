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
	$jour	= date("Y-m-d");
	$sqldj	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_state='APPROUVE2' AND lv_rep<='$jour' " ;
	$reqdj	= $mysqli->query( $sqldj ) ;
	
	while( $resudj = $reqdj->fetch_assoc()  )
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
		$nopers		= $resudj["lv_nopers"];
		$sup		= $resudj["lv_sup"];
		$oic		= $resudj["lv_oic"];
		$reprise	= $resudj["lv_rep"];
		
		
		$supnom		= stristr($sup, ',', true);
		$suprnom 	= substr(stristr($sup, ','), 1);
		$messup 	= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$supnom' AND prenom='$suprnom'")->fetch_array();
		$emailsup	= $messup['EM'];
		
		$oicnom		= stristr($oic, ',', true);
		$oicprnom 	= substr(stristr($oic, ','), 1);
		$messoic 	= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprnom'")->fetch_array();
		$emailoic	= $messoic['EM'];
				
		$sql 		= "SELECT * FROM user WHERE indexid='$nopers' " ;
		$requete 	= $mysqli->query( $sql ) ;
		$result 	= $requete->fetch_assoc();
	
		$adnom		= $result["nom"];
		$adprenom 	= $result["prenom"];
		$messagerie	= $result["email"];

	
		/* Construction du message */
		$body	 = '<html><head><style> body {font-family:"Century Gothic";}</style></head><body>';
		$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
		$body	.= 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';
		$body	.= 'Suivant les informations contenues dans votre dossier et relatives &agrave; votre cong&eacute;, vous &ecirc;tes sens&eacute;(e) reprendre le travail<br />';
		$body	.= 'ce jour, <b>'.$reprise.'</b>.<br />';
		$body	.= 'Merci de le confirmer sur la plateforme Chad AP d&egrave;s que vous arrivez au bureau ce matin afin de mettre &agrave; jour votre fiche de cong&eacute;s.<br /><br />';
		$body	.= 'Lien de la plateforme <a href="http://10.109.87.10:8080">ChadAP</a>, pour plus de d&eacute;tails et / ou donner suite. <br /><br />';
		$body	.= 'En vous souhaitant une bonne reprise,<br />';
		$body	.= 'Cordialement<br />';
		$body	.= '<b>Chad HR Team </b><br /><br />';
		$body	.= 'Email g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!<br />';
		$body	.= '-------------------------------------------------------------------------------------</center></body></html>';


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
				
		$mail->Subject  = "Confirmation de votre date de retour de conges";
		$mail->AltBody 	= "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
		
		$date 		= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nopers', 'SYS_AUTO', '', '$date', 'ENVOI_MAIL_REPRISE', '$sup $reprise $oic') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		$to			= NULL;
		$emailoic 	= NULL;
		$emailsup 	= NULL;
		$tohr		= NULL;

	}
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>