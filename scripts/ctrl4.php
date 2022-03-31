<?php
/**
* @author Zaki IZZO <izzo.zaki@wfp.org>
* @copyright (c) 2020, United Nations World Food Programme Chad
*/
	$pro	= $mysqli->query("SELECT cto_dem AS DEM FROM wfp_chd_djmcto WHERE cto_id='$id'")->fetch_array();
	$dmd	= $pro["DEM"];
			
	if ($dmd != "$pseudo")
	{
		header('Location:simple.php');
		exit();
	}
?>