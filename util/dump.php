<?php
function dump() {
    require("connect.php");
    connect(false);
    error_reporting(E_ALL); //TODO #set_error_reporting
    ini_set("display_errors", 1);
//    $ALIAS_MAP='Aliases (ISBN10 char(10), ISBN13 char(13),
//        CONSTRAINT short_map FOREIGN KEY (ISBN10) REFERENCES Books(ISBN),
//        CONSTRAINT long_map FOREIGN KEY (ISBN13) REFERENCES Books(ISBN))';
//    $table6_create='CREATE TABLE ' . $ALIAS_MAP; //10-13 mappings
//    if($table6_create) {
//        echo 'good create';
//    } else {
//        echo 'bad create: '.mysql_error();
//    }
    //if(!mysql_query("UPDATE Books SET title='' WHERE courseId=$cid"))
    //    echo 'bad'.mysql_error().'<br />';
    //if(mysql_query("DROP TABLE CMap")) {
    //    echo 'good';
    //} else echo 'bad' . mysql_error();
    //if(mysql_query("DROP TABLE Courses")) {
    //    echo 'good';
    //} else echo 'bad' . mysql_error();
    //if(mysql_query("CREATE TABLE Courses (courseId int NOT NULL AUTO_INCREMENT, courseName text, teachers text,
    //        PRIMARY KEY (courseId))")) {
    //    echo 'good';
    //} else echo 'bad' . mysql_error();
    //if(mysql_query("CREATE TABLE CMap (ISBN char(10), courseId int, required int,
    //        CONSTRAINT books_map FOREIGN KEY (ISBN) REFERENCES Books(ISBN),
    //        CONSTRAINT course_map FOREIGN KEY (courseId) REFERENCES Courses(courseId))")) {
    //    echo 'good';
    //} else echo 'bad' . mysql_error();
    //$query="DELETE FROM Courses WHERE courseId='85'";
    //$resource=mysql_query($query);
    //mysql_query("DELETE FROM Courses WHERE courseId='86'");
    //mysql_query("DELETE FROM Courses WHERE courseId='87'");
    //mysql_query("DELETE FROM Courses WHERE courseId='40'");
    //mysql_query("DELETE FROM Courses WHERE courseId='41'");
    //if (mysql_query("DELETE FROM CMap")) echo 'good';
    //else echo 'bad'.mysql_error();
    //if (mysql_query("DELETE FROM Books")) echo 'good';
    //else echo 'bad'.mysql_error();
//    if(true) {/*
//        while($row=mysql_fetch_array($resource)) {
//            echo $row['ISBN'] . '::' . $row['courseId'] . '::' .
//            $row['required'] . ' ';
//            echo '<br />';
//        }*/
//    } else {
//        echo 'failed';
//    }
    //if(!mysql_query("ALTER TABLE TMap ADD CONSTRAINT users_map FOREIGN KEY Users(studentId) REFERENCES Users(studentId)")) {
    //    die('<br />bad alter'.mysql_error());
    //}
//    $query="Update Books SET ISBN='9780553212471' WHERE ISBN='978055321247'"; //Frankenstein
//    if(mysql_query($query))
//    	echo 'good';
//    else
//    	echo 'error: '. mysql_error();
//    $query="DELETE FROM Books WHERE ISBN=''"; //testdata
//    if(mysql_query($query))
//    	echo 'good';
//    else
//    	echo 'error: '. mysql_error();
//    $query="DELETE FROM CMap WHERE ISBN='1234567890'"; //testdata
//    if(mysql_query($query))
//    	echo 'good';
//    else
//    	echo 'error: '. mysql_error();
//    $query="DELETE FROM Books WHERE ISBN='978055321247'"; //Frankenstein
//    if(mysql_query($query))
//    	echo 'good';
//    else
//    	echo 'error: '. mysql_error();
//    $query="DELETE FROM Users WHERE studentId='111111'"; //bob
//    if(mysql_query($query))
//    	echo 'good';
//    else
//    	echo 'error: '. mysql_error();
//    $query="DELETE FROM Users WHERE studentId='42'"; //bro
//    if(mysql_query($query))
//    	echo 'good';
//    else
//    	echo 'error: '. mysql_error();
//    	    //$query="DELETE FROM Courses WHERE courseId='2'";
    //$resource=mysql_query($query);
    //if($resource) {
    ////    while($row=mysql_fetch_array($resource)) {
    ////        echo $row['ISBN'] . '::' . $row['courseId'] . '::' .
    ////        $row['required'] . ' ';
    ////        echo '<br />';
    ////    }
    //} else {
    //    echo 'failed';
    
	echo '<b>Users/studentId->Users/lastName, Users/firstName</b><br />';
    $query="SELECT * FROM Users";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            echo $row['studentId'] . '->' . $row['lastName'] . ', ' .
            $row['firstName'] . ' ';
            echo '<br />';
        }
    } else {
        echo 'failed';
    }/*
    $query="SELECT * FROM Listings WHERE title LIKE 'Losing%'";
    $resource=mysql_query($query);
    if($resource) {
        $row=mysql_query(mysql_fetch_array($resource));
        echo $row['title'];
        echo 'success';
    } else {
        echo 'failed' . mysql_error();
    }
    $query="DROP INDEX title ON Listings";
    if(mysql_query($query)) {
        echo 'success';
    } else {
        echo 'failed' . mysql_error();
    }*/
	echo '<b>Books/ISBN->Books/title</b><br />';
    $query="SELECT * FROM Books";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            echo '['.$row['ISBN'].']' . '->' . $row['title'];
            echo '<br />';
        }
    } else {
        echo 'failed';
    }
    //$query="INSERT INTO Courses Values('231', 'U.S. History AP', 'Sullivan, Troyan')";
    //if(mysql_query($query)) {
    //    //echo 'success';
    //}
    //else {
    //    echo 'failure: ' . mysql_error();
    //}
	echo '<b>Courses/courseId->Courses/courseName</b><br />';
    $query="SELECT * FROM Courses";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            echo $row['courseId'] . '->' . $row['courseName'];
            echo '<br />';
        }
    } else {
        echo 'failed';
    }
    //phpinfo();
	echo '<b>[Tracker]/[listing component]->[Tracker]/[owner of tracker]</b><br />';
    $query="SELECT * FROM TMap";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            echo $row['listingId'] . '::' . $row['studentId'];
            echo '<br />';
        }
    } else {
        echo 'failed';
    }
	echo "<b>[Offer]/[offer's ID]::[Offer]/[seller's ID]::[Offer]/[ISBN]</b><br />";
    $query="SELECT * FROM Listings";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            echo $row['listingId'] . '::' .$row['ownerId'] . '::' . $row['ISBN'];
            echo '<br />';
        }
    } else {
        echo 'failed';
    }
	echo "<b>[Courses]/[ISBN]::[Courses]/courseId::[Courses]/required[boolean]</b><br />";
    $query="SELECT * FROM CMap";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            echo $row['ISBN'] . '::' . $row['courseId'] . '::' .
            $row['required'] . ' ';
            echo '<br />';
        }
    } else {
        echo 'failed';
    }
}
dump();
?>