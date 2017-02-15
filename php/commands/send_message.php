<?php
require_once __DIR__ . '/../classes/message.php';
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

//	this file sends a message

if (!isset($_SESSION)) session_start();	//	start session if needed
$recip = isset($_SESSION['recip']) ? $_SESSION['recip'] : '';	//	check fi recipient is set and assign recipeint
$author = $_SESSION['username'];	//	assign author
$title = $_POST['subject'];			//	assign message title
$text = $_POST['text'];				//	assign message text
unset($_SESSION['recip']);			//	unset temporary SESSION variable

$message = new Message($db, $author, $recip, $title, $text);	//	create a new message attempt object
if ($message->messages == 'Success!') {	//	if successful
	header('Location: ../../index.php');	//	redirect ot index
} else {	//	else unsuccesfful
	if(!isset($_SESSION)) session_start();	//	start session if needed
	$_SESSION['message_errors'] = $message->errors;	//	store errors in session
	header('Location: ../../views/user/send_message.php?user=' . $recip);	//	redirect to send message page with recip as $_GET
}
?>