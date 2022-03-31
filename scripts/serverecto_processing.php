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
$table = 'wfp_chd_recapcto';
 
$table = <<<EOT
 (
	SELECT j.rcto_id, j.rcto_dem, j.rcto_mois, j.rcto_durcto, j.rcto_durcash, j.rcto_durover, CONCAT(p.rh_lname, ", ",p.rh_fname) AS name, p.rh_duty 
	FROM wfp_chd_personnel p
	INNER JOIN wfp_chd_recapcto j
	ON j.rcto_dem = p.rh_nopers
	ORDER BY name ASC)
temp
EOT;
 
// Table's primary key
$primaryKey = 'rcto_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'rcto_dem', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
	array( 'db' => 'rh_duty', 'dt' => 2 ),
    array( 'db' => 'rcto_mois', 'dt' => 3 ),
	array( 'db' => 'rcto_durcto', 'dt' => 4 ),
    array( 'db' => 'rcto_durcash', 'dt' => 5 ),
	array( 'db' => 'rcto_durover', 'dt' => 6 )
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
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
