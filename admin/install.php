<?php
require_once('../access/bellbook.db.php');

$run = false;
if($run) {
	destroy();
	emplace();
}

function emplace() {
	global $DATABASE;
	$success = partial_connect();
	if(!$success)
		return false;
	
	$success = mysql_select_db($DATABASE);
	if(!$success) {
		$success = mysql_query('CREATE DATABASE ' . $DATABASE);
		if(!$success) {
			echo 'NO CREATE DB';
			return false;
		} else {
			$success = mysql_select_db($DATABASE);
			if(!$success) {
				echo 'CREATE WORKS, NO SELECT DB';
				return false;
			}
		}
	}
	
	$queries = array(
		'CREATE TABLE Users(
			id INT NOT NULL,
			PRIMARY KEY (id)
		)', 
		'CREATE TABLE Listings(
			id INT NOT NULL AUTO_INCREMENT,
			isbn TINYTEXT,
			price INT,
			description TINYTEXT,
			owner INT,
			status INT,
			updated DATETIME,
			filled DATETIME,
			PRIMARY KEY (id),
			FOREIGN KEY (owner) REFERENCES Users(id)
		)',
		'CREATE TABLE Requests(
			listing INT,
			owner INT,
			FOREIGN KEY (owner) REFERENCES Users(id),
			FOREIGN KEY (listing) REFERENCES Listings(id)
		)',
		'CREATE TABLE Courses(
			id INT NOT NULL,
			isbn INT,
			name TINYTEXT
		)'
	);
	
	$works = true;
	
	foreach($queries as $query) {
		$success = mysql_query($query);
		if(!$success) {
			$works = false;
			echo 'Failed query: ';
			echo $query;
		}
	}
	
	echo 'bellbook installed ';
	
	return $works;	
}

function destroy() {
	global $DATABASE;
	$success = connect();
	if(!$success)
		return false;
		
	$queries = array(
		'DROP TABLE Requests',
		'DROP TABLE Listings',
		'DROP TABLE Users',
		'DROP TABLE Courses'
	);
	
	$works = true;
	
	foreach($queries as $query) {
		$success = mysql_query($query);
		if(!$success) {
			$works = false;
			echo 'Failed query: ';
			echo $query;
		}
	}
	
	echo 'database wiped ';
	
	return $works;
}
?>