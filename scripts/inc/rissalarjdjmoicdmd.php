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
	
	$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
	$requetet	= $mysqli->query( $sqlt );
	$resultt	= $requetet->fetch_assoc();
	$nom		= $resultt["nom"];
	$prenom 	= $resultt["prenom"];
	$messagerie = $resultt["email"];

	
	/* Construction du message */
	$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>'.$nom.' '.$prenom.'</b>,<br /><br />';
	$body	.= 'Votre Demande de Cong&eacute;s cr&eacute;&eacute;e a &eacute;t&eacute; REJETEE / Superviseur: <br /><br />';
	$body	.= '<table><tr><td class="ligne">OIC </td><td class="ligne"><b>'.$oicnom.' '.$oicprenom.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Superviseur </td><td class="ligne"><b>'.$supnom.' '.$suprenom.'</b></td></tr>';
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

	$body	.= '<tr><td class="ligne">Date de reprise </td><td class="ligne"><b>'.date("d.m.Y",strtotime($reprise)).'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Motif REJET  </td><td class="ligne"><b>'.utf8_decode($comm).'</b></td></tr></table><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad HR Team</b><br />';
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
	$mail->AddAddress($to);

	$mail->Subject  = "Demande Conges REJETEE";
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