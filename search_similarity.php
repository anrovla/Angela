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
$table = 'sim_view';
// Table's primary key
$primaryKey = 'song_ID_orig';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'song_ID_orig',     'dt' => 0 ),
    array( 'db' => 'name',  'dt' => 1 ),
    array( 'db' => 'artist', 'dt' => 2)
);
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'test',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// VJ: added term, #wereAll, ['data']

require( 'ssp.class.php' );

// Validate the JSONP to make use it is an okay Javascript function to execute
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['term']) ?
    $_GET['term'] :
    false;


//$whereAll = " song_ID_orig = ".$jsonp." limit 5";
$whereAll = " song_ID_orig = '".urldecode($_GET['term'])."'";

$v=SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, $whereAll );

//echo substr(substr(json_encode($v), 0,-1),1);
echo substr(substr(json_encode($v), 0,-1),1);

/*
echo '[
{"id":"Nycticorax nycticorax","label":"label - Black-crowned Night Heron","value":"Black-crowned Night Heron"},
{"name":"Roze","label":"46", "value":"lele!"}
]';
*/
