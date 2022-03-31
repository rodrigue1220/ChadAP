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
$table = 'wfp_chd_rqdjoummah';
 
$table = <<<EOT
 (
	SELECT j.lv_id, GREATEST(j.lv_fin1, j.lv_fin2, j.lv_fin3, j.lv_fin4, j.lv_dselfs) AS kammal, j.lv_selfs, j.lv_nopers, j.lv_deb1, j.lv_rep, j.lv_state, j.lv_statetrt, CONCAT(j.lv_type1, " - ",j.lv_type2, " - ",j.lv_type3, " - ",j.lv_type4) AS nafar, p.rh_contrat, CONCAT(p.rh_lname, ", ",p.rh_fname) AS name, p.rh_duty 
	FROM wfp_chd_rqdjoummah j
	INNER JOIN wfp_chd_personnel p 
	ON j.lv_nopers = p.rh_nopers
	ORDER BY j.lv_id DESC
)

temp
EOT;
 
// Table's primary key
$primaryKey = 'lv_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'lv_id', 'dt' => 0 ),
	array( 'db' => 'lv_nopers', 'dt' => 1 ),
    array( 'db' => 'name', 'dt' => 2 ),
    array( 'db' => 'lv_deb1', 'dt' => 3 ),
	array( 'db' => 'kammal', 'dt' => 4 ),
	array( 'db' => 'lv_selfs', 'dt' => 5 ),
	array( 'db' => 'lv_rep', 'dt' => 6 ),
	array( 'db' => 'nafar', 'dt' => 7 ),
    array( 'db' => 'lv_state', 'dt' => 8 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, NULL, "lv_statetrt='TRAITE'" )
);
