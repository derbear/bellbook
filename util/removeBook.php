<?php
    require("connect.php");
    connect(true);
    $id=$_POST['id'];
    $id=filter_var($id, FILTER_SANITIZE_STRING);
    $failure=false;
    $query="DELETE FROM TMap WHERE listingId=$id";
    if(!mysql_query($query)) {
        $failure=true;
    }
    $query="DELETE FROM Listings WHERE listingId=$id";
    if(!mysql_query($query)) {
        $failure=true;
    }
    if(failure) {
        header("Location: ../myBooks.php?message=Book deletion successful");
    }
    else {
        header("Location: ../myBooks.php?message=An error occurred: "
                . mysql_error());
    }
//    if(mysql_query($query))
//        echo 'success';
//    else
//        echo mysql_error();

?>