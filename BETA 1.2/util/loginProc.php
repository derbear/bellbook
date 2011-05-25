<?php
    require_once("connect.php");
    connect(false);
    $id=$_POST['studID'];
    $entered=$_POST['password'];

	//security
	$id=filter_var($id, FILTER_SANITIZE_STRING);
	$entered=filter_var($entered, FILTER_SANITIZE_STRING);

    $hashed=crypt($entered, 'dontkillthefrogs');
    $query="SELECT * FROM Users WHERE studentId='$id'";
    $success=mysql_query($query);
    $db_password="";
    $db_arr=array();
    $failure=false;
    if($success) {
        $db_arr=mysql_fetch_array($success);
        $db_password=$db_arr['password'];
        //echo($hashed);
        //echo('<br />');
        //echo($db_password);
    } else {
        //echo 'Failed to connect <br />';
        //echo mysql_error() . '<br />';
    }
    if(strcmp($hashed, $db_password) != 0) {
        //echo 'Invalid password <br />';
        session_destroy();
        header("Location: ../login.php?message=Invalid password");
        $failure=true;
    }

    if(!$success||$failure)
        session_destroy();
    else {
        session_start();
        //variable setting
        $_SESSION['id']=$id;
        $_SESSION['firstname']=$db_arr['firstName'];
        $_SESSION['lastname']=$db_arr['lastName'];
        $_SESSION['email']=$db_arr['email'];
        //foreach ($db_arr as $attr=>$value) {
            //if (!$attr.is_numeric() && strcmp($attr, 'password') != 0) {
            //    echo $attr . ' ' . $value . '<br />';
            //    $_SESSION['$attr'] = $value;
            //} //TODO fix numeric identification
        //}
        header("Location: ../index.php?message=Welcome, " . $_SESSION['firstname']);
    }
?> <!--
<html>
    <head>
    <title>Login </title>
    </head>
    <body>
</html> -->