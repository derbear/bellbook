<?php
/**
 * Installs mysql tables
 * @param <type> $adUser Username of privileged user
 * @param <type> $adPwd Password of privileged user
 * @param <type> $adDb Database to install tables in
 * @param <type> $dbLoc Server address of database
 */
function install($adUser, $adPwd, $adDb, $dbLoc) {
    $ADMIN=$adUser;
    $PASSWORD=$adPwd;
    $DATABASE=$adDb;
    $DB_ADDR=$dbLoc;

    //create connection
    $con=mysql_connect($DB_ADDR, $ADMIN, $PASSWORD);
    if(!$con)
        die('Failed to connect: ' . mysql_error());
    
    //table creation sql commands
    $USER='Users (studentId int, firstName text, lastName text, email text,
        gradYr int, password text, PRIMARY KEY (studentId))';
    $BOOK='Books (ISBN char(13), title text, PRIMARY KEY (ISBN))';
    $COURSE='Courses (courseId int NOT NULL AUTO_INCREMENT, courseName text, teachers text,
        PRIMARY KEY (courseId))';
    $COURSE_BOOK_MAP='CMap (ISBN char(13), courseId int, required int,
        CONSTRAINT books_map FOREIGN KEY (ISBN) REFERENCES Books(ISBN),
        CONSTRAINT course_map FOREIGN KEY (courseId) REFERENCES Courses(courseId))';
    //optional: 1 for required, 0 for optional
    $LISTING='Listings (listingId int NOT NULL AUTO_INCREMENT, ownerId int, ISBN char(13),
        descr text, price float(99, 2), post date, PRIMARY KEY (listingId),
        FOREIGN KEY (ownerId) REFERENCES Users (studentId))';
    $LISTING_MAP='TMap (listingId int, studentId int,
        CONSTRAINT listings_map FOREIGN KEY (listingId) REFERENCES Listings(listingId),
        CONSTRAINT users_map FOREIGN KEY (studentId) REFERENCES Users(studentId))';
    $ALIAS_MAP='Aliases (ISBN10 char(10), ISBN13 char(13))';

    //delete old tables
    $table1_destroy='DROP TABLE Users';
    $table2_destroy='DROP TABLE Books';
    $table3_destroy='DROP TABLE Courses';
    $table4_destroy='DROP TABLE Listings';
    $table5_destroy='DROP TABLE CMap';
    $table6_destroy='DROP TABLE TMap';
    $table7_destroy='DROP TABLE Aliases';
    $success=mysql_select_db($DATABASE);
    $success=mysql_query($table7_destroy) && $success;
    $success=mysql_query($table6_destroy) && $success;
    $success=mysql_query($table5_destroy) && $success;
    $success=mysql_query($table4_destroy) && $success;
    $success=mysql_query($table3_destroy) && $success;
    $success=mysql_query($table2_destroy) && $success;
    $success=mysql_query($table1_destroy) && $success;
    if (!$success)
        echo '<div> Incomplete destroy: ' . mysql_error() . '</div>';
    else
        echo '<div> <em> Previous database destroyed </em> </div>';


    //actual install
    $table1_create='CREATE TABLE ' . $USER;
    $table2_create='CREATE TABLE ' . $BOOK;
    $table3_create='CREATE TABLE ' . $LISTING;
    $table4_create='CREATE TABLE ' . $COURSE;
    $table5_create='CREATE TABLE ' . $COURSE_BOOK_MAP;
    $table6_create='CREATE TABLE ' . $LISTING_MAP;
    $table6_create='CREATE TABLE ' . $ALIAS_MAP;
    
    if (!(mysql_select_db($DATABASE)
            && mysql_query($table1_create)
            && mysql_query($table2_create)
            && mysql_query($table3_create)
            && mysql_query($table4_create)
            && mysql_query($table5_create)
            && mysql_query($table6_create)
            && mysql_query($table7_create)
            ))
        die('Failed to initialize database: ' . mysql_error());
    echo '<div> <em> Database successfully created </em> </div>';
}
error_reporting(E_ALL); //TODO #set_error_reporting
ini_set("display_errors", 1); 
include("admin_config.php");
install($USER, $PASSWORD, $DATABASE, $ADDRESS);

?>