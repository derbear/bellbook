<? require("util/header.php");
if(isset($_GET['isbn']))
    $isbn=$_GET['isbn'];
else
    $isbn="";
$isbn=filter_var($isbn, FILTER_SANITIZE_STRING);
connect(false);
require_once("util/listing.php");
$title=mappedTitle($isbn);
if($title=="") {
    header("Location: index.php?message=Invalid ISBN");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Prices for <?echo $title;?></title>
    </head>
    <body>
        <? print_header() ?>
        <h2> Prices for <?echo $title;?> </h2>
<?php
$query="SELECT * FROM Listings WHERE ISBN='$isbn' ORDER BY Price ASC";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        $owner=$row['ownerId'];
        $query2="SELECT * FROM Users WHERE studentId=$owner";
        $resource2=mysql_query($query2);
        while($row2=mysql_fetch_array($resource2)) {
            echo "<hr />";
            echo generateListing_S($isbn, $title, $row['price'], $row['post'],
                    $row['descr'], $row2['email'], $row2['studentId'], $row2['firstName'],
                    $row2['lastName']);
            if(isset($_SESSION['id'])) { ?>
<form action="util/trackBook.php" method="post">
            <input type="hidden" name='list_id' value=<? echo '"' .
            $row['listingId'] . '"' ?> />
            <input type="hidden" name='oper' value='1' />
            <input type="submit" value="Track" />
        </form> <? }
        }
    }
}
?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->