<?php
require_once('../access/bellbook.db.php');

$run = true;
if($run) {
	echo '<b>===Users===</b><br />';
	dump(0);
	echo '<b>===Listings===</b><br />';
	dump(1);
	echo '<b>===Requests===</b><br />';
	dump(2);
	echo '<b>===Courses===</b><br />';
	dump(3);
}

/**
 * Prints CSV-formatted output of a given table-number.
 */
function dump($tableNumber) {
	global $DATABASE;
	$success = connect();
	if(!$success) {
		echo 'Connection problem! ';
		return false;
	}
		
	$queries = array(
		'SELECT * FROM Users', 
		'SELECT * FROM Listings',
		'SELECT * FROM Requests',
		'SELECT * FROM Courses'
	);
	
	$works = true;
	$query = $queries[$tableNumber];
	
	$resource = mysql_query($query);
	if(!$resource) {
		$works = false;
		echo 'Failed query: ';
		echo $query;
	} else {
		$row = mysql_fetch_row($resource);
		while($row) {
			$comma = false;
			foreach($row as $cell) {
				if(!$comma) {
					$comma = true;
				} else {
					echo ',';
				}
				echo $cell;
			}
			echo '<br />';
			$row = mysql_fetch_row($resource);
		}
	}
	
	return $works;	
}