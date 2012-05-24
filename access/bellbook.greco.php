<?php

/**
 * Authenticate a user given the username and password
 *
 * This ONLY WORKS ON GRECO directly - set up some way to grab info as testing?
 */
function auth($bcpName, $password) {
	$host       = 'ldap.bcp.org';
	$port       = 389;
	
	$result = userinfo($bcpName);
	if($result[0]) {
		$ds = ldap_connect($host, $port);
		if(ldap_bind($ds, $result[0]['dn'], $password)) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/**
 * Finds user info given a username e.g. derek.leung12
 *
 * This ONLY WORKS ON GRECO directly - set up some way to grab info as testing?
 */
function userinfo($bcpName) {
	$host       = 'ldap.bcp.org';
	$port       = 389;
	$baseDn 	= 'OU=Vista,DC=synergy,DC=bcp,DC=org';
	$user       = 'CN=ldap_webaccounts,CN=users,DC=synergy,DC=bcp,DC=org';
	$pass       = '12345';

	$ds = ldap_connect($host, $port);
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_bind($ds, $user, $pass) or die("FUU");
	$result = ldap_search($ds, $baseDn, 'mailNickname=' . $bcpName);
	if ($result) {
		//if the result contains entries with surnames,
		//sort by surname:
		ldap_sort($ds, $result, "sn");

		return ldap_get_entries($ds, $result);
	}
	return -1;
}

/**
 * Finds user info given a student ID
 *
 * This ONLY WORKS ON GRECO directly - set up some way to grab info as testing?
 */
function userinfoId($studentId) {
	$host       = 'ldap.bcp.org';
	$port       = 389;
	$baseDn 	= 'OU=Vista,DC=synergy,DC=bcp,DC=org';
	$user       = 'CN=ldap_webaccounts,CN=users,DC=synergy,DC=bcp,DC=org';
	$pass       = '12345';

	$ds = ldap_connect($host, $port);
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_bind($ds, $user, $pass) or die("FUU");
	$result = ldap_search($ds, $baseDn, 'description=' . $studentId);
	if ($result) {
		//if the result contains entries with surnames,
		//sort by surname:
		ldap_sort($ds, $result, "sn");

		return ldap_get_entries($ds, $result);
	}
	return -1;
}

/**
 * Convenient function to find student ID from user info.
 */
function getId($userinfo) {
	return $userinfo[0]['description'][0];
}

/**
 * Convenient function to find the common name (e.g. Leung, Derek '12) from user info.
 */
function getCn($userinfo) {
	return $userinfo[0]['cn'][0];
}

/**
 * Convenient function to find the given name (e.g. Derek) from user info.
 */
function getGiven($userinfo) {
	return $userinfo[0]['givenname'][0];
}
?>