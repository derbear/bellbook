<?php
function check_email_address($email) {
	// uses a third party object - look at EmailAddressValidator.php
	// replaces original version written by the same dude in 2004
	require('third_party_utils/EmailAddressValidator.php');
	$validator = new EmailAddressValidator;
	if ($validator->check_email_address($email)) { 
	    // Email address is technically valid
	    return true; 
	} else {
	    // Email not valid
	    return false;
	}
}

    $studentId=$_POST['studentId'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $gradYr=$_POST['gradYr'];
    $unhashed=$_POST['password'];
    $copy=$_POST['conf_password'];


    //security
//    $studentId=filter_var($studentId, FILTER_SANITIZE_STRING);
//    $firstName=filter_var($firstName, FILTER_SANITIZE_STRING);
//    $lastName=filter_var($lastName, FILTER_SANITIZE_STRING);
//    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
//    $gradYr=filter_var($gradYr, FILTER_SANITIZE_STRING);
//    $unhashed=filter_var($unhashed, FILTER_SANITIZE_STRING);
//    $copy=filter_var($copy, FILTER_SANITIZE_STRING);

    $error='';

    if (strcmp($unhashed, $copy) != 0) {
        //echo 'Your entered password does not match your confirmed password.';
        $error.="Your entered password does not match your confirmed password. ";
		//die($error);
    }
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        //echo 'Your e-mail address is invalid.';
//        error.="Your e-mail address is invalid. ";
//    }
	if(strcmp($unhashed,'')==0) {
		$error.="Please enter a password. ";
	}
	if(strcmp($studentId,'')==0||!is_numeric($studentId)||(strlen($studentId)!=6)){//STUDENT ID: if student ID is not there or is not an integer that is 6 digits long.
        $error.="Please enter a valid student ID. ";
		//die($error);
	}
//    if(!($_POST[password]==$_POST[conf_password])){//PASSWORD: must equal confirm password
//        $error.="Your password does not match your confirmed password. ";
//    }
	if(!(check_email_address($email))){//EMAIL:
        $error.="You entered an invalid email address. ";
		//die($error);
    }
	if(strcmp($firstName,'')==0) {
		$error.="Please enter your first name. ";
	}
	if(strcmp($lastName,'')==0) {
		$error.="Please enter your last name. ";
	}
	if(strcmp($gradYr,'')==0||!is_numeric($gradYr)||(strlen($gradYr)!=4)) {
		$error.="Please enter a valid graduating year. ";
	}
	
    if(strcmp($error, '') ==0) {
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
            header("Location: ../register.php?message=Account creation failed: ".mysql_error());
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
    } else {	
		header("Location: ../register.php?message=".$error);
	}