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

require_once('bellbook.meta.php');
if($testing)
	require_once('bellbook.local.php');
else
	require_once('bellbook.greco.php');
require_once('bellbook.db.php');
require_once('bellbook.books.php');
?>