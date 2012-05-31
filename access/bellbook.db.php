<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'bellbook';

/**
 * Connect to bellbook's MySQL database, returning true on success.
 */
function connect() {
	global $HOSTNAME, $USERNAME, $PASSWORD, $DATABASE;
	$success = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD);
	
	if(!$success) {
		echo 'NO CONNECT TO MYSQL';
		return false;
	} else {
		$success = mysql_select_db($DATABASE);
		if(!$success) {
			echo 'NO CONNECT TO MYSQL';
			return false;
		} else {
			return true;
		}
	}
}

/**
 * Connect to bellbook's MySQL server, BUT NOT THE DATABASE, returning true on success.
 */
function partial_connect() {
	global $HOSTNAME, $USERNAME, $PASSWORD;
	$success = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD);
	
	if(!$success) {
		echo 'NO CONNECT TO MYSQL';
		return false;
	} else {
		return true;
	}
}

/**
 * Return a list of all user listings.
 */
function getListings($studentId, &$count) {
	$resource = connect();
	if(!$resource)
		return false;
		
	$arr = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM Listings WHERE owner = ' . $studentId));
	$count = $arr[0];
	
	$query = 'SELECT * FROM Listings WHERE owner = ' . $studentId;
	$resource = mysql_query($query);
	if(!$resource)
		return false;
	return $resource;
}

/**
 * Return a list of all user offers.
 */
function getOffers($studentId, &$count) {
	$resource = connect();
	if(!$resource)
		return false;
		
	$arr = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM Listings WHERE owner = ' . $studentId . ' AND price > 0'));
	$count = $arr[0];
	
	$query = 'SELECT * FROM Listings WHERE owner = ' . $studentId . ' AND price > 0';
	$resource = mysql_query($query);
	if(!$resource)
		return false;
	return $resource;
}

/**
 * Return a list of all user bids.
 */
function getBids($studentId, &$count) {
	$resource = connect();
	if(!$resource)
		return false;
		
	$arr = mysql_fetch_row(mysql_query('SELECT COUNT(*) FROM Listings WHERE owner = ' . $studentId . ' AND price < 0'));
	$count = $arr[0];
	
	$query = 'SELECT * FROM Listings WHERE owner = ' . $studentId . ' AND price < 0';
	$resource = mysql_query($query);
	if(!$resource)
		return false;
	return $resource;
}
?>