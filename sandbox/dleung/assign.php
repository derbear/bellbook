<?php
require_once("../../util/connect.php");
connect(false);
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['isbn10'])&&isset($_POST['isbn13'])) {
    $ISBN10=$_POST['isbn10'];
    $ISBN13=$_POST['isbn13'];
    mysql_query("DELETE FROM Aliases WHERE ISBN10='$ISBN10'");
    echo "Error? " . mysql_error();
    mysql_query("DELETE FROM Aliases WHERE ISBN13='$ISBN13'");
    echo "Error? " . mysql_error();
    mysql_query("INSERT INTO Aliases Values('$ISBN10', '$ISBN13')");
    echo "Error? " . mysql_error();
}
?>
<form action="assign.php" method="post" >
    <p>ISBN-10</p><input type="text" name="isbn10" />
    <p>ISBN-13</p><input type="text" name="isbn13" />
    <input type="submit" value="Submit" />
</form>