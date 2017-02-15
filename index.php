<?php
require_once __DIR__ . '/php/classes/auth.php';
require_once __DIR__ . '/php/utilities/functions.php';

if (!isset($_SESSION)) session_start();	//	start session if needed
$_SESSION['id'] = sha1(getSalt() . $_SERVER['REQUEST_TIME']);	//	start a session

if (Auth::guest()) {	//	if user is guest route to guest index
	header('Location: views/guest/index.php');
} else if (Auth::user()) {	//	if user is user route to user index
	header('Location: views/user/index.php');
}
?>