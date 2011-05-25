<?php
require("connect.php");
connect(false);
error_reporting(E_ALL); //TODO #set_error_reporting
ini_set("display_errors", 1);
//if(!mysql_query("UPDATE Books SET title='' WHERE courseId=$cid"))
//    echo 'bad'.mysql_error().'<br />';
//if(mysql_query("DROP TABLE CMap")) {
//    echo 'good';
//} else echo 'bad' . mysql_error();
//if(mysql_query("DROP TABLE Courses")) {
//    echo 'good';
//} else echo 'bad' . mysql_error();
//if(mysql_query("CREATE TABLE Courses (courseId int NOT NULL AUTO_INCREMENT, courseName text, teachers text,
//        PRIMARY KEY (courseId))")) {
//    echo 'good';
//} else echo 'bad' . mysql_error();
//if(mysql_query("CREATE TABLE CMap (ISBN char(10), courseId int, required int,
//        CONSTRAINT books_map FOREIGN KEY (ISBN) REFERENCES Books(ISBN),
//        CONSTRAINT course_map FOREIGN KEY (courseId) REFERENCES Courses(courseId))")) {
//    echo 'good';
//} else echo 'bad' . mysql_error();
//$query="DELETE FROM Courses WHERE courseId='85'";
//$resource=mysql_query($query);
//mysql_query("DELETE FROM Courses WHERE courseId='86'");
//mysql_query("DELETE FROM Courses WHERE courseId='87'");
//mysql_query("DELETE FROM Courses WHERE courseId='40'");
//mysql_query("DELETE FROM Courses WHERE courseId='41'");
//if (mysql_query("DELETE FROM CMap")) echo 'good';
//else echo 'bad'.mysql_error();
//if (mysql_query("DELETE FROM Books")) echo 'good';
//else echo 'bad'.mysql_error();
if(true) {/*
    while($row=mysql_fetch_array($resource)) {
        echo $row['ISBN'] . '::' . $row['courseId'] . '::' .
        $row['required'] . ' ';
        echo '<br />';
    }*/
} else {
    echo 'failed';
}
if(!mysql_query("ALTER TABLE Listings MODIFY COLUMN ISBN char(13)")) {
    die('<br />bad alter'.mysql_error());
}
//$query="DELETE FROM Listings WHERE ownerId='42'"; //nimit's troll account
//if(mysql_query($query))
//	echo 'good';
//else 
//	echo 'error: '. mysql_error();
$query="SELECT * FROM CMap";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        echo $row['ISBN'] . '::' . $row['courseId'] . '::' .
        $row['required'] . ' ';
        echo '<br />';
    }
} else {
    echo 'failed';
}
//$query="DELETE FROM Courses WHERE courseId='2'";
//$resource=mysql_query($query);
//if($resource) {
////    while($row=mysql_fetch_array($resource)) {
////        echo $row['ISBN'] . '::' . $row['courseId'] . '::' .
////        $row['required'] . ' ';
////        echo '<br />';
////    }
//} else {
//    echo 'failed';
//}
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