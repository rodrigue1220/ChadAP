
	$id   = $_GET["id"];
	$date = date("Y-m-d H:i:s");

	//récupération des données
	$sql = "SELECT * FROM wfp_chd_rqdjoummah WHERE lv_id='$id' " ;
	$requete = $mysqli->query( $sql );
	$result = $requete->fetch_assoc();
	
	$nopers	= $result['lv_nopers'];		
	$superv	= $result['lv_sup'];	
	$deb1	= $result['lv_deb1'];
	$fin1	= $result['lv_fin1'];
	$typ1	= $result['lv_type1'];
	$nbre1	= $result['lv_nbr1'];
	$deb2	= $result['lv_deb2'];
	$fin2	= $result['lv_fin2'];
	$typ2	= $result['lv_type2'];
	$nbre2	= $result['lv_nbr2'];
	$deb3	= $result['lv_deb3'];
	$fin3	= $result['lv_fin3'];
	$typ3	= $result['lv_type3'];
	$nbre3	= $result['lv_nbr3'];
	$reprise= $result['lv_rep'];
		
	
	//récupération des quotas des congés
	$nb1 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ1'")->fetch_array();		
	$nb1 = $nb1['SOL'];
	$nb2 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ2'")->fetch_array();		
	$nb2 = $nb2['SOL'];
	$nb3 = $mysqli->query("SELECT leave_solde AS SOL FROM wfp_chd_djoummah WHERE leave_nopers='$nopers' AND leave_type='$typ3'")->fetch_array();		
	$nb3 = $nb3['SOL'];
	
	//determination des soldes après la prise du congés
	$soldap1	= $nb1-$nbre1;
	$soldap2	= $nb2-$nbre2;
	$soldap3	= $nb3-$nbre3;
	