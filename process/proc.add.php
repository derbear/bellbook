<?php
require_once('../access/bellbook.includes.php');
require_once('../ui/page.listing.php');
sanitize();
session_start();
if(!connect())
	die('Connection failure');

if(isset($_GET['isbn']) && isset($_GET['index'])) { // TODO implement courses later
	echo bookListingForm($_GET['isbn'], $_GET['index']);
} else if (isset($_POST['finalize'])) {
	$total = $_POST['count'];
	for($i = 0; $i < $total; $i++) {
		if(isset($_POST['removed' . $i]) && $_POST['removed' . $i]) {
			// do nothing - entry was removed
		} else {
			$isbn = $_POST['isbn' . $i];
			$price = $_POST['price' . $i];
			$type = $_POST['type' . $i];
			if(strcmp($type, 'bid') == 0) {
				$price *= -1;
			}
			$description = $_POST['description' . $i];
			$owner = $_SESSION['id'];
			
			$query = "INSERT INTO Listings
				(isbn, price, description, owner, status, updated)
			VALUES
				('$isbn', $price, '$description', $owner, 0, NOW())";
			if(mysql_query($query)) {
				// do nothing
			} else {
				echo $query;
				die('Error: '. mysql_error());
			}
		}
	}
	header('Location: ../index.php?query=status&message=Post successful');
}

function bookListingForm($isbn, $index) {
	$result = inputFormat(array('isbn' => $isbn), $index);
	if($result) return $result;
	return '';
}
?>