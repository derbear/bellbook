<?php
//    $ADMIN='root';
//    $PASSWORD='bellbook'; //TODO change this
//
//    $DATABASE='Test1';

    $ADMIN='derek.leung12.admin';
    $PASSWORD='GreenSubsidy_20percent';
    $DATABASE='12_bellbook';
    $ADDRESS='localhost';

    $USER='Users (studentId int, firstName text, lastName text, email text,
        gradYr int, password text, PRIMARY KEY (studentId))';
    $BOOK='Books (ISBN int, title text, PRIMARY KEY (ISBN))'; 
    $COURSE='Courses (courseId int, courseName text, teachers text,
        PRIMARY KEY (courseId))';
    $COURSE_BOOK_MAP='CMap (ISBN int, courseId int,
        CONSTRAINT books_map FOREIGN KEY (ISBN) REFERENCES Books(ISBN),
        CONSTRAINT course_map FOREIGN KEY (courseId) REFERENCES Courses(courseId))';
    $LISTING='Listings (listingId int NOT NULL AUTO_INCREMENT, ownerId int, ISBN int,
        '/*title text,*/.' descr text, price float(99, 2), post date, PRIMARY KEY (listingId),
        FOREIGN KEY (ownerId) REFERENCES Users (studentId))';
    $LISTING_MAP='TMap (listingId int, studentId int,
        CONSTRAINT listings_map FOREIGN KEY (listingId) REFERENCES
        Listings(listingId), CONSTRAINT users_map FOREIGN KEY (studentId)
        REFERENCES Listings(studentId))'; //to track
?>
