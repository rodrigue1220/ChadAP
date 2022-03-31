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
		$deb1		= $resudj['lv_deb1'];
		$fin1		= $resudj['lv_fin1'];
		$typ1		= $resudj['lv_type1'];
		$nbre1		= $resudj['lv_nbr1'];
		$deb2		= $resudj['lv_deb2'];
		$fin2		= $resudj['lv_fin2'];
		$typ2		= $resudj['lv_type2'];
		$nbre2		= $resudj['lv_nbr2'];
		$deb3		= $resudj['lv_deb3'];
		$fin3		= $resudj['lv_fin3'];
		$typ3		= $resudj['lv_type3'];
		$nbre3		= $resudj['lv_nbr3'];
		$deb4		= $resudj['lv_deb4'];
		$fin4		= $resudj['lv_fin4'];
		$typ4		= $resudj['lv_type4'];
		$nbre4		= $resudj['lv_nbr4'];
		$reprise	= $resudj['lv_rep'];
		$pivot		= $resudj['lv_rr'];
		$opt		= $resudj['lv_selfs'];
		
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

		if ($statut == 'ATTENTE')
		{
			$destinom	= $supnom;
			$destipnom	= $suprnom;
			$to			= $emailsup;	
			$emailchef	= $emailoic;
		}
		else if ($statut == 'APPROUVE1')
		{
			$destinom	= $oicnom;
			$destipnom	= $oicprnom;
			$to			= $emailoic;	
			$emailchef	= $emailsup;
		}
		
		/* Construction du message */
		$body	 = '<html><head><style>.ligne{border-color:#0000FF;border:solid 1px;} body {font-family:"Century Gothic";}</style></head><body>';
		$body	.= '<center><img src="D:/Apps/www/img/Presentation.png" width="800" /><br /><br />';
		$body	.= 'Cher(e) <b>'.$destinom.' '.$destipnom.'</b>,<br /><br />';
		$body	.= 'Une Demande de Cong&eacute;s cr&eacute;&eacute;e, est toujours en ATTENTE de votre APPROBATION : <br /><br />';		
		$body	.= '<table><tr><td class="ligne">Demande Soumise le </td><td class="ligne"><b>'.$resudj['lv_date'].'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Demandeur </td><td class="ligne"><b>'.$adnom.' '.$adprenom.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">OIC </td><td class="ligne"><b>'.$oicnom.' '.$oicprnom.'</b></td></tr>';
		$body	.= '<tr><td class="ligne">Superviseur </td><td class="ligne"><b>'.$supnom.' '.$suprnom.'</b></td></tr>';
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
	
		$body	.= '<tr><td class="ligne">Date de reprise </td><td class="ligne"><b>'.date("d.m.Y",strtotime($reprise)).'</b></td></tr></table><br />';
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