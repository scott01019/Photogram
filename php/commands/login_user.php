<?php
require_once __DIR__ . '/../classes/login.php';
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';
require_once __DIR__ . '/../classes/auth.php';

//	this file attempts to login users

$login = new Login($db, $_POST['username'], $_POST['password']);	//	create a new login attempt object

if ($login->messages == 'Success!' && Auth::user()) {	//	if successful
	header('Location: ../../views/user/index.php');	//	redirect to index
	exit;
} else {	//	else not successful
	if(!isset($_SESSION)) session_start();
	$_SESSION['login_errors'] = $login->errors;	//	store errors in session
	header('Location: ../../views/guest/login.php');	// redirect to login form and display errors
	exit;
}
?>