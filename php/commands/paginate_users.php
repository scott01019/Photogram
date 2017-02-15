<?php
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

//	this file is used to respond to an ajax request from the paginate.js file

if (!isset($_POST['next_page']) || $_POST['next_page'] < 0) $_POST['next_page'] = 1;	//	check if ajax variable is set

$next_page = sanitizeString($db, $_POST['next_page']);	//	sanitize ajax post data
$limit = 25;	//	we will display 25 people per page
$sql_get_users = "SELECT USERNAME FROM USERS_P2 LIMIT " . $limit . " OFFSET " . $limit * $next_page;	// prepare the sql statement
$check_get_users = $db->query($sql_get_users);	//	carryout the query

$data = array();	//	initialize results array
while ($row = $check_get_users->fetch_row()) {	//	while results still exist
	array_push($data, $row[0]);	//	add them to results array
}

header("Content-Type: application/json", true);	//	we are responding with json object
echo json_encode($data);	//	json encode the array and respond
$db->close();	//	close the database
?>