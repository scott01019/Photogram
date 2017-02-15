<?php
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

if (!isset($_SESSION)) session_start();	//	start session if needed

$sql_update_friend_status = "UPDATE FRIENDS_P2 SET STATUS = '1' WHERE FRIEND_TWO = '" 
							. sanitizeString($db, $_SESSION['username']) 
							. "' AND FRIEND_ONE = '" . sanitizeString($db, $_GET['user']) . "'";	//	change friendship status to accepted
$query_update_friend_status = $db->query($sql_update_friend_status);	//	query the update in the database
header('Location: ../../views/user/friend_inbox.php');	//	redirect back to friend_inbox
?>