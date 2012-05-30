<?php
require_once('../access/bellbook.includes.php');

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
function inputFormat($row) {
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
	
	if(isset($row['price'])) {
		$price = $row['price'];
		$formatting .= 'Price: ' . abs($price) . '<br />';
		if($price < 0)
			$formatting .= 'Type: Bid <br />';
		else
			$formatting .= 'Type: Offer <br />';
	}
	if(isset($row['description']))
		$formatting .= 'Description: ' . $row['description'] . '<br />';
	return $formatting;
}
?>