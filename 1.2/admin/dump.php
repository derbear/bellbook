<?php
require("connect.php");
connect(false);
$query="SELECT * FROM Users";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        echo $row['studentId'] . ' ' . $row['firstName'] . ' ' .
        $row['lastName'] . ' '  ;
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
        echo '|'.$row['ISBN'] . '->' . $row['title'] . '| ';
        echo '<br />';
    }
} else {
    echo 'failed';
}
phpinfo();
?>