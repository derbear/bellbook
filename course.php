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
        <div id="content-title"><h2> <?php echo $cname; ?> information </h2></div>
        <hr class="title-line"/>
        <div> <? /*<p> The following course information applies to these teachers:
            <? echo $cteachers ?> </p>*/?>
            <p><b>Required books:</b></p>
            <? require("util/listing.php");
            $query="SELECT * FROM CMap WHERE courseId='$cId' AND required='1'";
            $resource=mysql_query($query);
            if($resource) {
                $i=0;
			    while($row=mysql_fetch_array($resource)) {
			    		$addClass = "";
			            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
			            $isbn=$row['ISBN'];
			            $offerbutton = "<p class='offers'><a href=offers.php?isbn=$isbn>See offers</a></p>";
			            $newcode = "<div class='item$addClass'>" . generateListing_B($isbn, mappedTitle($row['ISBN']),
			                    mappedClasses($row['ISBN'])) . $offerbutton . '</div>';
			            echo $newcode;   
			    }
            }?>
            <br />
            <p><b>Optional books:</b></p>
            <?
            $query="SELECT * FROM CMap WHERE courseId='$cId' AND required='0'";
            $resource=mysql_query($query);
            if($resource) {
                $i=0;
			    while($row=mysql_fetch_array($resource)) {
			    		$addClass = "";
			            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
			            $isbn=$row['ISBN'];
			            $offerbutton = "<p class='offers'><a href=offers.php?isbn=$isbn>See offers</a></p>";
			            $newcode = "<div class='item$addClass'>" . generateListing_B($isbn, mappedTitle($row['ISBN']),
			                    mappedClasses($row['ISBN'])) . $offerbutton . '</div>';
			            echo $newcode;   
			    }
            }
            ?>
        </div>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, Ben Chan
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->