<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/

	require_once('connexion.php');

	$sqlb 		= "SELECT * FROM wfp_chd_dir WHERE dir_tel1='n/a' " ;
	$requeteb 	= $mysqli->query( $sqlb ) ;
	while( $resultb = $requeteb->fetch_assoc() )
	{
		$id		= $resultb["dir_id"];
		$tel2	= $resultb["dir_tel2"];
		//$tel3	= $resultb["dir_tel3"];
		
		//if ($tel3=$tel2)
		//{
		$sql = "UPDATE wfp_chd_dir SET dir_tel1='$tel2', dir_tel2='' WHERE dir_id='$id' ";
		$requete = $mysqli->query($sql) or die( $mysqli->connect_errno()) ;
		//}
	}
	//UPDATE `wfp_chd_dir` SET dir_tel3=REPLACE(dir_tel3,' ','')
?>