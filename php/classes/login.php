<?php
require_once __DIR__ . '/../utilities/functions.php';

//	A class to handle login requests
//	also validates login form
class Login {
	protected $db;	//	holds the db
	public $messages;	//	holds messages
	public $errors;		//	holds errors

	public function __construct($db, $username, $password) {
		$this->db = $db;	//	assign the database
		if ($this->checkValid(sanitizeString($db, $username), 
						sanitizeString($db, $password))) {	//	validate form data
			if (!isset($_SESSION)) session_start();	//	start a session if not already started
			$_SESSION['logged_in'] = true;			//	login user
			$_SESSION['username'] = $username;		//	set username of user
			$this->messages = 'Success!';			//	set message success
		}
		$this->db->close();	//	close the db
	}

	public function checkValid($username, $password) {
		if (empty($username) || strlen($username) < 5 || strlen($username) > 25) {	//	check for valid username credentials
			$this->errors = 'Username must have more than 4 characters and less than 26 characters!';
			return false;
		} else if (empty($password) || strlen($password) < 6) {	//	check for valid password credentials
			$this->errors = 'Password must have more than 5 characters!';
			return false;
		}  else {
			$sql_check_valid_credentials = "SELECT * FROM USERS_P2 where USERNAME = '" . $username . "' and PASSWORD = '" . sha1(getSalt() . $password) . "'";	//	check if user data is correct in database
			$query_check_valid_credentials = $this->db->query($sql_check_valid_credentials);
			if ($query_check_valid_credentials->num_rows != 1) {	//	if not correct return false
				$this->errors = 'Invalid username and password.';
				return false;
			} else {	//	user data is correct login the user
				return true;
			}
		}
	} 
}
?>
