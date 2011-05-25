<? require("util/header.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>bellbook</title>
    </head>
    <body>
        <? print_header() ?>
        <div> <p>Welcome to bellbook!</p> </div>
        <? if (isset($_SESSION['id'])) { ?>
        <div> <p>To get started, click on one of the links above, or search for
                a book. </p> </div>
        <? } else { ?>
        <div> <p>You can browse or search for books, but if you want to sell
                your own you will have to <a href="login.php">log in</a>
                or <a href="register.php">make an account</a>. </p> </div>
        <? } ?>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->