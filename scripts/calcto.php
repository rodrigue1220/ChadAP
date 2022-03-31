<?php
	include('connexion.php');
	/*$mois	= "2019-09";
	$sql	= "SELECT * FROM wfp_chd_recapcto WHERE rcto_mois='$mois'" ;
	$req	= $mysqli->query($sql) ;
	
	while($res = $req->fetch_assoc())
	{
		$id		= $res["rcto_id"];
		$totcto	= $res["rcto_durcto"];
		$hercto = stristr($totcto, ':', true);
		$mincto	= substr(stristr($totcto, ':'), 1); 
		$mincto = $mincto/60;
		//$totcsh	= strtotime($res["rcto_durcash"])/3600;
		$totco	= $hercto+$mincto; 
		$valcto = ($totcto*1.5)/8;
		
		$sql2	= "UPDATE wfp_chd_recapcto SET rcto_valcto='$valcto' WHERE rcto_id='$id' ";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);						
	}AND cto_dapprover2<'2019-11-08 00:00:00' 
	*/
	$date 	= date("Y-m-d H:i:s");
	$mois	= date('Y-m', strtotime('-1 month'));
	$mois2	= date('Y-m');
	$mj		= $mois;
	$dat1	= $mois.'-01';
	$dat2	= $mois2.'-01';
	
	$sql	= "SELECT DISTINCT(cto_index) AS Indx FROM wfp_chd_djmcto WHERE cto_statut='CERTIFIE' AND (cto_deb2>='$dat1' AND cto_deb2<'$dat2') AND cto_dapprover2<'2022-03-07 00:00:00' " ;
	$req	= $mysqli->query($sql) ;
	
	while($res = $req->fetch_assoc())
	{
		$pers	= $res["Indx"];
		
		$cumc	 = $mysqli->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(cto_dure))) AS CUM FROM wfp_chd_djmcto WHERE cto_statut='CERTIFIE' AND (cto_deb2>='$dat1' AND cto_deb2<'$dat2') AND cto_index='$pers' AND cto_choix='CTO' AND cto_dapprover2<'2022-03-07 00:00:00' ")->fetch_array();
		$totcto  = $cumc['CUM'] ;
		
		$cumca	 = $mysqli->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(cto_dure))) AS CUM FROM wfp_chd_djmcto WHERE cto_statut='CERTIFIE' AND (cto_deb2>='$dat1' AND cto_deb2<'$dat2') AND cto_index='$pers' AND cto_choix='CASH' AND cto_dapprover2<'2022-03-07 00:00:00' ")->fetch_array();
		$totcash = $cumca['CUM'] ;
		
		$sql2	= "INSERT INTO wfp_chd_recapcto (rcto_id, rcto_dem, rcto_mois, rcto_durcto, rcto_durcash, rcto_valcto, rcto_valcash)
					VALUES ('', '$pers', '$mj', '$totcto', '$totcash', '0', '0')";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);						
	}
	
?>