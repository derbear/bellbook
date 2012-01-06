<? require("util/header.php");
if(isset($_POST['request'])) {
    $request=true;
} else {
    $request=false;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Request a book</title> <?php $pagetitle = 'Request book'; ?>
    </head>
    <body>
        <? print_header() ?>
        <div id="content-title"><h2>Request a book</h2></div>
        <p>Note: Enter the ISBN <strong>without</strong> the dashes.</p>
        <form action="requestBook.php" method="post">
            <table>
                <tr>
                    <td><label for="isbn"> ISBN: </label></td>
                    <td><input type="text" name="isbn" /></td>
                </tr>
                <tr>
                    <td><label for="price"> Asking price (optional): </label></td>
                    <td><input type="text" name="price" /></td>
                </tr>
                <tr>
                    <td><label for="descr"> Description: </label></td>
                    <td><textarea rows="5" cols ="20" name="descr"></textarea> </td>
                </tr>
                <input type="hidden" name="request" value="1" />
            </table>
            <input type="Submit" value="Post for sale" />
        </form>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
    barely modified by Ben Chan
-->