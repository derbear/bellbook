<? require("util/header.php");
connect(false);
$cId=$_GET['id'];
$cname="";
$cteachers="";
$query="SELECT * FROM Courses WHERE courseId=$cId";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        $cname=$row['courseName'];
        $cteachers=$row['teachers'];
    }
} else {
    header("Location: course.php?message=Invalid course: $cId");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Course: <?php echo $cname; ?></title>
    </head>
    <body>
        <? print_header(); ?>
        <h2> <?php echo $cname; ?> information </h2> 
        <div> <? /*<p> The following course information applies to these teachers:
            <? echo $cteachers ?> </p>*/?>
            <p><b>Books required:</b></p>
            <? require("util/listing.php");
            $query="SELECT * FROM CMap WHERE courseId='$cId' AND required='1'";
            $resource=mysql_query($query);
            if($resource) {
                while($row=mysql_fetch_array($resource)) {
                    echo "<hr />";
                    echo generateListing_B($row['ISBN'], mappedTitle($row['ISBN']),
                            mappedClasses($row['ISBN']));
                    ?><p><? echo '<a href=offers.php?isbn='.
                    $row['ISBN'].'>See offers</a>' ?></p><?
                }
            }
            ?>
        </div>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.2
    Bellarmine College Preparatory, 2011
-->