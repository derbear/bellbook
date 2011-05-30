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
        <div id="content-title"><h2>My Books</h2></div>
        <?php
            require("util/listing.php");
            $id=$_SESSION['id'];
            $query="SELECT * FROM Listings WHERE ownerId=$id";
            $resource=mysql_query($query);
            if(!$resource) {
                echo 'Error: ' . mysql_error();
            }
            echo '<hr class="title-line"/>';
            $i=0; // this code is similar to that in browse.php and trackedBooks. One day we should make a function that does it
            while ($row=mysql_fetch_array($resource)) {
	            $addClass = "";
	            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
	            $newcode = "<div class='item$addClass'>" . generateListing($row['ISBN'], 
	            		mappedTitle($row['ISBN']), $row['price'],
                        $row['post'], $row['descr']);
	            echo $newcode;
                ?>
                <form action="util/removeBook.php" method="post">
                    <input type="hidden" name='id' value=<? echo '"' .
                    $row['listingId'] . '"' ?> />
                    <input type="submit" value="Remove" class="remove"/>
                </form>
                </div>
            <?php }
        ?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, Ben Chan
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->