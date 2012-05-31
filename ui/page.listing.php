<?php

/**
 * Formats a listing entry from the database.
 */
function format($row) {
	$formatting = '';
	$isbn = $row['isbn'];		
	$info = bookinfo($isbn, $isbn10, $isbn13, $title, $title_ext, $author, $publisher);
	if(!$info)
		return 'Invalid book data - bad ISBN <br />';
		
	$formatting .= '<ul>';
	$formatting .= '<li>ISBN-10: ' . $isbn10 . '</li>';
	$formatting .= '<li>ISBN-13: ' . $isbn13 . '</li>';
	$formatting .= '<li>Title: ' . $title . '</li>';
	// $formatting .= '<li>Long title: ' . $title_ext . '</li>';
	$formatting .= '<li>Author: ' . $author . '</li>';
	$formatting .= '<li>Publisher: ' . $publisher . '</li>';
	$formatting .= '</ul>';
	$price = $row['price'];
	$formatting .= 'Price: ' . abs($price) . '<br />';
	if($price < 0)
		$formatting .= 'Type: Bid <br />';
	else
		$formatting .= 'Type: Offer <br />';
	$formatting .= 'Description: ' . $row['description'] . '<br />';
	
	$studentId = $row['owner'];
	$cn = getCn(userinfoId($studentId));
	$formatting .= 'Posted by: ' . $cn . '<br />';
	$formatting .= 'Updated on: ' . $row['updated'] . '<br />';
	return $formatting;
}

/**
 * Formats a book entry with editable input.
 */
function inputFormat($row, $index) {
	$formatting = '';
	$isbn = $row['isbn'];
	$info = bookinfo($isbn, $isbn10, $isbn13, $title, $title_ext, $author, $publisher);
	if(!$info)
		return false; // simplify things
	
	$formatting .= "<span id='listing" . $index . "'>";
	$formatting .= '<ul>';
	$formatting .= '<li>ISBN-10: ' . $isbn10 . '</li>';
	$formatting .= '<li>ISBN-13: ' . $isbn13 . '</li>';
	$formatting .= '<li>Title: ' . $title . '</li>';
	// $formatting .= '<li>Long title: ' . $title_ext . '</li>';
	$formatting .= '<li>Author: ' . $author . '</li>';
	$formatting .= '<li>Publisher: ' . $publisher . '</li>';
	$formatting .= '</ul>';
	
	if(isset($row['price'])) {
		$price = $row['price'];
		$formatting .= 'Price: ' . abs($price) . '<br />';
		if($price < 0)
			$formatting .= 'Type: Bid <br />';
		else
			$formatting .= 'Type: Offer <br />';
	} else {
		$formatting .= "<label for='price" . $index . "'>Price: </label> <input type='text' id='entry" . $index . "' /> <br />\n";
		$formatting .= "<label for='type" . $index . "'>Type: </label> <select name='type" . $index . "'> <option value='offer'>Sell</option> <option value='bid'>Buy</option> </select> <br />";
	}
	if(isset($row['description'])) {
		$formatting .= 'Description: ' . $row['description'] . '<br />';
	} else {
		$formatting .= "<label for='description" . $index . "'>Description: </label> <input type='text' id='description" . $index . "' /> <br />\n";
	}
	$formatting .= "<button onclick='removeBook(" . $index . ")'>Remove</button> <br />";
	$formatting .= "</span>";
	return $formatting;
}
?>