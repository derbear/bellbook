<?php
/**
 * List a link on the navigation bar
 */
function listLink($loc, $title) {
	global $noscript;
	if ($noscript) { 
		?> <a href='index.php?loc=<? echo $loc; ?>&amp;noscript=true'><? echo $title; ?></a> <? 
	} else { 
		?> <a href='#' onclick='fetchContent("<? echo $loc; ?>.php")'><? echo $title; ?></a><? 
	} 
}?>

<div align='right'> navigation:
	<? listLink('home', 'home'); ?>
</div>