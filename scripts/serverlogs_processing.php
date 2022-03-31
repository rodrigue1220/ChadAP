<?php
 
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
$table = 'wfp_chd_logstock';

$table = <<<EOT
 (
	SELECT j.logs_id, j.logs_wh, j.logs_matdesc, j.logs_batch, j.logs_wbs, j.logs_grantnum, j.logs_grantdesc, j.logs_sledbbd, j.logs_total, j.logs_tddgrant, p.logc_nom, p.logc_lib 
	FROM wfp_chd_logstock j
	INNER JOIN wfp_chd_logconf p
	ON j.logs_wh = p.logc_nom
	ORDER BY j.logs_wh)
temp
EOT;

// Table's primary key
$primaryKey = 'logs_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'logc_lib', 'dt' => 0 ),
	array( 'db' => 'logs_wh', 'dt' => 1 ),
	array( 'db' => 'logs_matdesc', 'dt' => 2 ),
	array( 'db' => 'logs_batch', 'dt' => 3 ),
    array( 'db' => 'logs_wbs', 'dt' => 4 ),
	array( 'db' => 'logs_grantnum', 'dt' => 5 ),
	array( 'db' => 'logs_grantdesc', 'dt' => 6 ),
    array( 'db' => 'logs_sledbbd', 'dt' => 7 ),
	array( 'db' => 'logs_total', 'dt' => 8 ),
	array( 'db' => 'logs_tddgrant', 'dt' => 9 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns)
);
