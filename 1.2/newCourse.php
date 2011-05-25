<? require("util/header.php"); 
connect(true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Add a Course</title>
    </head>
    <body>
        <? print_header(); ?>
        <h2>Add a course</h2>
        <div>
            <form action="util/addCourse.php" method="post" >
                <table>
                    <tr>
                        <td><label for="courseId"> Name: </label></td>
                        <td><input type="text" name="courseId" id="courseId" /></td>
                    </tr>
                </table>
                <input type="submit" name="Submit" value="Submit" id="submit" />
            </form>
        </div>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->