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
$table = 'wfp_chd_requesteqpmtvar';
 
$table = <<<EOT
 (
	SELECT j.rqeqv_id, j.rqeqv_ref, j.rqeqv_item, j.rqeqv_dem, j.rqeqv_nbr, j.rqeqv_state, j.rqeqv_type, s.catart_code, s.catart_nom
	FROM wfp_chd_requesteqpmtvar j
	INNER JOIN wfp_chd_catart s
	ON j.rqeqv_item = s.catart_code
)
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
	array( 'db' => 'rqeqv_dem', 'dt' => 2 ),
	array( 'db' => 'catart_nom', 'dt' => 3 ),
    array( 'db' => 'rqeqv_nbr', 'dt' => 4 ),
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "rqeqv_type!='FOURN'" )
);
