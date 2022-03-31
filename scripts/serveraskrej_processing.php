<?php 

session_start();
require_once('config.php');
require_once('verifications.php');

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
$table = 'wfp_chd_requesteqpmtvar';

$table = <<<EOT
 (
	SELECT j.rqeqv_id, j.rqeqv_ref, j.rqeqv_item, j.rqeqv_nbr, j.rqeqv_date, j.rqeqv_dem, j.rqeqv_state, p.catart_code, p.catart_nom, g.rqeqpmt_dappro 
	FROM wfp_chd_catart p 
	INNER JOIN wfp_chd_requesteqpmtvar j
	ON p.catart_code = j.rqeqv_item
	INNER JOIN wfp_chd_requesteqpmt g
	ON g.rqeqpmt_ref = j.rqeqv_ref
	ORDER BY j.rqeqv_id DESC)
temp
EOT;
 
// Table's primary key
$primaryKey = 'rqeqv_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'rqeqv_id', 'dt' => 0 ),
    array( 'db' => 'rqeqv_ref', 'dt' => 1 ),
    array( 'db' => 'catart_nom', 'dt' => 2 ),
	array( 'db' => 'rqeqv_nbr', 'dt' => 3 ),
	array( 'db' => 'rqeqv_date', 'dt' => 4 ),
	array( 'db' => 'rqeqv_state', 'dt' => 5 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "rqeqv_dem='$pseudo' AND (rqeqv_state='ANNULE' OR rqeqv_state LIKE '%REJ%') " )
);