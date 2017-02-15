<?php
require_once __DIR__ . '/../utilities/functions.php';

//	a class to handle form validation and entry of users into database
class Register {
	protected $username;	//	username
	protected $password;	//	password
	protected $db;	//	database
	public $messages;	//	messages
	public $errors;		//	errors

	public function __construct($db, $username, $password, $password_confirm) {
		$this->db = $db;	//	assign the database
		if ($this->checkValid(sanitizeString($db, $username), 
						sanitizeString($db, $password),
						sanitizeString($db, $password_confirm))) {	//	check valid input
			$this->username = sanitizeString($db, $username);	//	assign username
			$this->password = sanitizeString($db, sha1(getSalt() . $password));	//	assign password
			$this->register();	//	attempt entry into database
		}
		$this->db->close();	//	close the database
	}

	public function checkValid($username, $password, $password_confirm) {
		if (empty($username) || strlen($username) < 5 || strlen($username) > 25) {	// check proper username
			$this->errors = 'Username must have more than 4 characters and less than 26 characters!';
			return false;
		} else if (! preg_match('/^\w{5,}$/', $username)) {	//	regex to check proper characters in username and >5 characters
			$this->errors = 'Username must only contain letters and numbers and begin with a letter.';
			return false;
		} else if (empty($password) || strlen($password) < 6) {	//	check password
			$this->errors = 'Password must have more than 5 characters!';
			return false;
		} else if ($password != $password_confirm) {	// check password and password confirmation match
			$this->errors = 'Password and Password Confirmation do not match!';
			return false;
		} else {
			$sql_check_unique_username = "SELECT * FROM USERS_P2 where USERNAME = '" . $username . "'";	//	check to see if username is not taken
			$query_check_unique_username = $this->db->query($sql_check_unique_username);
			if ($query_check_unique_username->num_rows == 1) {	// if taken return false
				$this->errors = 'Username already in use.';
				return false;
			} else {
				return true;	//	return true if all is valid
			}
		}
	} 

	public function register() {
		//	prepare the sql statement
		if (! ($stmt = $this->db->prepare('INSERT INTO USERS_P2(USERNAME, PASSWORD, PROFILE_IMG, TIME_STAMP) VALUES (?,?,?,?)'))) {
			$this->errors = 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
			return;
		}

		//	bind values to statement 
		$default_profile_img = 'default.jpg';	//	set profile image to default.jpg
		if (!$stmt->bind_param('ssss', $this->username, $this->password, $default_profile_img, $_SERVER['REQUEST_TIME'])) {
			$this->errors = 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}

		//	execute the statement
		if (!$stmt->execute()) {
			$this->errors = 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}
		$this->messages = 'Success!';	//	success message if all is completed
	}
};
?>
