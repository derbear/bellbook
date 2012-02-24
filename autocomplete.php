<?php
require_once("util/connect.php");
connect(false);
$search = $_GET['term'];
$query = "SELECT * FROM Books WHERE lower(title) LIKE lower('%$search%')";
$resource=mysql_query($query);
if($resource) {
    $matches = array(); 
    while($row = mysql_fetch_array($resource)) {
            $title = $row['title'];
            $matches[] = $title;   
    }
    print json_encode($matches);
} else {
    print mysql_error();
}
?>
