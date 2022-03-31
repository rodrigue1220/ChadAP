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
	
	/*$chahar	= date('Y-m', strtotime('-1 month'));
	
	$sql	= "SELECT DISTINCT(vars_item) AS Item FROM wfp_chd_sandoukvar WHERE vars_type='FOURN' AND vars_sens='SORTIE' AND vars_date LIKE '$chahar%'" ;
	$req	= $mysqli->query($sql) ;
	
	while($res = $req->fetch_assoc())
	{
		$article= $res["Item"];
		
		$art	= $mysqli->query("SELECT catart_nom AS NOM FROM wfp_chd_catart WHERE catart_code='$article' ")->fetch_array();
		$art 	= $art['NOM'] ;
		
		$cumc	= $mysqli->query("SELECT SUM(vars_nbr) AS CUM FROM wfp_chd_sandoukvar WHERE vars_item='$article' AND vars_type='FOURN' AND vars_sens='SORTIE' AND vars_date LIKE '$chahar%'")->fetch_array();
		$totsort= $cumc['CUM'] ;
		
		$solde	= $mysqli->query("SELECT stock_nbr AS RESTE FROM wfp_chd_sandouk WHERE stock_item='$article' ")->fetch_array();
		$solde	= $solde['RESTE'] ;
		
		$sql2	= "INSERT INTO wfp_chd_recapstock (rstck_id, rstck_item, rstck_cummul, rstck_stock, rstck_mois)
					VALUES ('', '$art', '$totsort', '$solde', '$chahar')";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);						
	}
	*/
	$sql	= "SELECT * FROM wfp_chd_requesteqpmtvar WHERE rqeqv_state='APRV2'" ;
	$req	= $mysqli->query($sql) ;
	
	while($res = $req->fetch_assoc())
	{
		$id		= $res["rqeqv_id"];
		$item	= $res["rqeqv_item"];
		$nbr	= $res["rqeqv_nbr"];
		$nbrapr	= $res["rqeqv_nbraprv"];
		
		if ($nbrapr<$nbr)
		{
			$nbrapr = $nbr;
		}
		
		$sql2	= "UPDATE wfp_chd_requesteqpmtvar SET rqeqv_itemaprv='$item', rqeqv_nbraprv='$nbrapr' WHERE rqeqv_id='$id' ";
		$mysqli->query($sql2) or die ('Erreur '.$sql2.' '.$mysqli->error);						
	}
	
?>