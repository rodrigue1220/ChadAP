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
	
	$sql = "SELECT * FROM user WHERE profil='AdminFOURN' " ;
	$requete = $mysqli->query( $sql ) ;

	while( $result = $requete->fetch_assoc()  )
	{
		$adnom		= $result["nom"];
		$adprenom 	= $result["prenom"];
		$messagerie	= $result["email"];
		
		$sqlz 		= "SELECT * FROM wfp_chd_requesteqpmt WHERE rqeqpmt_id='$id' " ;
		$requetez	= $mysqli->query( $sqlz );
		$resultz	= $requetez->fetch_assoc();
		$demandeur	= $resultz["rqeqpmt_demand"];
		$item		= $resultz["rqeqpmt_item"];
		$motif		= $resultz["rqeqpmt_motif"];
		$nbr		= $resultz["rqeqpmt_nbr"];
		$nmbr		= $resultz["rqeqpmt_nbraprv"];
		$approver	= $resultz["rqeqpmt_oic"];
		$approverit	= $resultz["rqeqpmt_oicit"];
	
	
		$sqlt = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
		$requetet	= $mysqli->query( $sqlt );
		$resultt	= $requetet->fetch_assoc();
		$nom		= $resultt["nom"];
		$prenom 	= $resultt["prenom"];

	
		/* Construction du message */
		$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
		$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
		$body	.= 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';
		$body	.= 'Une Nouvelle Demande de fourniture APPROUVEE en ATTENTE de votre TRAITEMENT : <br /><br />';
		$body	.= '<table><tr><td class="ligne">Demandeur </td><td class="ligne"><b>'.$nom.' '.$prenom.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Item </td><td class="ligne"><b>'.$item.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Quantit&eacute; </td><td class="ligne"><b>'.$nbr.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Raison </td><td class="ligne"><b>'.$motif.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Approuv&eacute;e (OIC/Demandeur) par </td><td class="ligne"><b>'.$approver.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Approuv&eacute;e (OIC/ADMIN) par </td><td class="ligne"><b>'.$approverit.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Quantit&eacute; Approuv&eacute;e </td><td class="ligne"><b>'.$nmbr.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Commentaires OIC/ADMIN </td><td class="ligne"><b>'.$comm.'</b></td></tr></table><br />';
		$body	.= 'Merci de vous connecter sur la plateforme: http://10.11.234.39:8080, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
		$body	.= 'Cordialement,<br />';
		$body	.= '<b>Chad ADM Service Desk</b><br />';
		$body	.= '-------------------------------------------------------</center></body></html>';


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
		$mail->Subject  = "TRAITEMENT Demande Fourniture";
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