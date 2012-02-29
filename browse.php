<?php require("util/header.php");
$criterion='title';
$direction='ASC';
$page_num=1;
//$per_page=10; //default
$per_page=10;
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
        <title>Browse for books</title><?php $pagetitle = 'Browse books'; ?>
    </head>
    <body>
        <? print_header(); ?>
        <div id="content-title"><h2>Browse Books</h2></div> 
		<hr class="title-line"/>
<?php
require_once("util/connect.php");
require_once("util/listing.php");
connect(false);
$query='SELECT * FROM Books ORDER BY '.$criterion .' ' .$direction .
" LIMIT " . $pos . ", " . $per_page. "";
$resource=mysql_query($query);
if($resource) {
	$i=0;
    while($row=mysql_fetch_array($resource)) {
    		$addClass = "";
            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
            $isbn=$row['ISBN'];
            $offerbutton = "<p class='offers'><a href=offers.php?isbn=$isbn>See offers</a></p>";
            $newcode = "<div class='item$addClass'>" . generateListing_B($isbn, $row['title'],
                    mappedClasses($row['ISBN'])) . $offerbutton . '</div>';
            echo $newcode;   
    }
    $resource2 = mysql_query("SELECT COUNT(*) FROM Books");
    if($resource2) {
        $total_r = mysql_fetch_row($resource2);
        $total = $total_r[0];
        if($total - $per_page > $pos) {
            echo "<div class='item-seller item-info'>"; // temporary formatting - might want a separate class for this
            echo "<a href='browse.php?page=" . ($page_num+1) . "&num=" . $per_page ."'>More</a> </div>";
        }
    }
} else {
    echo mysql_error();
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