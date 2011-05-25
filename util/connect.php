<?php function connect($private=false) {
        //connects to database and starts session
        require("dbConfig.php");
        $con=mysql_connect($ADDRESS, $ADMIN, $PASSWORD);
        if(!$con) {
            //echo 'bad connection';
            //echo mysql_error();
            die(/*'Failed to connect: ' . mysql_error()*/);
        }
        else {
            //echo 'success';
            $dbSuccess=mysql_select_db($DATABASE);
            if(!$dbSuccess) {
                die(/*'Failed to connect to database: ' . mysql_error()*/);
            } else {
                session_start();
            }
        }
        //kills if not logged in
        if($private==true && !isset($_SESSION['id'])) {
            session_destroy();
            session_start();
            header("Location: index.php?message=You must be logged in to use this" .
                    " part of the site.");
        }
    }

    function sanitize() {
        foreach($_POST as $attr=>&$value) {
            $value=filter_var($value, FILTER_SANITIZE_STRING);
        }
        foreach($_GET as $attr=>&$value) {
            $value=filter_var($value, FILTER_SANITIZE_STRING);
        }
    }
?>