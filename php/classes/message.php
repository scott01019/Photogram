<?php
require_once __DIR__ . '/../utilities/functions.php';

//	A class to handle messages
class Message {
	protected $db;	//	holds the database
	protected $author;	//	author of message
	protected $recip;	//	recipient of message
	protected $title;	//	title of message
	protected $text;	//	text of message
	public $messages;	//	messages
	public $errors;		//	errors

	public function __construct($db, $author, $recip, $title, $text) {
		$this->db = $db;	//	assign the database
		if ($this->checkValid(sanitizeString($db, $author), sanitizeString($db, $recip), sanitizeString($db, $title), sanitizeString($db, $text))) {	//	check valid input
			$this->author = sanitizeString($db, $author);	//	asign author
			$this->recip = sanitizeString($db, $recip);		//	assign recipient
			$this->title = sanitizeString($db, $title);		//	assign title
			$this->text = sanitizeString($db, $text);		//	assign text
			$this->register();		// attempt entry into database 
		}
		$this->db->close();	//	close database
	}

	public function checkValid($author, $recip, $title, $text) {
		if (strcmp($author, $recip) == 0) {	//	invalid if author and recip are the same
			$this->errors = 'You cannot send a message to yourself.';
			return false;
		}
		$sql_check_author = "SELECT * FROM USERS_P2 WHERE USERNAME = '" . $author . "'";	//	check valid author
		$query_check_author = $this->db->query($sql_check_author);
		if ($query_check_author->num_rows != 1) {	//	invalid if author not found
			$this->errors = 'Invalid author name.';
			return false;
		}

		$sql_check_recip = "SELECT * FROM USERS_P2 WHERE USERNAME = '" . $recip . "'";	//	check valid recipient
		$query_check_recip = $this->db->query($sql_check_recip);
		if ($query_check_recip->num_rows != 1) {	//	invalid if recipient not found
			$this->errors = 'Invalid recipient name.';
			return false;
		}

		if (empty($title) || empty($text)) {	//	make sure text and title are not empty
			$this->errors = 'Text/Subject cannot be left blank.';
			return false;
		}

		if (strlen($title) > 50) {	//	make sure title fits in database
			$this->errors = 'Subject cannot be more than 50 characters.';
			return false;
		}

		if (strlen($text) > 140) {	//	make sure text fits in database
			$this->errors = 'Text cannot be more than 140 characters.';
		} 

		return true;	//	return true if all is valid
	}

	public function register() {
		//	prepare statement for insert into database
		if (! ($stmt = $this->db->prepare('INSERT INTO MESSAGES_P2(AUTHOR, RECIP, MESSAGE_TITLE, MESSAGE_TEXT, TIME_STAMP) VALUES (?,?,?,?,?)'))) {
			$this->errors = 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
			return;
		}

		//	bind values to statement
		if (!$stmt->bind_param('sssss', $this->author, $this->recip, $this->title, $this->text, $_SERVER['REQUEST_TIME'])) {
			$this->errors = 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}

		//	execute statement
		if (!$stmt->execute()) {
			$this->errors = 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}
		$this->messages = 'Success!';	//	set messages to success
	}
}
?>