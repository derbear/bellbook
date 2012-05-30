<?php
$HOSTNAME = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'bellbook';

function connect() {
	global $HOSTNAME, $USERNAME, $PASSWORD;
	$success = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD);
	
	if(!$success) {
		echo 'NO CONNECT TO MYSQL';
		return false;
	} else {
		return true;
	}
}
?>