<?php
require("connect.php");
connect(false);
$cid=$_POST['courseId'];
$cid=filter_var($cid, FILTER_SANITIZE_STRING);
$query="INSERT INTO Courses (courseName) Values ('$cid')";
if(mysql_query($query)) {
    echo 'success';
}
//header('../confirm.php');
?>