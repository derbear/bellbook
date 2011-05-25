<? require('util/header.php') ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Create an account</title>
    </head>
    <body>
        <? print_header(); ?>
        <div> <p> <small> Note: all passwords entered are hashed for security.
                </small> </p> </div>
        <div> <p> Please provide the following information for your account:
            </p> </div>
        <form action="util/regProc.php" method="post" name="RegForm" id="RegForm">
            <table>
                <tr>
                    <td><label for="studentId"> Student ID: </label></td>
                    <td><input type="text" name="studentId" id="studentId" /></td>
                </tr>
                <tr>
                    <td><label for="password"> Password: </label></td>
                    <td><input type="password" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td><label for="conf_password"> Confirm password: </label></td>
                    <td><input type="password" name="conf_password" id="conf_password" /></td>
                </tr>
                <tr>
                    <td><label for="firstName"> First name: </label></td>
                    <td><input type="text" name="firstName" id="firstName" /></td>
                </tr>
                <tr>
                    <td><label for="lastName"> Last name: </label></td>
                    <td><input type="text" name="lastName" id="lastName" /></td>
                </tr>
                <tr>
                    <td><label for="email"> E-mail address: </label></td>
                    <td><input type="text" name="email" id="email" /></td>
                </tr>
                <tr>
                    <td><label for="gradYr"> Graduation year: </label></td>
                    <td><input type="text" name="gradYr" id="gradYr" /></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit" />
            <!--<input type="reset" name="reset" value="Reset fields" />-->
        </form>
        <? include('util/footer.php') ?>
    </body>
</html>

<!--
    Authors: Derek Leung, David Byrd
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->