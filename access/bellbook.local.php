<?php

/**
 * Authenticate a user given the username and password
 *
 * This ONLY WORKS ON GRECO directly - set up some way to grab info as testing?
 */
function auth($bcpName, $password) {
	return true;
}

/**
 * Finds user info given a username e.g. derek.leung12
 *
 * This ONLY WORKS ON GRECO directly - set up some way to grab info as testing?
 */
function userinfo($bcpName) {
	return -1;
}

/**
 * Finds user info given a student ID
 *
 * This ONLY WORKS ON GRECO directly - set up some way to grab info as testing?
 */
function userinfoId($studentId) {
	return -1;
}

/**
 * Convenient function to find student ID from user info.
 */
function getId($userinfo) {
	return '212189';
}

/**
 * Convenient function to find the common name (e.g. Leung, Derek '12) from user info.
 */
function getCn($userinfo) {
	return "Leung, Derek '12";
}

/**
 * Convenient function to find the given name (e.g. Derek) from user info.
 */
function getGiven($userinfo) {
	return 'Derek';
}
?>