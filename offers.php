<? require("util/header.php");
if(isset($_GET['isbn']))
    $isbn=$_GET['isbn'];
else
    $isbn="";
$isbn=filter_var($isbn, FILTER_SANITIZE_STRING);
connect(false);
require_once("util/listing.php");
$title=mappedTitle($isbn);
//if($title=="") {
//    header("Location: index.php?message=Invalid ISBN");
//}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
<? if(strcmp($title, "")!=0) { $all=false;?>
        <title>Prices for <?echo $title;?></title>
<? } else { $all=true; $pagetitle = 'Book offers';?>
        <title>Browse book offers </title>
<? } ?>
    </head>
    <body>
        <? print_header() ?>
<? if(strcmp($title, "")!=0) { ?>
        <div id="content-title"><h2> Prices for <?echo $title;?> </h2></div>
<? } else {?>
        <div id="content-title"><h2> Book offers </h2></div><?php  ?>
 <? } ?>
        <hr class="title-line"/>
<?php
if(!$all)
    $query="SELECT * FROM Listings WHERE ISBN='$isbn' ORDER BY Price ASC";
else
    $query="SELECT * FROM Listings ORDER BY post DESC";
$resource=mysql_query($query);
if($resource) {
	$i=0;
    while($row=mysql_fetch_array($resource)) {
        $owner=$row['ownerId'];
        $query2="SELECT * FROM Users WHERE studentId=$owner";
        $resource2=mysql_query($query2);
        while($row2=mysql_fetch_array($resource2)) {
        	$addClass = "";
            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
            $newcode = "<div class='item$addClass'>";
            if($all) {
                $isbn=$row['ISBN'];
                $query3="SELECT * FROM Books WHERE ISBN='$isbn'";
                $row3=mysql_fetch_array(mysql_query($query3));
                $title=$row3['title'];
            }
            $newcode .= generateListing_S($isbn, $title,
            		$row['price'], $row['post'],
                    $row['descr'], $row2['email'], 
                    $row2['studentId'], $row2['firstName'],
                    $row2['lastName']);
            echo $newcode;
            if(isset($_SESSION['id'])) { ?>
		<form action="util/trackBook.php" method="post">
            <input type="hidden" name='list_id' value=<? echo '"' .
            $row['listingId'] . '"' ?> />
            <input type="hidden" name='oper' value='1' />
            <input type="submit" value="Track" class="track"/>
        </form> <? 
        	} ?></div><?
        }
    }
}
?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, Ben Chan
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->