<? require("util/header.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>bellbook</title> <?php $pagetitle = 'bellbook'; ?>
    </head>
    <body>
        <? print_header() ?>
        <div id="content-title"><h2> Welcome To bellbook! </h2></div> 
        <? if (isset($_SESSION['id'])) { ?>
        <div> <p>To get started, click on one of the tabs at the left, 
				or search for a book. </p> </div>
        <? } else { ?>
        <div> <p>You can browse or search for books, but if you want to sell
                your own you will have to <a href="login.php">log in</a>
                or <a href="register.php">make an account</a>. </p> </div>
        <? } ?>
        <div>
            <p>
                Buyer beware: some courses may change to a different edition of 
                a certain book from year to year. We advise you to verify that
                you are getting the edition you want. 
            </p>
        </div>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
    barely modified by Ben Chan
-->