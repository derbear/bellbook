<? require("util/header.php");
connect(true);
foreach($_POST as $attr=>&$value) {
    $value=filter_var($value, FILTER_SANITIZE_STRING);
}
foreach($_GET as $attr=>&$value) {
    $value=filter_var($value, FILTER_SANITIZE_STRING);
}

if(isset($_POST['new_title'])) {
    $isbn=$_POST['isbn'];
    $title=$_POST['new_title'];
    $title=filter_var($title, FILTER_SANITIZE_STRING);
    $query="INSERT INTO Books VALUES('$isbn', '$title')";
    $resource=mysql_query($query);
    if(!$resource) {
        echo 'Error ' . mysql_error();
    }
} else if(isset($_POST['isbn']) && !isset($_GET['new']))
    $isbn=$_POST['isbn'];
else
    $isbn="";
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
    echo mysql_error();
}
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
        <h2><? echo $ptitle; ?></h2>
<?php //TODO implement rectify
if($title!="") {?>
        <div><p>Confirm offer:</p>
            <table>
                <tr>
                    <td><b>Title:</b></td>
                    <td><?echo $title ?></td>
                </tr>
                <tr>
                    <td><b>ISBN:</b></td>
                    <td><?echo $isbn ?></td>
                </tr>
                <tr>
                    <td><label for="price"> <b>Price:</b> </label></td>
                    <td><?echo $_POST['price']?></td>
                </tr>
                <tr>
                    <td><label for="descr"> <b>Description:</b> </label></td>
                    <td><?echo $_POST['descr']?></td>
                </tr>
            </table>
        <form action="util/postBook.php" method="post">
            <input type="hidden" name="isbn" value=<?echo '"'.$isbn.'"';?> />
            <input type="hidden" name="price" value=<?echo '"'.$_POST['price'].'"';?> />
            <input type="hidden" name="descr" value=<?echo '"'.$_POST['descr'].'"';?> />
            <input type="Submit" value="Post for sale" />
        </form>
        <p> Not the correct book? You may have entered wrong ISBN.
            <!--If it isn't, click <a href="confirm.php?new=1"> here</a>--></p>
        </div>
<?} else {
    if(!isset($_GET['new'])) { ?>
        <div> <p> The ISBN you entered is not yet in our database.
                Enter its title here: </p>
            <form action="confirm.php" method="post">
                <table>
                    <tr>
                        <td><b>Title</b></td>
                        <td><input type="text" name="new_title" /></td>
                    </tr>
                </table>
                <input type="hidden" name="isbn" value=<?echo '"'.$isbn.'"';?> />
                <input type="hidden" name="price" value=<?echo '"'.$_POST['price'].'"';?> />
                <input type="hidden" name="descr" value=<?echo '"'.$_POST['descr'].'"';?> />            <input type="Submit" value="Post new book" />
            </form>
        </div>
    <? } /*else { ?>
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
    Project BellBook - 1.2
    Bellarmine College Preparatory, 2011
-->