<? require("util/header.php");
connect(true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>My Account</title>
    </head>
    <body>
        <? print_header(); ?>
        <div id="content-title"><h2> Account info </h2></div>
        <form action='util/editAcc.php' method='post' name='accountInfo'
              id='accountInfo'> 
            <table>
                <tr>
                    <td>First name: </td>
                    <td><input type='text' id='firstname' name="firstname"
                               value=<? echo $_SESSION['firstname'] ?> >
                    </td>
                </tr>
                <tr>
                    <td>Last name: </td>
                    <td><input type='text' id="lastname" name="lastname"
                               value=<? echo $_SESSION['lastname'] ?> >
                    </td>
                </tr>
                <tr>
                    <td>E-mail address: </td>
                    <td><input type='text' id="email" name="email"
                               value=<? echo $_SESSION['email'] ?> >
                    </td>
                </tr>
                <tr>
                    <td>New password: </td>
                    <td><input type='password' id='password' name="password"
                               value=''>
                    </td>
                </tr>
                <tr>
                    <td>Confirm password: </td>
                    <td><input type='password' id='conf_password' 
                               name="conf_password" value=''>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Update" id="submit" >
        </form>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->