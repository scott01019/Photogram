<?php
require_once __DIR__ . '/../classes/auth.php';
Auth::logout();	//	logout the user
header('Location: ../../index.php');	//	redirect to index
?>