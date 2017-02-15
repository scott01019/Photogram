<?php
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';
require_once __DIR__ . '/../classes/friend.php';

//	this file is triggered in the ajax request from friend_request.js

if (!isset($_SESSION)) session_start();	//	start session if needed
$friend_request = new Friend($db, $_SESSION['username'], $_POST['recip']);	//	create a new friend object
$output = isset($friend_request->messages) ? $friend_request->messages : $friend_request->errors;	//	return data to ajax request
header("Content-Type: application/json", true);	//	return data type
echo json_encode($output);	//	make data json compatible and echo it back to complete ajax request
?>