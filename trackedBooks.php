<?php require("util/header.php");
connect(true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>My Tracked Books</title>
    </head>
    <body>
        <? print_header(); ?>
        <div id="content-title"><h2>My Tracked Books</h2></div>
        <p>This page shows all the books you're currently keeping track of.
           This feature is mainly for your convenience--you'll still want to
           contact whomever you wish to buy from.</p>
        <hr class="title-line"/>
<?php
    require_once("util/listing.php");
    $id=$_SESSION['id'];
    $query="SELECT * FROM TMap WHERE studentId=$id";
    $resource=mysql_query($query);
    if($resource) {
        $i=0;
        while($row=mysql_fetch_array($resource)) {
            $listId=$row['listingId'];
            $tr_query="SELECT * FROM Listings WHERE listingId=$listId";
            $tr_rsrc=mysql_query($tr_query);
            if($tr_rsrc) {
                while($tr_row=mysql_fetch_array($tr_rsrc)) {
                    $owner=$tr_row['ownerId'];
                    $owner_query="SELECT * FROM Users WHERE studentId=$owner";
                    $own_rsrc=mysql_query($owner_query);
                    if($own_rsrc) {
                        $own_row=mysql_fetch_array($own_rsrc);
                        $addClass = "";
			            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
			            $newcode = "<div class='item$addClass'>" . generateListing_S($tr_row['ISBN'], 
			            	mappedTitle($tr_row['ISBN']),
                            $tr_row['price'], $tr_row['post'], $tr_row['descr'],
                            $own_row['email'], $row2['studentId'], $own_row['firstName'],
                            $own_row['lastName']);
			            echo $newcode;
                        ?>
			<form action="util/trackBook.php" method="post">
	            <input type="hidden" name='list_id' value=<? echo '"' .
	            $row['listingId'] . '"' ?> />
	            <input type="hidden" name='oper' value='0' />
	            <input type="submit" value="Remove" class="remove"/>
	        </form>
	        </div> <!-- end item -->
                        <?
                    } //end if
                } //end while
            } //end if
        } // end while
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