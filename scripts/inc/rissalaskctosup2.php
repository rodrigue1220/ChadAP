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
	
	$sql 		= "SELECT * FROM wfp_chd_djmcto WHERE cto_id='$id'" ;
	$requete	= $mysqli->query( $sql ) ;
	$result 	= $requete->fetch_assoc();
	$officer	= $result["cto_approver"]; 
	$datep		= $result["cto_deb"];
	$hdeb		= $result["cto_hdeb"];
	$hfin		= $result["cto_hfin"];
	$demandeur	= $result["cto_dem"];
	
	$oicnom		= stristr($officer, ',', true);
	$oicprenom 	= substr(stristr($officer, ','), 1);
	$mess 		= $mysqli->query("SELECT email AS EM FROM user WHERE nom='$oicnom' AND prenom='$oicprenom'")->fetch_array();
	$messagerie	= $mess['EM'];
	
	$sqlt = "SELECT * FROM user WHERE pseudo='$demandeur' " ;
	$requetet	= $mysqli->query( $sqlt );
	$resultt	= $requetet->fetch_assoc();
	$nom		= $resultt["nom"];
	$prenom 	= $resultt["prenom"];

	
	/* Construction du message */
	$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
	$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
	$body	.= 'Cher(e) <b>'.$oicnom.' '.$oicprenom.'</b>,<br /><br />';
	$body	.= 'Heure (s) Suppl&eacute;mentaire (s) ex&eacute;cut&eacute;e (s) en ATTENTE de votre CERTIFICATION, Superviseur / OIC : <br /><br />';
	$body	.= '<table><tr><td class="ligne">Demandeur </td><td class="ligne"><b>'.$nom.' '.$prenom.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Date pr&eacutevue; : <b>'.$datep.'</b></td><td class="ligne"> Date effective : <b>'.$datedep.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Heure estim&eacute;e de d&eacute;but : <b>'.$hdeb.'</b></td><td class="ligne"> Heure effective de d&eacute;but : <b>'.$saaa.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Heure estim&eacute;e de fin : <b>'.$hfin.'</b></td><td class="ligne">Heure effective de fin : <b>'.$saar.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">T&acirc;ches &agrave; effectuer </td><td class="ligne"><b>'.$motif.'</b></td></tr>';
	$body	.= '<tr><td class="ligne">Total effectu&eacute; </td><td class="ligne"><b>'.$dure.'</b></td></tr></table><br />';
	//$body	.= '<tr><td class="ligne">Type de Compensation </td><td class="ligne"><b>'.$choix.'</b></td></tr></table><br />';
	$body	.= 'Merci de vous connecter sur <a href="http://10.109.87.10:8080">la plateforme</a>, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
	$body	.= 'Cordialement,<br />';
	$body	.= '<b>Chad HR Team </b><br />';
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
	$mail->Subject  = "CERTIFICATION Heures Supplementaires";
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