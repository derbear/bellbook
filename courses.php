<? require("util/header.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Course Lookup</title><?php $pagetitle = 'Browse courses'; ?>
    </head>
    <body>
        <? print_header(); ?>
        <h2>Find course information</h2>
        <div> <p> Select a course from the list below: </p> </div>
        <? require("util/listing.php"); ?>
        <form action="course.php" method="get">
            <select name="id">
                <option value="">Select...</option>
<?php
$query="SELECT * FROM COURSES ORDER BY courseName";
$resource=mysql_query($query);
if($resource) {
    while ($row=mysql_fetch_array($resource)) {
        echo '<option value='.'"'.$row['courseId'].'"'.'>'.$row['courseName'].
        '</option>';
    }
}
?>
            </select>
            <input type="submit" value="Find" />
        </form>
		<? if (isset($_SESSION['id'])) { ?> <div> <p> If you didn't find your course, you can add one <a href='newCourse.php'>here</a>. </p> </div> <? } ?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->