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

sanitize();

if(isset($_GET['query']))
	$QUERY = $_GET['query'];
else
	$QUERY = 'home';

include('access/bellbook.includes.php');
?>
<!DOCTYPE html>
<html>
<?
$id = pageinfo($QUERY);
include('ui/page.header.php');
include($id['location']);
include('ui/page.footer.php');
?>
</html>