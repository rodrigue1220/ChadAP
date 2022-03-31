<?
	//tester si la date de reprise ne sort pas du NTE
	$datefin= $mysqli->query("SELECT rh_nte AS DT FROM wfp_chd_personnel WHERE rh_nopers='$nopers' ")->fetch_array();
	$nte	= $datefin['DT'];
	
	if (strtotime($nte)<strtotime($reprise))
	{
		header('Location:oops3.php');
	}
	
	//tester si les dates sont bonnes: tests basés beaucoup plus sur les premières dates
	if ($deb1=="1970-01-01" || $fin1=="1970-01-01" || $deb1=="0000-00-00" || $fin1=="0000-00-00")
	{
		header('Location:oops5.php');
	}
	elseif (strtotime($deb1)<0  || strtotime($fin1)<0)
	{
		header('Location:oops5.php');
	}
	elseif (strtotime($fin1)<=strtotime($deb1))
	{
		header('Location:oops6.php');
	}
		
					
	//tester si le nombre de jours demandé ne dépasse pas le quota 
	if($soldap1<0 || $soldap2<0 || $soldap3<0)
	{
		$sql2z		= "DELETE FROM wfp_chd_rqdjoummah WHERE lv_id='$id' ";    
		$requete2z	= $mysqli->query($sql2z) or die( $mysqli->connect_errno()) ;
		if( $requete2z )
		{
			header('Location:oops55.php');
		}
	}
?>