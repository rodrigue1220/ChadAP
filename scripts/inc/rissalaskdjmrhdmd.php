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
	
	$sql = "SELECT * FROM user WHERE profil='AdminRH' " ;
	$requete = $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
		$adnom		= $result["nom"];
		$adprenom 	= $result["prenom"];
		$messagerie	= $result["email"];
	
		$sqlt = "SELECT * FROM user WHERE indexid='$nopers' " ;
		$requetet	= $mysqli->query( $sqlt );
		$resultt	= $requetet->fetch_assoc();
		$nom		= $resultt["nom"];
		$prenom 	= $resultt["prenom"];
		
	
		/* Construction du message */
		$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
		$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
		$body	.= 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';
		$body	.= 'Une Nouvelle Demande de Cong&eacute;s cr&eacute;&eacute;e et dont le Solde apr&egrave;s reprise requiert votre attention: <br /><br />';
		$body	.= '<table><tr><td class="ligne">Demandeur </td><td class="ligne"><b>'.$nom.' '.$prenom.'</b></td></tr>';
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

		$body	.= '<tr><td class="ligne">Date de reprise effective </td><td class="ligne"><b>'.date("d.m.Y",strtotime($reprise)).'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Quota Avant Cong&eacute; <b>AL</b> </td><td class="ligne"> au <b>'.date("d.m.Y",strtotime($firstday)).'<b> : <b>'.$soldav.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Quota Apr&egrave;s Cong&eacute; <b>AL</b> </td><td class="ligne"> au <b>'.date("d.m.Y",strtotime($lastday)).'<b> : <b>'.$soldap.'</b></td></tr></table><br />';
		$body	.= 'Merci de vous connecter sur la plateforme: http://10.11.234.39:8080, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
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
		$mail->Subject  = "SOLDE AL NEGATIF Demande Conges";
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
	}
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>