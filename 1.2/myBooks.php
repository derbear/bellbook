<? require("util/header.php"); 
connect(true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>My Books</title>
    </head>
    <body>
<? print_header(); ?>
        <h2>My Books</h2>
        <?php
            require("util/listing.php");
            $id=$_SESSION['id'];
            $query="SELECT * FROM Listings WHERE ownerId=$id";
            $resource=mysql_query($query);
            if(!$resource) {
                echo 'Error: ' . mysql_error();
            }
            while ($row=mysql_fetch_array($resource)) {
                echo '<hr />';
                echo generateListing($row['ISBN'], mappedTitle($row['ISBN']), $row['price'],
                        $row['post'], $row['descr']); ?>
                <form action="util/removeBook.php" method="post">
                    <input type="hidden" name='id' value=<? echo '"' .
                    $row['listingId'] . '"' ?> />
                    <input type="submit" value="Remove" />
                </form>
            <?}
        ?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->