<?php
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

if (!isset($_SESSION)) session_start();	//	start session if needed

$sql_delete_friend_request = 'DELETE FROM FRIENDS_P2 WHERE FRIEND_ONE = "' 
							. sanitizeString($db, $_GET['user']) . '" AND FRIEND_TWO = "' 
							. sanitizeString($db, $_SESSION['username']) . '"';	//	setup statement to delete friendship
$query_delete_friend_request = $db->query($sql_delete_friend_request);	//	query the delete
header('Location: ../../views/user/friend_inbox.php');	//	redirect to friend_inbox
?>