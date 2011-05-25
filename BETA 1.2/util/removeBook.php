<?php
    require("connect.php");
    connect(true);
    $id=$_POST['id'];
    $id=filter_var($id, FILTER_SANITIZE_STRING);
    $query="DELETE FROM Listings WHERE listingId=$id";

    header("Location: ../myBooks.php");
    if(mysql_query($query))
        echo 'success';
    else
        echo mysql_error();

?>