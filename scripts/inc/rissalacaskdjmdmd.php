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
	$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= '<b><i>Cet Email est g&eacute;n&eacute;r&eacute; automatiquement, merci de ne pas y r&eacute;pondre!!!</i></b><br /><br />';
	$body	.= 'Suite au mail de confirmation de reprise de cong&eacute; : <br /><br />';
	$body	.= '<table><tr><td class="ligne">Initiateur </td><td class="ligne"><b>'.$adnom.' '.$adprenom.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Index </td><td class="ligne"><b>'.$nopers.'</b><br />';
	$body	.= '<tr><td class="ligne">Type de Cong&eacute; <b>'.$typ1.'</b></td><td class="ligne"> Du <b>'.date("d.m.Y",strtotime($deb1)).'</b> au <b>'.date("d.m.Y",strtotime($fin1)).'</b>, nombre: <b>'.$nbre1.'</b></td></tr>';
	if ($typ2 !="")
	{
		$body	.= '<tr><td class="ligne">Type de Cong&eacute; <b>'.$typ2.'</b></td><td class="ligne"> Du <b>'.date("d.m.Y",strtotime($deb2)).'</b> au <b>'.date("d.m.Y",strtotime($fin2)).'</b>, nombre: <b>'.$nbre2.'</b></td></tr>';
	}
	if ($typ3 !="")
	{
		$body	.= '<tr><td class="ligne">Type de Cong&eacute; <b>'.$typ3.'</b></td><td class="ligne"> Du <b>'.date("d.m.Y",strtotime($deb3)).'</b> au <b>'.date("d.m.Y",strtotime($fin3)).'</b>, nombre: <b>'.$nbre3.'</b></td></tr>';
	}
	if ($typ4 !="")
	{
		$body	.= '<tr><td class="ligne">Type de Cong&eacute; <b>'.$typ4.'</b></td><td class="ligne"> Du <b>'.date("d.m.Y",strtotime($deb4)).'</b> au <b>'.date("d.m.Y",strtotime($fin4)).'</b>, nombre: <b>'.$nbre4.'</b></td></tr>';
	}
	if ($contrat != "SC" && $contrat != "SS")
	{
		$body	.= '<tr><td class="ligne">Demande sur Self Service</td><td class="ligne"><b>'.$opt.'</b></td></tr>';
	}
	$body	.= '<tr><td class="ligne">Date de reprise effective </td><td class="ligne"><b>'.date("d.m.Y",strtotime($reprise)).'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Confirm&eacute; le </td><td class="ligne"><b>'.$date.'</b></td></tr></table><br />';
	$body	.= 'Cordialement<br />';		
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
	//$tohr 	= "chad.hrservicedesk@wfp.org";
		
	if ($emailoic == $emailsup)
	{
		$mail->AddAddress($to);
		$mail->AddCC($emailoic);
		//$mail->AddCC($tohr);
	}
	else
	{
		$mail->AddAddress($to);
		$mail->AddCC($emailsup);
		$mail->AddCC($emailoic);
		//$mail->AddCC($tohr);
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
	//$tohr		= NULL;
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>