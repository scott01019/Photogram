<?php
require_once __DIR__ . '/../classes/register.php';
require_once __DIR__ . '/../utilities/db_connect.php';

//	this file attempts to register a new user

$register = new Register($db, $_POST['username'], $_POST['password'], $_POST['password_confirm']);	//	create user registration attempt object 

if ($register->messages == 'Success!') {	//	if successful
	header('Location: ../../views/guest/login.php');	//	redirect to login page
	exit;
} else {	//	if not successful
	if(!isset($_SESSION)) session_start();	//	start session if needed
	$_SESSION['register_errors'] = $register->errors;	//	store errors in session variable
	header('Location: ../../views/guest/registration.php');	//	return to registration form and display errors
	exit;
}
?>