<? require("util/header.php");
connect(false);
$id=$_GET['id'];
$query="SELECT * FROM Users WHERE studentId='$id'";
$resource=mysql_query($query);
if($resource) {
    while($row=mysql_fetch_array($resource)) {
        $firstname=$row['firstName'];
        $lastname=$row['lastName'];
        $email=$row['email'];
        $gradYr=$row['gradYr'];
    }
} else {
    header("Location: index.php?message=An error occurred");
}

if($firstname=="" || !isset($_GET['id'])) {
    header("Location: index.php?message=Invalid student ID");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title><? echo $firstname . ' ' . $lastname ?> </title>
    </head>
    <body>
        <? print_header(); ?>
        <h2> bellbook account -
        <? echo $firstname . ' ' . $lastname . "'s " . 'information' ?> </h2>
            <table>
                <tr>
                    <td>First name: </td>
                    <td><? echo $firstname ?>
                    </td>
                </tr>
                <tr>
                    <td>Last name: </td>
                    <td><? echo $lastname ?>
                    </td>
                </tr>
                <tr>
                    <td>E-mail address: </td>
                    <td><a href=<? echo '"mailto:'.$email.'"' ?>><? echo $email ?></a>
                    </td>
                </tr>
                <tr>
                    <td>Graduation year: </td>
                    <td><?echo $gradYr ?></td>
                </tr>
            </table>
        <?php
            require_once("util/listing.php");
            $query="SELECT * FROM Listings WHERE ownerId='$id'";
            $resource=mysql_query($query);
            if(!$resource) {
                echo 'Error: ' . mysql_error();
            }
            echo '<hr class="title-line"/>';
            $i=0; // this code is similar to that in browse.php and trackedBooks. One day we should make a function that does it
            while ($row=mysql_fetch_array($resource)) {
	            $addClass = "";
	            $i++; if ($i%2==0) $addClass = " color2"; //alternate colors in display
	            $newcode = "<div class='item$addClass'>" . generateListing($row['ISBN'], 
	            		mappedTitle($row['ISBN']), $row['price'],
                        $row['post'], $row['descr']) . "</div>";
	            echo $newcode;
	        }
        ?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->