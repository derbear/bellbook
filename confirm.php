<? require("util/header.php");
connect(true);
//remove dashes and $
$_POST['price']=trim($_POST['price'], '$');
$_POST['title']=str_replace('-', '', $_POST['title']);
//
if(isset($_POST['descr'])) {
    $descr=$_POST['descr'];
} else {
    $descr="";
}
$err='';
//data integrity checking
if(!(strlen($_POST['isbn'])==10||strlen($_POST['isbn'])==13)) {
    $err.='Please enter a valid 10 or 13-digit ISBN. The length of your entered
        ISBN is '.strlen($_POST['isbn'].'. ');
}
if(strlen($_POST['price']==0)||!is_numeric($_POST['price'])) {
    $err.='Please enter a valid price. ';
}
if(strlen($err)>0) {
    header('Location: sellBook.php?message='.$err);
    die();
}
//end integrity checking
if(isset($_POST['new_title'])&&strlen($_POST['new_title'])!=0
        &&(!isset($_POST['alt_isbn'])||strlen($_POST['alt_isbn'])==0)
        ||((strlen($_POST['alt_isbn'])==10||strlen($_POST['alt_isbn'])==13)
        &&(strlen($_POST['isbn'])!=strlen($_POST['alt_isbn'])))) {
    //try to create book, then reconfirm
    $isbn=$_POST['isbn'];
    if(isset($_POST['alt_isbn'])&&strlen($_POST['alt_isbn'])!=0)
        $alt_isbn=$_POST['alt_isbn'];
    $title=$_POST['new_title'];
    if(isset($alt_isbn)) {
        $isbntemp=$alt_isbn;
        if(strlen($isbn)==10) { //makes sure that $isbn is 13-length
            $alt_isbn=$isbn;
            $isbn=$isbntemp;
        }
    }
    //$title=filter_var($title, FILTER_SANITIZE_STRING);
    $isbn=trim($isbn);
    $title=trim($title);
    $query="INSERT INTO Books VALUES('$isbn', '$title')";
    $resource=mysql_query($query);
    if(!$resource) {
//        die('Error ' . mysql_error());
    }
    if(isset($alt_isbn)) {
        $query="INSERT INTO Aliases VALUES('$alt_isbn', '$isbn')";
        $resource=mysql_query($query);
        if(!$resource) {
            die('Error ' . mysql_error());
        }
    }
    foreach($_POST as $attr=>$value) {
        if(strncmp($attr, "courseN", 7)==0 && isset($value)) {
            $query="";
            if(substr_compare($attr, "0PT", -3)!=0) {
                $cid=substr($attr, 7);
                $query="INSERT INTO CMap VALUES('$isbn', '$cid', '0')";
            } else {
                $cid=substr($attr, 7, strlen($attr) - 7 - 3);
                $query="UPDATE CMap SET required='1' WHERE courseId=$cid";
            }
            $resource=mysql_query($query);
            if(!$resource) {
//                echo mysql_error() . '<br />';
            }
        }
    }
} else if(isset($_POST['new_title'])) { 
    if(isset($_POST['alt_isbn'])) { //bad ISBN length
        $_GET['message']='Please enter a valid alternate ISBN that is 10 or 13 '
            .'characters long. ';
    }
    if(strlen($_POST['new_title'])==0){ //unset title
        $_GET['message']='Please enter a valid title. ';
        $isbn=$_POST['isbn'];
    }
    $isbn=$_POST['isbn'];
} else if(isset($_POST['isbn']) && !isset($_GET['new'])) { //simple confirm
    $isbn=$_POST['isbn'];
    $len=strlen($isbn);
    $query="SELECT * FROM Aliases WHERE ";
    if($len==10) {
        $query.="ISBN10='$isbn'";
    } else if($len==13) {
        $query.="ISBN13='$isbn'";
    }
    $resource=mysql_query($query);
    if(!$resource) {
        die("Error: ".mysql_error());
    }
    while($row=mysql_fetch_array($resource)) {
        $isbn=$row['ISBN13'];
        $alt_isbn=$row['ISBN10'];
    }
} else { //bad data, need creation
    $isbn="";
}
$isbn=filter_var($isbn, FILTER_SANITIZE_STRING);
require_once("util/listing.php");
$query="SELECT * FROM Books WHERE ISBN='$isbn'";
$resource=mysql_query($query);
$title="";
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        $title=$row['title'];
    }
} else {
//    echo mysql_error();
}
//echo $title;
if($title=="") {
    $ptitle="Add book";
} else {
    $ptitle="Confirm selling " . $title;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title><? echo $ptitle; ?></title>
    </head>
    <body>
        <? print_header(); ?>
        <div id="content-title"><h2><? echo $ptitle; ?></h2></div>
<?php
if($title!="") {?>
        <div><p>Confirm offer:</p>
            <table>
                <tr>
                    <td><b>Title:</b></td>
                    <td><?echo $title ?></td>
                </tr>
<?if(isset($alt_isbn)) {?>
                <tr>
                    <td><b>ISBN-13:</b></td>
                    <td><?echo $isbn ?></td>
                </tr>
                <tr>
                    <td><b>ISBN-10:</b></td>
                    <td><?echo $alt_isbn ?></td>
                </tr>
<?} else {?>
                <tr>
                    <td><b>ISBN:</b></td>
                    <td><?echo $isbn ?></td>
                </tr>
<? } ?>
                <tr>
                    <td><label for="price"> <b>Price:</b> </label></td>
                    <td><?echo $_POST['price']?></td>
                </tr>
                <tr>
                    <td><label for="descr"> <b>Description:</b> </label></td>
                    <td><?echo $descr?></td>
                </tr>
            </table>
        <form action="util/postBook.php" method="post">
            <input type="hidden" name="isbn" value=<?echo '"'.$isbn.'"';?> />
            <input type="hidden" name="price" value=<?echo '"'.$_POST['price'].'"';?> />
            <input type="hidden" name="descr" value=<?echo '"'.$descr.'"';?> />
            <input type="Submit" value="Post for sale" />
        </form>
        <p> Not the correct book? You may have entered wrong ISBN. If the ISBN
            is correct, contact <a href="mailto: derek.leung12@bcp.org">
        Derek Leung </a> </p>
        </div>
<?} else {
    /////////////////////////////////////////////////////////////////////////
    if(!isset($_GET['new'])) { ?>
        <div> <p> The ISBN you entered is not yet in our database.
                Enter its title, and its alternate ISBN if it has one: </p>
            <form action="confirm.php" method="post">
                <table>
                    <tr>
                        <td><b>ISBN</b></td>
                        <td><?echo $isbn ?></td>
                    </tr>
                    <tr>
                        <td><b>Alternate ISBN</b></td>
                        <td><input type="text" name="alt_isbn" /></td>
                    </tr>
                    <tr>
                        <td><b>Title</b></td>
                        <td><input type="text" name="new_title" /></td>
                    </tr>
                </table>
                <div> <p> Select the following courses where this book is used.
                        Check 'required' if this book is required for the course.
                    </p> </div>
                <table>
        <? require_once("util/listing.php"); ?>
<?php
$query="SELECT * FROM COURSES ORDER BY courseName";
$resource=mysql_query($query);
if($resource) {
    while ($row=mysql_fetch_array($resource)) { ?>
                    <tr>
        <?echo '<td><input type="checkbox" name='.'"courseN'.
        $row['courseId'].'"'. 'value='.'"'.
        $row['courseId'].'"'.'/>'.'<b>'.$row['courseName'].'</b></td>';
        echo '<td><input type="checkbox" name='.'"courseN'.
        $row['courseId'].'0PT"' . 'value="true" /> required</td>';?>
                    </tr>
    <?}
}
?>
                </table>
                <p> If you cannot find the course name on the list above, click
                    <a href="newCourse.php" target="_blank">here</a> to add a
                    new course, and then refresh the page. </p>
                <input type="hidden" name="isbn" value=<?echo '"'.$isbn.'"';?> />
                <input type="hidden" name="price" value=<?echo '"'.$_POST['price'].'"';?> />
                <input type="hidden" name="descr" value=<?echo '"'.$descr.'"';?> />
                <input type="Submit" value="Post new book" />
            </form>
        </div>
    <? } /*else { ?> //REMOVED due to moderation editing
        <div>The title of the book with this ISBN is incorrect.
                    <tr>
                        <td><b>ISBN</b></td>
                        <td><input type="text" value="new_isbn" /></td>
                    </tr>
        </div>
<?}*/
}?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->