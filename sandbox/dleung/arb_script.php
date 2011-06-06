<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("../../util/dump.php");
require_once("../../util/connect.php");
connect(false);
error_reporting(E_ALL); //TODO #set_error_reporting
ini_set("display_errors", 1);

//$query="UPDATE Listings SET ISBN='0030565448' WHERE ISBN='0-03-056544-8'";
//if(mysql_query($query))
//    echo 'good';
//else
//    echo 'error: '. mysql_error();
$query="DELETE FROM CMap WHERE ISBN='1111111111333'"; //testdata
if(mysql_query($query))
    echo 'good';
else
    echo 'error: '. mysql_error();
$query="DELETE FROM Books WHERE ISBN='1111111111333'"; //testdata
if(mysql_query($query))
    echo 'good';
else
    echo 'error: '. mysql_error();
$query="DELETE FROM Aliases WHERE ISBN13='1111111111333'"; //testdata
if(mysql_query($query))
    echo 'good';
else
    echo 'error: '. mysql_error();
//$query="SELECT * FROM Books";
//$resource=mysql_query($query);
//while($row=mysql_fetch_array($resource)) {
//    $isbn=$row['ISBN'];
//    $query="SELECT * FROM Aliases WHERE ISBN10='$isbn'";
//    $present=false;
//    $resource2=mysql_query($query);
//    if($resource2) {
//        while($row2=mysql_fetch_array($resource2)) {
//            $present=true;
//        }
//    }
//    $query="SELECT * FROM Aliases WHERE ISBN13='$isbn'";
//    $present=false;
//    $resource2=mysql_query($query);
//    if($resource2) {
//        while($row2=mysql_fetch_array($resource2)) {
//            $present=true;
//        }
//    }
//    if(!$present) {
//        $query="INSERT INTO Aliases Values ";
//        if(strlen($isbn)==10) {
//            $query.=("('$isbn', '')");
//        } else if(strlen($isbn)==13) {
//            $query.=("('', '$isbn')");
//        }
//        if(mysql_query($query)) {
//            echo 'success';
//        } else {
//            echo 'failure: '.mysql_error();
//        }
//    }
//}
//$query="SELECT * FROM Aliases";
//$resource=mysql_query($query);
//while($row=mysql_fetch_array($resource)) {
//    $isbn10=$row['ISBN10'];
//    $isbn13=$row['ISBN13'];
//    $query="DELETE FROM Aliases WHERE ISBN10='$isbn10' AND ISBN13='$isbn13'";
//    if(!mysql_query($query)) {
//        echo 'Error: ' .mysql_error();
//    }
//    $query="INSERT INTO Aliases Values('$isbn10', '$isbn13')";
//    if(!mysql_query($query)) {
//        echo 'Error: ' .mysql_error();
//    }
//}
dump();
?>