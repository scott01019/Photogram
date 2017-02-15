<?php
require_once __DIR__ . '/../classes/postcard.php';
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

//	this file uploads a postcard

if (!isset($_SESSION)) session_start();	//	start a session if needed
$recip = $_SESSION['recip'];	//	assign recipeint
unset($_SESSION['recip']);		//	unset recip SESSION variable

if (!$_FILES['upload']['error']) {	//	 there are no file errors
	$postcard_file_name = $_SERVER['REQUEST_TIME'] . '.jpg';	//	name the postcard
	$postcard = new Postcard($db, $_SESSION['username'], $recip, $postcard_file_name, $_POST['filter'], $_POST['text'], $_POST['title']);	// create postcard attempt object
	if ($_FILES['upload']['name'] && $postcard->messages == 'Success!') {	//	if valid file and postcard attempt is successful
		$tmp_name = $_FILES['upload']['name'];	//	set the temp name
		$dst_dir = '../../resources/images/postcards/';	//	set the destination directory
		move_uploaded_file($_FILES['upload']['tmp_name'], $dst_dir . $postcard_file_name);	//	move uploaded file to destination directory with proper name
		header('Location: ../../views/user/index.php?user=' . $recip);	//	return back to recipients user profile
	} else {	//	invalid file or unsuccessful postcard attempt
		$_SESSION['postcard_errors'] = $postcard->errors;	//	assign postcard errors
		header('Location: ../../views/user/upload_postcard.php?user=' . $recip);	//	redirect to upload postcard with errors
	}
} else if ($_FILES['upload']['error'] == 1 || $_FILES['upload']['error'] == 2) {	//	if file is too large
	$_SESSION['postcard_errors'] = 'File too large to be uploaded.';
	header('Location: ../../views/user/upload_postcard.php?user=' . $recip);	//	redirect to upload postcard with error
} else if ($_FILES['upload']['error'] == 3) {	//	if file upload incomplete
	$_SESSION['postcard_errors'] = 'File upload incomplete. Please try again.';
	header('Location: ../../views/user/upload_postcard.php?user=' . $recip);	//	redirec to upload postcard with error
} else if ($_FILES['upload']['error'] == 4) {	//	if file nto found
	$_SESSION['postcard_errors'] = 'No file uploaded.';
	header('Location: ../../views/user/upload_postcard.php?user=' . $recip);	//	redirect to upload postcard with error
} else {	//	something else went wrong
	$_SESSION['postcard_errors'] = 'Problem uploading file. Please try again.';
	header('Location: ../../views/user/upload_postcard.php?user=' . $recip);	//	redirect to upload postcard with error
}
?>