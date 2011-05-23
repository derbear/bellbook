<? require("util/header.php");
$criterion='title';
$direction='ASC';
$page_num=1;
//$per_page=10; //default
$per_page=111111111111;
if(isset($_GET['sort'])) {
    $criterion=$_GET['sort'];
}
if(isset($_GET['dir'])) {
    $direction=$_GET['dir'];
}
if(isset($_GET['page'])) {
    $page_num=$_GET['page'];
}
if(isset($_GET['num'])) {
    $per_page=$_GET['num'];
}
$pos=(($page_num - 1) * $per_page);
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
$query='SELECT * FROM Books ORDER BY '.$criterion .' ' .$direction .
" LIMIT " . $pos . ", " . $per_page. "";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
            echo '<hr />';
            echo generateListing_B($row['ISBN'], $row['title'],
                    mappedClasses($row['ISBN']));
            ?><p><? echo '<a href=offers.php?isbn='.
            $row['ISBN'].'>See offers</a>' ?></p><?
    }
} else {
    echo mysql_error();
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