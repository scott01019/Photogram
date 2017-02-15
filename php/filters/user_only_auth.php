<?php
require_once __DIR__ . '/../classes/auth.php';

//	a filter to allow only users on user pages

if (!Auth::user()) {	//	if not a user
    header('Location: ../../index.php');	// redirect to index
}
?>