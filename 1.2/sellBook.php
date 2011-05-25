<? require("util/header.php");
connect(true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Sell a Book</title>
    </head>
    <body>
        <? print_header(); ?>
        <h2>Sell a Book</h2>
        <form action="confirm.php" method="post">
            <table>
                <tr>
                    <td><label for="isbn"> ISBN: </label></td>
                    <td><input type="text" name="isbn" /></td>
                </tr>
                <tr>
                    <td><label for="price"> Price: </label></td>
                    <td><input type="text" name="price" /></td>
                </tr>
                <tr>
                    <td><label for="descr"> Description: </label></td>
                    <td><textarea rows="5" cols ="20" name="descr"></textarea> </td>
                </tr>
            </table>
            <input type="Submit" value="Post for sale" />
        </form>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->