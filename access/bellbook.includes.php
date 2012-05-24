<?php
// utility functions

/**
 * Sanitize ALL the variables
 */
function sanitize() {
	foreach($_POST as $key => $value) {
		$_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	}
	foreach($_GET as $key => $value) {
		$_GET[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	}
}

function isLoggedIn() {
	return isset($_SESSION['id']);
}

sanitize();
session_start();

$testing = true; // false on actual server, true when testing

include('bellbook.meta.php');
if($testing)
	include('bellbook.local.php');
else
	include('bellbook.greco.php');
include('bellbook.db.php');
include('bellbook.books.php');
?>