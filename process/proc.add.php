<?php
require_once('../access/bellbook.includes.php');
require_once('../ui/page.listing.php');
sanitize();

if(isset($_GET['isbn']) && isset($_GET['index'])) {
	echo bookListingForm($_GET['isbn'], $_GET['index']);
}

function bookListingForm($isbn, $index) {
	$result = inputFormat(array('isbn' => $isbn), $index);
	if($result) return $result;
	return '';
}
?>