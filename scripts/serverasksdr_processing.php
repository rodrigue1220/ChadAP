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
$table = 'wfp_chd_requestsdr';

/*$table = <<<EOT
 (	
	SELECT reqsdr_id, reqsdr_deman, reqsdr_date, reqsdr_raison, reqsdr_salle, reqsdr_nbr, CONCAT(reqsdr_deb, " ",reqsdr_horaire1) AS DEBUT, CONCAT(reqsdr_fin, " ",reqsdr_horaire2) AS FIN, reqsdr_mmedia, reqsdr_pc, reqsdr_state
	FROM wfp_chd_requestsdr
	ORDER BY reqsdr_date 
 )
temp
EOT;*/
 
// Table's primary key
$primaryKey = 'reqsdr_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'reqsdr_id', 'dt' => 0 ),
    array( 'db' => 'reqsdr_raison', 'dt' => 1 ),
	array( 'db' => 'reqsdr_salle', 'dt' => 2 ),
    array( 'db' => 'reqsdr_horaire1', 'dt' => 3 ),
	array( 'db' => 'reqsdr_horaire2', 'dt' => 4 ),
	array( 'db' => 'reqsdr_pc', 'dt' => 5 ),
	array( 'db' => 'reqsdr_mmedia', 'dt' => 6 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "reqsdr_deman='zimbos' ")
);