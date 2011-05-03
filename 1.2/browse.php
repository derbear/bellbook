<? require("util/header.php"); ?>
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
$query='SELECT * FROM Listings';
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        $owner=$row['ownerId'];
        $query_owner="SELECT * FROM Users WHERE studentId=$owner";
        $resource2=mysql_query($query_owner);
        if($resource2) {
            $row2=mysql_fetch_array($resource2);
            echo '<hr />';
            echo generateListing_B($row['ISBN'], mappedTitle($row['ISBN']), 
                    mappedClasses($row['ISBN']));
            ?><p><? echo '<a href=offers.php?isbn='.
            $row['ISBN'].'>See offers</a>' ?></p><?
//            echo generateListing_S($row['ISBN'], mappedTitle($row['ISBN']),
//                    $row['price'], $row['post'], $row['descr'],
//                    $row2['email'], $row2['firstName'],
//                    $row2['lastName']);
        if(/*$_SESSION['id']==212189*/false) {
            ?>
                <form action="util/removeBook.php" method="post">
                    <input type="hidden" name='id' value=<? echo '"' .
                    $row['listingId'] . '"' ?> />
                    <input type="submit" value="Remove" />
                </form>
            <?
            }
        }
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