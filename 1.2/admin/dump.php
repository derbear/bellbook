<?php
require("connect.php");
connect(false);
error_reporting(E_ALL); //TODO remove
ini_set("display_errors", 1);
$query="SELECT * FROM Users";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        echo $row['studentId'] . '->' . $row['lastName'] . ', ' .
        $row['firstName'] . ' ';
        echo '<br />';
    }
} else {
    echo 'failed';
}/*
$query="SELECT * FROM Listings WHERE title LIKE 'Losing%'";
$resource=mysql_query($query);
if($resource) {
    $row=mysql_query(mysql_fetch_array($resource));
    echo $row['title'];
    echo 'success';
} else {
    echo 'failed' . mysql_error();
}
$query="DROP INDEX title ON Listings";
if(mysql_query($query)) {
    echo 'success';
} else {
    echo 'failed' . mysql_error();
}*/
$query="SELECT * FROM Books";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        echo $row['ISBN'] . '->' . $row['title'];
        echo '<br />';
    }
} else {
    echo 'failed';
}
//$query="INSERT INTO Courses Values('231', 'U.S. History AP', 'Sullivan, Troyan')";
//if(mysql_query($query)) {
//    //echo 'success';
//}
//else {
//    echo 'failure: ' . mysql_error();
//}
$query="SELECT * FROM Courses";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        echo $row['courseId'] . '->' . $row['courseName'];
        echo '<br />';
    }
} else {
    echo 'failed';
}
//phpinfo();
?>