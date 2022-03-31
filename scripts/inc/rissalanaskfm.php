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
	
	$sqla		= "SELECT * FROM wfp_chd_request WHERE reqst_id='$id' " ;
	$requeta	= $mysqli->query( $sqla );
	$resulta	= $requeta->fetch_assoc();
	$deman		= $resulta["reqst_nom"];
	$motif		= $resulta["reqst_motif"];
	$desti		= $resulta["reqst_dest"];
	$datedep	= $resulta["reqst_dep"];
	$heurdep	= $resulta["reqst_heurd"];
	$mindep		= $resulta["reqst_mind"];
	$dateret	= $resulta["reqst_ret"];
	$heurret	= $resulta["reqst_heurr"];
	$minret		= $resulta["reqst_minr"];
	$passager	= $resulta["reqst_passag"];
	$oic		= $resulta["reqst_oic"];
	
	$sql = "SELECT * FROM user WHERE profil='AdminFLEET' AND unite='ADMIN-FINANCE/CO NDJAMENA' " ;
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
		$body	 = 'Cher(e) <b>'.$adnom.' '.$adprenom.'</b>,<br /><br />';
		$body	.= 'Une Nouvelle Demande de Transport AUTORISEE, en ATTENTE de votre APPROBATION : <br /><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demandeur : <b>'.$nom.' '.$prenom.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motif : <b>'.utf8_decode($motif).'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destination : <b>'.utf8_decode($desti).'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Passager (s) : <b>'.utf8_decode($passager).'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Du : <b>'.$datedep.', '.$heurdep.'h'.$mindep.'mn </b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Au : <b>'.$dateret.', '.$heurret.'h'.$minret.'mn</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Autoris&eacute;e par : <b>'.$oic.'</b><br /><br />';
		$body	.= 'Merci de vous connecter sur la plateforme: http://10.11.234.39:8080, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
		$body	.= 'Cordialement,<br />';
		$body	.= 'Chad ADM Service Desk<br />';
		$body	.= '-------------------------------------------------------------------------------------';


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
		$mail->Subject  = "APPROBATION Demande de Transport";
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