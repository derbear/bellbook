<?php

/*
 * the UI of a book page
 * 
 * requires:
 * $model (BookSelectionForm) the book we are viewing
 *
 */
 
$this->breadcrumbs=array(
	'Browse'=>array('/browse'),
	'Book',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	This link is broken! We can't find the book :( BOOK MISSING OH NOOOOOOO BOUNTY AWARDED OF -5 MONOPOLY DOLLARS
</p>
