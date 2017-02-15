<?php
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

//	this file handles profile image uploading

if (!isset($_SESSION)) session_start();	//	start a session if needed

$profile_file_name = $_SERVER['REQUEST_TIME'] . '.jpg';	// assign the name of the profile image
if ($_FILES['profile_img']['name']) {	//	if file is uploaded correctly
	$tmp_name = $_FILES['profile_img']['name'];	//	assign temp name to name
	$dst_dir = '../../resources/images/profiles/';	//	assign destination directory
	move_uploaded_file($_FILES['profile_img']['tmp_name'], $dst_dir . $profile_file_name);	//	move uploaded file to destination with the name
	$delete_old_profile_image = getProfileImg($db, $_SESSION['username']);	//	get the old profile image
	if ($delete_old_profile_image != 'default.jpg') unlink($dst_dir . $delete_old_profile_image);	//	if it wasn't default image then delete it
	$sql_save_profile_img = "UPDATE USERS_P2 SET PROFILE_IMG = '" 
							. sanitizeString($db, $profile_file_name) . "' WHERE USERNAME = '" 
							. sanitizeString($db, $_SESSION['username']) . "'";	//	update profile image name in database
	$check_save_profile_img = $db->query($sql_save_profile_img);	//	query the update
}

header('Location: ../../index.php');	//	redirect to index
$db->close();	//	close the database
?>
