<? require("util/header.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Log in</title>
    </head>
    <body>
        <? print_header(); ?>
        <div>
            <form action="util/loginProc.php" method="post" name="LoginForm"
                  id="LoginForm">
                <table>
                    <tr>
                        <td><label for="studentId"> Student ID: </label></td>
                        <td><input type='text' name='studID' value='' id='studentId'></td>
                    </tr>
                    <tr>
                        <td><label for="password"> Password: </label>
                        <td><input type='password' name='password' value='' id='password'></td>
                    </tr>
                </table>
                <input type='submit' name='submit' value='Log in'> <br />
            </form>
        </div>
        <div>
            <small> Don't have an account?
                    Get one <a href="register.php">here </a> </small>
        </div>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->