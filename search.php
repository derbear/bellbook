<? require("util/header.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Book Search</title>
    </head>
    <body>
<? print_header(); ?>
        <? require_once("util/connect.php");
        connect(false);
           require("util/listing.php");?>
        <div id="content-title"><h2>Search results:</h2></div>
        <hr class="title-line"/>
        <?php
        //TODO approximations
        $sid=$_GET['query'];
        $sid=filter_var($sid, FILTER_SANITIZE_STRING);
        $query_isbn="SELECT * FROM Listings WHERE ISBN='$sid'";
//        $sid=str_replace(' ', '%', $sid);
//        echo $sid;
        $sid='%'.$sid.'%';
        $query_title="SELECT * FROM Listings WHERE title LIKE '$sid'";
        $query=$query_isbn . "
UNION
"
        . $query_title;
//        echo $query . '::';
        $resource=mysql_query($query);
        if($resource) {
        	$i=0;
            while($row=mysql_fetch_array($resource)) {
                //fetch owner info
                $owner=$row['ownerId'];
                $query_owner="SELECT * FROM Users WHERE studentId=$owner";
                $resource2=mysql_query($query_owner);
                if($resource2) {
                    $row2=mysql_fetch_array($resource2);
                    $addClass = "";
		            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
		            $newcode = "<div class='item$addClass'>" . generateListing_S($row['ISBN'], mappedTitle($row['ISBN']),
                            $row['price'], $row['post'], $row['descr'],
                            $row2['email'], $row2['studentId'], $row2['firstName'],
                            $row2['lastName']);
		            echo $newcode;
		            ?>
<form action="util/trackBook.php" method="post">
            <input type="hidden" name='list_id' value=<? echo '"' .
            $row['listingId'] . '"' ?> />
            <input type="hidden" name='oper' value='1' />
            <input type="submit" value="Track" class="track"/>
        </form></div> <?
                }
            }
        }
//        $resource=mysql_query($query_title);
//        if($resource) {
//            while($row=mysql_fetch_array($resource)) {
//                //fetch owner info
//                $owner=$row['ownerId'];
//                $query_owner="SELECT * FROM Users WHERE studentId=$owner";
//                $resource2=mysql_query($query_owner);
//                if($resource2) {
//                    $row2=mysql_fetch_array($resource2);
//                    echo '<hr />';
//                    echo generateListing_S($row['ISBN'], $row['title'],
//                            $row['price'], $row['post'], $row['descr'],
//                            $row2['email'], $row2['firstName'],
//                            $row2['lastName']); ?> <?
//<form action="util/trackBook.php" method="post">
//            <input type="hidden" name='list_id' value=<? echo '"' .
//            $row['listingId'] . '"' ?> <!--/>--> <?
//            <input type="submit" value="Track" />
//        </form> ?> <?
//                }
//            }
//        }
        ?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, Ben Chan
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->