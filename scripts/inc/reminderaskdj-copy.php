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
	include ("D:/Apps/www/scripts/connexion.php");
	$sqldj	= "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_state='APPROUVE1' OR lv_state='ATTENTE' " ;
	$reqdj	= $mysqli->query( $sqldj ) ;
	
	while( $resudj = $reqdj->fetch_assoc()  )
	{
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		
		$nopers		= $resudj["lv_nopers"];
		$sup		= $resudj["lv_sup"];
		$oic		= $resudj["lv_oic"];
		$reprise	= $resudj["lv_rep"];
		$statut		= $resudj["lv_state"];
		$debut		= $resudj["lv_deb"];
		$retour		= $resudj["lv_ret"];
		$nombre		= $resudj["lv_nombre"];
		$soumis		= $resudj["lv_date"];
		
		
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

		if ($statut == "ATTENTE")
		{
			$destinom	= $supnom;
			$destipnom	= $suprnom;
			$to			= $emailsup;	
			$emailchef	= $emailoic;
		}
		else 
		{
			$destinom	= $oicnom;
			$destipnom	= $oicprnom;
			$to			= $emailoic;	
			$emailchef	= $emailsup;
		}
		
		/* Construction du message */
		$body	 = 'Cher(e) <b>'.$destinom.' '.$destipnom.'</b>,<br /><br />';
		$body	.= 'Une Demande de Cong&eacute;s Annuel cr&eacute;&eacute;e, est toujours en ATTENTE de votre APPROBATION : <br /><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demandeur : <b>'.$adnom.' '.$adprenom.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Superviseur : <b>'.$supnom.' '.$suprnom.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OIC : <b>'.$oicnom.' '.$oicprnom.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Du : <b>'.$debut.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Au : <b>'.$retour.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre de Jour : <b>'.$nombre.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date de reprise : <b>'.$reprise.'</b><br />';
		$body	.= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demande Soumise le : <b>'.$soumis.'</b><br /><br />';
		$body	.= 'Merci de vous connecter sur la plateforme: http://10.11.234.39:8080, pour plus de d&eacute;tails et / ou donner suite &agrave; la demande <br /><br />';
		$body	.= 'Cordialement,<br />';
		$body	.= 'Chad HR Service Desk<br />';
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
			
		$tohr 	= "chad.hrservicedesk@wfp.org";
		
		$mail->AddAddress($to);
		$mail->AddCC($emailchef);
		$mail->AddCC($tohr);
		$mail->AddCC($messagerie);
			
		$mail->Subject  = "Rappel APPROBATION";
		$mail->AltBody 	= "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap = 80; // set word wrap
		$mail->Charset ="iso-8859-1";
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
		
		$date 		= date("Y-m-d H:i:s");
		$sql1 = "INSERT  INTO wfp_chd_tarikh (his_id, his_user, his_agent, his_page, his_date, his_lib1, his_lib2)
				VALUES ( '', '$nopers', 'SYS_AUTO', '', '$date', 'RAPPEL_APPROB_CONGES', '$sup $statut $oic') ";
		$mysqli->query($sql1) or die ('Erreur '.$sql1.' '.$mysqli->error);
		
		$to			= NULL;
		$emailchef 	= NULL;
		$messagerie	= NULL;
		$tohr		= NULL;

	}
}
catch (phpmailerException $e) 
{
	echo $e->errorMessage();
}
?>