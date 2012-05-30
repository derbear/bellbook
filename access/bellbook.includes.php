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

function authorize() {
	global $QUERY;
	$info = pageinfo($QUERY);
	$private = $info['access'] == 'private';
	if(!$private || isLoggedIn()) {
		return;
	} else {
		$redirect = 'query=home';
		if(isset($_GET['ref'])) {
			$redirect = 'query=' . $_GET['ref'];
		}
		header('Location: index.php?message=You must be logged in to view this page&amp;' . $redirect);
	}
}

$testing = true; // false on actual server, true when testing

include('bellbook.meta.php');
if($testing)
	include('bellbook.local.php');
else
	include('bellbook.greco.php');
include('bellbook.db.php');
include('bellbook.books.php');
?>