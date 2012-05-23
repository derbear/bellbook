<?php 

// initialize as function is called for first time
$_PAGE_INFO_ARRAY = -1; 

/**
 * TODO implement this dummy somewhere else!
 */
function getTitle($isbn) {
	return 'A Title';
}

/**
 * Initializes the page info array - is called only on the first time
 */
function initinfo() {
	global $_PAGE_INFO_ARRAY;
	if(!isset($_GET['isbn'])) // TODO replace with something more robust
		$_GET['isbn'] = -1;
	$_PAGE_INFO_ARRAY = array(
		'home' => array(
			'name' => 'Bellbook Home',
			'title' => 'bellbook',
			'location' => 'content/home.php',
			'access' => 'public'),
		'book' => array(
			'name' => 'Bellbook Listings for ' + getTitle($_GET['isbn']), 
			'title' => 'Prices for ' + getTitle($_GET['isbn']),
			'location' => 'content/book.php',
			'access' => 'public'),
		'status' => array(
			'name' => 'Bellbook Status',
			'title' => 'Status',
			'location' => 'content/status.php',
			'access' => 'private'));
}

/**
 * Return the page information for the given page (pass $query to this)
 */
function pageinfo($pageName) {
	global $_PAGE_INFO_ARRAY;
	if($_PAGE_INFO_ARRAY == -1)
		initinfo();
	return $_PAGE_INFO_ARRAY[$pageName];
}

?>