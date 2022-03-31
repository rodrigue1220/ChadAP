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
$table = 'wfp_chd_progymrv';
 
$table = <<<EOT
 (
	SELECT j.pgymrv_id, j.pgymrv_jour, j.pgymrv_user, j.pgymrv_eqp, p.nom, p.prenom, p.pseudo 
	FROM wfp_chd_progymrv j
	INNER JOIN user p
	ON j.pgymrv_user = p.pseudo)
temp
EOT;
 
// Table's primary key
$primaryKey = 'pgymrv_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'pgymrv_id', 'dt' => 0 ),
    array( 'db' => 'nom', 'dt' => 1 ),
	array( 'db' => 'prenom', 'dt' => 2 ),
	array( 'db' => 'pgymrv_jour', 'dt' => 3, 'formatter' => function( $d, $row ) { return date('l', strtotime($d)); } ),
    array( 'db' => 'pgymrv_jour', 'dt' => 4 ),
	array( 'db' => 'pgymrv_eqp', 'dt' => 5 )
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
