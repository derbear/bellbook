<?php
    $private=true;
    require("connect.php");
    connect(true);
    $isbn=$_POST["isbn"];
//    $title=$_POST["title"];
    $descr=$_POST["descr"];
    $price=$_POST["price"];
    
    //sanitization
    $isbn=filter_var($isbn, FILTER_SANITIZE_STRING);
//    $title=filter_var($title, FILTER_SANITIZE_STRING);
    $descr=filter_var($descr, FILTER_SANITIZE_STRING);
    $price=filter_var($price, FILTER_SANITIZE_STRING);

    $owner=$_SESSION['id'];

    $query="INSERT INTO Listings (ownerId, ISBN, descr, price, post)
        Values('$owner', '$isbn', '$descr', '$price', now())";
    header("Location: ../myBooks.php");
    
    if(mysql_query($query))
        echo 'success';
    else
        echo 'bad query' . mysql_error();

?>