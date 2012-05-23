<?php
$testing = true; // false on actual server, true when testing

include('bellbook.meta.php');
if($testing)
	include('bellbook.local.php');
else
	include('bellbook.greco.php');
include('bellbook.db.php');
include('bellbook.books.php');
?>