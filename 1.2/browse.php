<? require("util/header.php");
$criterion='title';
$direction='ASC';
if(isset($_GET['sort'])) {
    $criterion=filter_var($_GET['sort'], FILTER_SANITIZE_STRING);
}
if(isset($_GET['dir'])) {
    $direction=filter_var($_GET['dir'], FILTER_SANITIZE_STRING);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Browse for books</title>
    </head>
    <body>
        <? print_header(); ?>
        <h2>Browse books</h2>
<?php
require_once("util/connect.php");
require_once("util/listing.php");
connect(false);
$query='SELECT * FROM Books ORDER BY '.$criterion .' ' .$direction;
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
            echo '<hr />';
            echo generateListing_B($row['ISBN'], $row['title'],
                    mappedClasses($row['ISBN']));
            ?><p><? echo '<a href=offers.php?isbn='.
            $row['ISBN'].'>See offers</a>' ?></p><?
    }
}
?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.2
    Bellarmine College Preparatory, 2011
-->