<?php
require_once __DIR__ . '/../utilities/functions.php';

//	A class to handle friend request entries into the database
//	also validates friend request entry
class Friend {
	protected $db;	//	the database
	protected $friend_one;	//	friend making the request
	protected $friend_two;	//	recieptient friend of the request
	protected $status;		//	status of friendship (2 = pending; 1 = accepted; 0 = declined)
	public $messages;		//	for messages
	public $errors;			//	holds errors

	public function __construct($db, $friend_one, $friend_two) {
		$this->db = $db;	//	assign the db
		if ($this->checkValid(sanitizeString($db, $friend_one), sanitizeString($db, $friend_two))) {	//	check if input is valid
			$this->friend_one = sanitizeString($db, $friend_one);	//	assign friend_one
			$this->friend_two = sanitizeString($db, $friend_two);	//	assign friend_two
			$this->status = 2;	//	assign intial status
			$this->register();	//	attempt database entry
		}
		$this->db->close();	//	close the database
	}

	public function checkValid($friend_one, $friend_two) {
		if (empty($friend_one) || empty($friend_two)) {	//	error if friend_one or friend_two are empty
			$this->errors = 'Problem processing request. Please try again.';
			return false;
		} else if (strcmp($friend_one, $friend_two) == 0) {	//	error if friend_one and friend_two are equal
			$this->errors = 'Cannot friend request yourself.';
			return false;
		} else {
			$sql_check_valid_friend_one = 'SELECT * FROM USERS_P2 WHERE USERNAME = "' . $friend_one . '"';	//	check if friend_one is valid user
			$query_check_valid_friend_one = $this->db->query($sql_check_valid_friend_one);
			if ($query_check_valid_friend_one->num_rows != 1) {	//	error if friend one is not valid user
				$this->errors = 'Problem processing request. Please try again.';
				return false;
			}

			$sql_check_valid_friend_two = 'SELECT * FROM USERS_P2 WHERE USERNAME = "' . $friend_two . '"';	//	check if friend_two is valid user
			$query_check_valid_friend_two = $this->db->query($sql_check_valid_friend_two);
			if ($query_check_valid_friend_two->num_rows != 1) {	//	error if friend two is not valid user
				$this->errors = 'Problem processing request. Please try again.';
				return false;
			} 

			$sql_check_valid_friend_request = 'SELECT * FROM FRIENDS_P2 WHERE FRIEND_ONE = "' . $friend_one . '" AND FRIEND_TWO = "' . $friend_two . '"';	//	check if frienship already exists
			$query_check_valid_friend_request = $this->db->query($sql_check_valid_friend_request);
			if ($query_check_valid_friend_request->num_rows != 0) {	//	error if friendship already exists
				$this->errors = 'Problem processing request. Please try again.';
				return false;
			}

			$sql_check_valid_friend_request = 'SELECT * FROM FRIENDS_P2 WHERE FRIEND_ONE = "' . $friend_two . '" AND FRIEND_TWO = "' . $friend_one . '"';	//	check if friendship already exists
			$query_check_valid_friend_request = $this->db->query($sql_check_valid_friend_request);
			if ($query_check_valid_friend_request->num_rows != 0) {	//	error if friendship already exists
				$this->errors = 'Problem processing request. Please try again.';
				return false;
			} else {
				return true;
			}
		}
	}

	//	inserts friendship into the database
	public function register() {
		//	prepare the statement
		if (! ($stmt = $this->db->prepare('INSERT INTO FRIENDS_P2(FRIEND_ONE, FRIEND_TWO, STATUS, TIME_STAMP) VALUES (?,?,?,?)'))) {
			$this->errors = 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
			return;
		}

		//	bind parameters to the statement
		if (!$stmt->bind_param('ssss', $this->friend_one, $this->friend_two, $this->status, $_SERVER['REQUEST_TIME'])) {
			$this->errors = 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}

		//	execute the statement
		if (!$stmt->execute()) {
			$this->errors = 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}
		$this->messages = 'Success!';	//	process complete if this point is reached
	}
}
?>