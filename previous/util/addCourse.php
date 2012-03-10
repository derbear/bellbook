<?php
require("connect.php");
connect(false);
$cid=$_POST['courseId'];
$cid=filter_var($cid, FILTER_SANITIZE_STRING);
$query="INSERT INTO Courses (courseName) Values ('$cid')";
if(mysql_query($query)) {
    header('Location: ../newCourse.php?message=Course successfully added');
    echo 'success';
} else {
    header('Location: ../newCourse.php?message=Course addition unsuccessful');
}
?>