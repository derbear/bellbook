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
dump();
?>