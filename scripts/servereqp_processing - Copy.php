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
$table = 'wfp_chd_requesteqpmt';
 
$table = <<<EOT
 (
	SELECT j.rqeqpmt_id, j.rqeqpmt_item, j.rqeqpmt_motif, j.rqeqpmt_nbr, j.rqeqpmt_state, j.rqeqpmt_oicit, j.rqeqpmt_demand, j.rqeqpmt_type, CONCAT(j.rqeqpmt_lib, ", ",j.rqeqpmt_lib2) AS comm, CONCAT(p.nom, ", ",p.prenom) AS name, p.pseudo
	FROM user p
	INNER JOIN wfp_chd_requesteqpmt j
	ON j.rqeqpmt_demand = p.pseudo
	ORDER BY j.rqeqpmt_id DESC)
temp
EOT;
 
// Table's primary key
$primaryKey = 'rqeqpmt_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'rqeqpmt_id', 'dt' => 0 ),
	array( 'db' => 'name', 'dt' => 1 ),
    array( 'db' => 'rqeqpmt_item', 'dt' => 2 ),
	array( 'db' => 'rqeqpmt_motif', 'dt' => 3 ),
	array( 'db' => 'rqeqpmt_nbr', 'dt' => 4 ),
    array( 'db' => 'rqeqpmt_state', 'dt' => 5 ),
	array( 'db' => 'rqeqpmt_oicit', 'dt' => 6 ),
    array( 'db' => 'comm', 'dt' => 7 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "rqeqpmt_type!='FOURN'" )
);
