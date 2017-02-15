<?php
require_once __DIR__ . '/../classes/auth.php';

//	a filter to allow only guests to view guest pages

if (! Auth::guest()) {	//	if not a guest
	header('Location: ../../index.php');	//	redirect to index
}
?>