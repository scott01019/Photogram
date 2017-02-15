<?php
require_once __DIR__ . '/../utilities/functions.php';
require_once __DIR__ . '/../utilities/db_connect.php';

//	this file is used for ajax request triggered in paginate.js
//	it is used to return profile image names for the given users

$results = array();	//	results array
$users = $_POST['users'];	//	users we need to find profile images for

for ($i = 0; $i < count($users); $i++) {	//	for each user
	$result = getProfileImg($db, $users[$i]);	//	get the profile image for that user
	if ($result) array_push($results, $result);	//	if result has a value push result into results array
	else array_push($results, "default.jpg");	//	else assign default.jpg as user profile image
}

header("Content-Type: application/json", true);	//	make ajax response json 
echo json_encode($results);	//	json encode results and respond to ajax request 
?>
