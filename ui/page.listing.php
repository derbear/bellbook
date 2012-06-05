<?php

/**
 * Formats a listing entry from the database.
 */
function format($row) {
	$formatting = '';
	$isbn = $row[1];
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
	$price = $row[2];
	$formatting .= 'Price: ' . abs($price) . '<br />';
	if($price < 0)
		$formatting .= 'Type: Bid <br />';
	else
		$formatting .= 'Type: Offer <br />';
	$formatting .= 'Description: ' . $row[3] . '<br />';
	
	$studentId = $row[4];
	$cn = getCn(userinfoId($studentId));
	$formatting .= 'Posted by: ' . $cn . '<br />';
	$formatting .= 'Updated on: ' . $row[6] . '<br />';
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
	
	$formatting .= "<span id='listing$index'>";
	$formatting .= "<input type='hidden' name='isbn$index' . value='" . $isbn13 . "' />";
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
		if($price < 0)
			$type = 'bid';
		else
			$type = 'offer';
	} else {
		$price = '';
		$type = 'offer';
	}
	$formatting .= "<label for='price$index'>Price: </label> <input type='text' name='price$index' id='price$index' value='$price'/> <br />\n";
	$formatting .= "<label for='type$index'>Type: </label> <select name='type$index' id='type$index'> <option value='offer'>Sell</option> <option value='bid'>Buy</option> </select> <br />"; // TODO $type is selected
	if(isset($row['description'])) {
		$descr = $row['description'];
	} else {
		$descr = '';
	}
	$formatting .= "<label for='description$index'>Description: </label> <input type='text' name='description$index' id='description$index value='$descr'/> <br />\n";
	$formatting .= "<button onclick='removeBook($index)'>Remove</button> <br />";
	$formatting .= "</span>";
	return $formatting;
}
?>