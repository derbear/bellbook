<?php

    $firstName=$_POST['firstname'];
    $lastName=$_POST['lastname'];
    $email=$_POST['email'];
    $unhashed=$_POST['password']; //TODO increase security here
    $copy=$_POST['conf_password'];

    //security
    $firstName=filter_var($firstName, FILTER_SANITIZE_STRING);
    $lastName=filter_var($lastName, FILTER_SANITIZE_STRING);
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    $unhashed=filter_var($unhashed, FILTER_SANITIZE_STRING);
    $copy=filter_var($copy, FILTER_SANITIZE_STRING);

    //optional password set
    $changePass=true;
    if(strcmp($unhashed, '') == 0) {
        $changePass=false;
    }
    
    if ($changePass && strcmp($unhashed, $copy) != 0) {
        echo 'Your entered password does not match your confirmed password.';
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo $email;
        echo 'Your e-mail address is invalid.';
    }
    else {
        $hashed=crypt($unhashed, 'dontkillthefrogs');
        require_once("connect.php");
        connect(true);
        mysql_select_db($DATABASE);
        $id=$_SESSION['id'];
        $query="UPDATE Users
        SET firstName='$firstName', lastName='$lastName', email='$email'
        WHERE studentId='$id'";
        if($changePass) {
            mysql_query("UPDATE Users SET password='$hashed'
                    WHERE studentId='$id'");
        }
        $success=mysql_query($query);
        if(!$success) {
            echo 'Account update failed: ' . mysql_error();
        } else {
            session_destroy();
            session_start();
            $_SESSION['id']=$id;
            $query="SELECT * FROM Users WHERE studentId='$id'"; //TODO create function
            $success=mysql_query($query);
            $db_arr=mysql_fetch_array($success);
            $_SESSION['firstname']=$db_arr['firstName'];
            $_SESSION['lastname']=$db_arr['lastName'];
            $_SESSION['email']=$db_arr['email'];
            echo 'Account update success';
        }
    }
    header('Location: ../myAccount.php');
?>