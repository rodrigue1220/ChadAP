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
 
$table = <<<EOT
 (	
	SELECT j.reqsdr_id, j.reqsdr_raison, j.reqsdr_salle, j.reqsdr_nbr, CONCAT(j.reqsdr_deb, " ",j.reqsdr_horaire1) AS DEBUT, CONCAT(j.reqsdr_fin, " ",j.reqsdr_horaire2) AS FIN, j.reqsdr_state, CONCAT(p.nom, ", ",p.prenom) AS NAME, p.pseudo
	FROM user p
	INNER JOIN wfp_chd_requestsdr j
	ON j.reqsdr_deman = p.pseudo
 )
temp
EOT;
 
// Table's primary key
$primaryKey = 'reqsdr_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'reqsdr_id', 'dt' => 0 ),
	array( 'db' => 'NAME', 'dt' => 1 ),
    array( 'db' => 'reqsdr_raison', 'dt' => 2 ),
	array( 'db' => 'reqsdr_salle', 'dt' => 3 ),
	array( 'db' => 'reqsdr_nbr', 'dt' => 4 ),
    array( 'db' => 'DEBUT', 'dt' => 5 ),
	array( 'db' => 'FIN', 'dt' => 6 ),
	array( 'db' => 'reqsdr_state', 'dt' => 7 )
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