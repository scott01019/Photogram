<?php
require_once __DIR__ . '/../utilities/functions.php';

//	a class to handle form validation and entry of postcards into database
class Postcard {
	protected $db;	//	the database
	protected $author;	//	the author
	protected $recip;	//	the recipient
	protected $img;		//	the image name
	protected $filter;	//	the filter name
	protected $title;	//	the title
	protected $text;	//	the text
	public $messages;
	public $errors;

	public function __construct($db, $author, $recip, $img, $filter, $text, $title) {
		$this->db = $db;	//	assign the database
		if ($this->checkValid(sanitizeString($this->db, $author), sanitizeString($this->db, $recip),
								sanitizeString($this->db, $text), sanitizeString($this->db, $title))) {	// check if valid data
			$this->author = sanitizeString($this->db, $author);	//	assign author
			$this->recip = sanitizeString($this->db, $recip);	//	assign recipient
			$this->img = sanitizeString($this->db, $img);		//	assign img name
			$this->filter = sanitizeString($this->db, $filter);	//	assign filter name
			$this->text = sanitizeString($this->db, $text);		//	assign text
			$this->title = sanitizeString($this->db, $title);	//	assign title
			$this->register();	//	attempt entry into database
		}
		$this->db->close();	//	close the database
	}

	public function checkValid($author, $recip, $text, $title) {
		$sql_check_author = "SELECT * FROM USERS_P2 WHERE USERNAME = '" . $author . "'";	//check if valid author
		$query_check_author = $this->db->query($sql_check_author);
		if ($query_check_author->num_rows != 1) {
			$this->errors = $query_check_author->num_rows;
			return false;
		}

		$sql_check_recip = "SELECT * FROM USERS_P2 WHERE USERNAME = '" . $recip . "'";	//	check if valid recipient
		$query_check_recip = $this->db->query($sql_check_recip);
		if ($query_check_recip->num_rows != 1) {
			$this->errors = 'Invalid recipient name.';
			return false;
		}

		if (empty($text) || empty($title)) {	// check if non empty title and text
			$this->errors = 'Postcards require both text and title.';
			return false;
		}

		if (strlen($text) > 140) {	//	check if text fits in database
			$this->errors = 'Postcard text must be less than 140 characters.';
			return false;
		}

		if (strlen($title) > 50) {	//	check if title fits in database
			$this->errors = 'Postcard titles must be less than 50 characters.';
			return false;
		}
		return true;	//	return true if valid input
	}

	public function register() {
		//	prepare sql statement
		if (! ($stmt = $this->db->prepare('INSERT INTO POSTCARDS_P2(AUTHOR, RECIP, IMAGE_NAME, FILTER, IMAGE_TEXT, IMAGE_TITLE, TIME_STAMP) VALUES (?,?,?,?,?,?,?)'))) {
			$this->errors = 'Prepare failed: (' . $this->db->errno . ') ' . $this->db->error;
			return;
		}

		//	bind values to statement
		if (!$stmt->bind_param('sssssss', $this->author, $this->recip, $this->img, $this->filter, $this->text, $this->title, $_SERVER['REQUEST_TIME'])) {
			$this->errors = 'Binding parameters failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}

		//	execute the statement
		if (!$stmt->execute()) {
			$this->errors = 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
			return;
		}
		$this->messages = 'Success!';	//	success if completed
	}
}
?>