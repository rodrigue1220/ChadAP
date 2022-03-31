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
$table = 'wfp_chd_sandouk';

$table = <<<EOT
 (
	SELECT j.stock_id, j.stock_item, j.stock_nbr, j.stock_remarks, j.stock_cat, p.catart_code, p.catart_nom
	FROM wfp_chd_catart p
	INNER JOIN wfp_chd_sandouk j 
	ON j.stock_item = p.catart_code 
	ORDER BY j.stock_id DESC)
temp
EOT;

 
// Table's primary key
$primaryKey = 'stock_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'stock_id', 'dt' => 0 ),
	array( 'db' => 'stock_item', 'dt' => 1 ),
	array( 'db' => 'catart_nom', 'dt' => 2 ),
    array( 'db' => 'stock_nbr', 'dt' => 3 ),
    array( 'db' => 'stock_remarks', 'dt' => 4 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "stock_cat='FOURN' ")
);