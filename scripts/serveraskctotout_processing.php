<?php
require('ctrl.php');
	require_once('config.php');
	require_once('verifications.php'); 
include('connexion.php');

$sql = "SELECT * FROM user WHERE pseudo='$pseudo' " ;
$requete = $mysqli->query( $sql );
$result = $requete->fetch_assoc();
$nom = $result["nom"];
$prenom = $result["prenom"];
 
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
$table = 'wfp_chd_djmcto';
 
$table = <<<EOT
 (
	SELECT j.cto_id, j.cto_index, j.cto_deb, j.cto_hdeb, j.cto_hfin, j.cto_deb2, j.cto_hdeb2, j.cto_hfin2, j.cto_approver, j.cto_statut,  p.rh_lname, p.rh_fname
	FROM wfp_chd_personnel p
	INNER JOIN wfp_chd_djmcto j
	ON j.cto_index = p.rh_nopers
	WHERE j.cto_approver='$nom,$prenom'
	ORDER BY p.rh_lname ASC)
temp
EOT;
 
// Table's primary key
$primaryKey = 'cto_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'rh_lname', 'dt' => 0 ),
	array( 'db' => 'rh_fname', 'dt' => 1 ),
    array( 'db' => 'cto_deb', 'dt' => 2 ),
	array( 'db' => 'cto_hdeb', 'dt' => 3 ),
	array( 'db' => 'cto_hfin', 'dt' => 4 ),
	array( 'db' => 'cto_deb2', 'dt' => 5 ),
	array( 'db' => 'cto_hdeb2', 'dt' => 6 ),
	array( 'db' => 'cto_hfin2', 'dt' => 7 ),
	array( 'db' => 'cto_statut', 'dt' => 8 )
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
