<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require("../../util/connect.php");
connect(false);
$isbn=97805386903;
$isbnsec=93;
$isbn.="";
$isbn.=$isbnsec;
$tId=214281;
$lId=206;
echo $isbn;
$query="UPDATE Listings SET ISBN='$isbn' WHERE ownerId='$tId' AND listingId='$lId'";
//$query="UPDATE Listings SET ISBN='$isbn' WHERE ISBN='978013048455'";
if(!mysql_query($query)) {
    echo 'bad: '.mysql_error();
}
require("../../util/dump.php");
dump();
?>