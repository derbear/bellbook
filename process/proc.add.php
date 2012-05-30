<?php
require_once('../ui/page.listing.php');
require_once('../access/bellbook.includes.php');
sanitize();
if(isset($_GET['isbn'])) {
	echo bookListingForm($_GET['isbn']);
}

function bookListingForm($isbn) {
	return inputFormat(array('isbn' => $isbn));
}
?>