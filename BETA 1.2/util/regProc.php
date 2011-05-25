<?php
    $studentId=$_POST['studentId'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $gradYr=$_POST['gradYr'];
    $unhashed=$_POST['password'];
    $copy=$_POST['conf_password'];


    //security
    $studentId=filter_var($studentId, FILTER_SANITIZE_STRING);
    $firstName=filter_var($firstName, FILTER_SANITIZE_STRING);
    $lastName=filter_var($lastName, FILTER_SANITIZE_STRING);
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    $gradYr=filter_var($gradYr, FILTER_SANITIZE_STRING);
    $unhashed=filter_var($unhashed, FILTER_SANITIZE_STRING);
    $copy=filter_var($copy, FILTER_SANITIZE_STRING);

    $result='';

    if (strcmp($unhashed, $copy) != 0) {
        //echo 'Your entered password does not match your confirmed password.';
        header("Location: ../register.php?message=Your entered password does
            not match your confirmed password.");
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //echo 'Your e-mail address is invalid.';
        header("Location: ../register.php?message=Your e-mail address is
            invalid.");
    }
    else {
        $hashed=crypt($unhashed, 'dontkillthefrogs');
        require_once("connect.php");
        connect(false);
        mysql_select_db($DATABASE);
        $query="INSERT INTO Users
        Values ('$studentId', '$firstName', '$lastName', '$email', '$gradYr',
        '$hashed')";
        $success=mysql_query($query);
        if(!$success) {
            //echo 'Account creation failed: ' . mysql_error();
            session_start();
            session_destroy();
            header("Location: ../register.php?message=Account creation failed");
        } else {
            $id=mysql_insert_id();
            $_SESSION['id']=$id;
            $_SESSION['firstname']=$db_arr['firstName'];
            $_SESSION['lastname']=$db_arr['lastName'];
            $_SESSION['email']=$db_arr['email'];
            $result='Account creation successful.';
            session_start();
            session_destroy();
            header("Location: ../index.php?message=$result");
        }
    }

?>