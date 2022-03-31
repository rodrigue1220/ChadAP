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
$table = 'wfp_chd_logtransit';

$table = <<<EOT
 (
	SELECT j.logt_id, j.logt_orig, j.logt_destiwh, j.logt_wbs, j.logt_desc, j.logt_batch, j.logt_grantnum, j.logt_grantdesc, j.logt_bbd, j.logt_netdeliv, j.logt_tddgrant, p.logc_nom, p.logc_lib 
	FROM wfp_chd_logtransit j
	INNER JOIN wfp_chd_logconf p
	ON j.logt_destiwh = p.logc_nom
	ORDER BY j.logt_destiwh)
temp
EOT;

// Table's primary key
$primaryKey = 'logt_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'logc_lib', 'dt' => 0 ),
	array( 'db' => 'logt_orig', 'dt' => 1 ),
	array( 'db' => 'logt_destiwh', 'dt' => 2 ),
	array( 'db' => 'logt_wbs', 'dt' => 3 ),
    array( 'db' => 'logt_desc', 'dt' => 4 ),
	array( 'db' => 'logt_batch', 'dt' => 5 ),
	array( 'db' => 'logt_grantnum', 'dt' => 6 ),
	array( 'db' => 'logt_grantdesc', 'dt' => 7 ),
    array( 'db' => 'logt_bbd', 'dt' => 8 ),
	array( 'db' => 'logt_netdeliv', 'dt' => 9 ),
	array( 'db' => 'logt_tddgrant', 'dt' => 10 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, NULL, "logt_orig!='TDCO'")
);
