<?php
// Global functions

// If 0, no error has occurred
$ERROR_MSG = 0;
$MSG = 0;

/**
 * Sanitize all GET and POST variables.
 */
function sanitizeVars() {
	foreach ($_GET as $key => &$value) {
		$value = filter_var($value, FILTER_SANITIZE_STRING);
	}
	foreach ($_POST as $key => &$value) {
		$value = filter_var($value, FILTER_SANITIZE_STRING);
	}
}

/**
 * Connect to and select the MySQL database.
 */
function connectDB() {
	// TODO set specific variables
	$con = mysql_connect($address, $user, $pass);
	if (!$con) {
		$ERROR_MSG = 'Failed to connect to database: ' . mysql_error();
	} else {
		session_start();
	}
}

/**
 * Verify if the user is logged in.
 */
function isLoggedIn() {
	return isset($_SESSION['id']);
}

/**
 * Look up book data given an ISBN, and return true if the ISBN is valid (false otherwise).
 *
 * Pass variables by reference to get information.
 */
function lookup($isbn, &$isbn10, &$isbn13, &$title, &$title_ext, &$author, &$publisher) {
	// preset
	$LOOKUP_URL = "http://isbndb.com/api/books.xml?";
	$LOOKUP_KEY = "58EJBTZO"; // this is Derek Leung's
	$full_url = $LOOKUP_URL . "access_key=" . $LOOKUP_KEY . "&index1=isbn&value1=" . $isbn;
	$contents = file_get_contents($full_url);
	$parser = xml_parser_create();
	xml_parse_into_struct($parser, $contents, $values, $index);
	xml_parser_free($parser);
	$num_results = $values[$index['BOOKLIST'][0]];
	if($num_results == 0) { // bad ISBN
		return false;
	}
	$indx = $index['BOOKDATA'][0];
	$isbn10 = $values[$indx]['attributes']['ISBN'];
	$isbn13 = $values[$indx]['attributes']['ISBN13'];
	$title = $values[$index['TITLE'][0]]['value'];
	$title_ext = $values[$index['TITLELONG'][0]]['value'];
	$author = $values[$index['AUTHORSTEXT'][0]]['value'];
	$publisher = $values[$index['PUBLISHERTEXT'][0]]['value'];
	return true;
}