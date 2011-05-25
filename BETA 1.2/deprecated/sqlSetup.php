<?php
    if(strcmp($_POST['password'], "dontkillthefrogs") != 0)
        die("Bad password");
    require_once("dbConfig.php");
    $con=mysql_connect("localhost", $ADMIN, $PASSWORD);
    if(!$con)
        die('Failed to connect: ' . mysql_error());
    $db_drop='DROP DATABASE ' . $DATABASE;
    if(mysql_query($db_drop))
        echo '<div> <em> Previous database destroyed </em> </div>';
    $db_create='CREATE DATABASE ' . $DATABASE;
    $table1_create='CREATE TABLE ' . $USER;
    $table2_create='CREATE TABLE ' . $BOOK;
    $table3_create='CREATE TABLE ' . $LISTING;
    $table4_create='CREATE TABLE ' . $COURSE;
    $table5_create='CREATE TABLE ' . $LISTING_MAP;
    $table6_create='CREATE TABLE ' . $COURSE_BOOK_MAP;
    if (!(mysql_query($db_create) && mysql_select_db($DATABASE)
            && mysql_query($table1_create)
            && mysql_query($table2_create)
            && mysql_query($table3_create)
            && mysql_query($table4_create)
            && mysql_query($table5_create)
            && mysql_query($table6_create)))
        die('Failed to initialize database: ' . mysql_error());
    echo '<div> <em> Database successfully created </em> </div>';
?>