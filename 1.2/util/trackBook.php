<?php
    error_reporting(E_ALL); //TODO #set_error_reporting
    ini_set("display_errors", 1);
    $private=true;
    require_once("connect.php");
    connect(true);
    $id=$_SESSION['id'];
    $listing=$_POST['list_id'];
    $success=true;
    if ($_POST['oper'] == 1) {
        $query = "INSERT INTO TMap VALUES ('$listing', '$id')";
        $success = mysql_query($query);
        if(!$success) {
            echo ($listing . " associating " . $id . '<br />');
            die('Insertion error: '.mysql_error());
        }
    } else {
        $query="DELETE FROM TMap WHERE listingId=$listing AND studentId=$id";
        $success = mysql_query($query);
        if(!$success) {
            die('Deletion error: '.mysql_error());
        }
    }
    if (!$success) {
        die('Failed');
        echo '1';
    }
    header("Location: ../trackedBooks.php");

?>