<?php
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