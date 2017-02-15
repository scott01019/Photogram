<?php
//	A static class that checks if the user is logged in, if the user is not logged in, and has the ability to logout the user
class Auth {
	//	returns true if user is logged in otherwise returns false
	public static function user() {
		if (!isset($_SESSION)) session_start();
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
			return true;
		else return false;
	}

	//	return true if user is not logged in otherwise returns false
	public static function guest() {
		if (!isset($_SESSION)) session_start();
		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false)
			return true;
		else return false;
	}

	//	logout the user
	public static function logout() {
		if (!isset($_SESSION)) session_start();
		session_destroy();
	}
}
?>