<?php

session_start();
require_once('config.php');
require_once('connexion.php');
require_once('verifications.php');

	$numero	= $mysqli->query("SELECT tel AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phone2	= $numero["num"];
	
	$numer2	= $mysqli->query("SELECT tel2 AS num FROM user WHERE pseudo='$pseudo'")->fetch_array();
	$phon2	= $numer2["num"];
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'wfp_chd_recapbil';

// Table's primary key
$primaryKey = 'rec_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'rec_id', 'dt' => 0 ),
	array( 'db' => 'rec_mois', 'dt' => 1 ),
	array( 'db' => 'rec_offtot', 'dt' => 2 ),
	array( 'db' => 'rec_privtot', 'dt' => 3 ),
	array( 'db' => 'rec_totoff', 'dt' => 4 ),
	array( 'db' => 'rec_totpriv', 'dt' => 5 ),
	array( 'db' => 'rec_offtotmin', 'dt' => 6 ),
	array( 'db' => 'rec_privtotmin', 'dt' => 7 )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'wfp_chad_automation',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require('sspcplx.class.php');
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "(rec_phone='$phon2' OR rec_phone='$phone2') AND rec_mois LIKE '%2%' AND rec_status!='ANNULE'")
);