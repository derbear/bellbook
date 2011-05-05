<? require("util/header.php");
connect(true);
if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['new_title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $query = "INSERT INTO Books VALUES('$isbn', '$title')";
    $resource = mysql_query($query);
    if (!$resource) {
        header("Location: newBook.php?message=An error occurred");
    }
    foreach ($_POST as $attr => $value) {
        if (strncmp($attr, "courseN", 7) == 0 && isset($value)) {
            $query = "";
            if (substr_compare($attr, "0PT", -3) != 0) {
                $cid = substr($attr, 7);
                $query = "INSERT INTO CMap VALUES('$isbn', '$cid', '0')";
            } else {
                $cid = substr($attr, 7, strlen($attr) - 7 - 3);
                $query = "UPDATE CMap SET required='1' WHERE courseId=$cid";
            }
            $resource = mysql_query($query);
            if (!$resource) {
//                echo mysql_error() . '<br />';
            }
        }
    }
    header("Location: newBook.php?message=Query successful; status: " . mysql_error());
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Add a Book</title>
    </head>
    <body>
        <? print_header(); ?>
        <h2>Add a book to bellbook's database</h2>
            <form action="newBook.php" method="post">
                <table>
                    <tr>
                        <td><b>ISBN</b></td>
                        <td><input type="isbn" name="isbn" /></td>
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
                    new course; afterwards, refresh the page. </p>
                <input type="Submit" value="Post new book" />
            </form>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.2
    Bellarmine College Preparatory, 2011
-->