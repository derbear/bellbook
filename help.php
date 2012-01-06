<? require("util/header.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>bellbook Help</title> <?php $pagetitle = 'bellbook Help'; ?>
    </head>
    <body>
        <? print_header() ?>
        <div id="content-title"><h2> How to Use bellbook </h2></div>
        <div>
            <p>
                bellbook is a great tool both for getting rid of your old books 
                and for finding new ones for bargain prices. If you don't know
                how to use a particular feature that bellbook offers, you can
                find some tips here. <br />
                If you still have questions and have checked this page, you can
                e-mail <a href="mailto:derek.leung12@bcp.org">Derek Leung</a>.
            </p>
            <hr />
            <h3>Buying</h3>
            <p>
                If you know the title or ISBN of the book, you can click on
                "Browse Books" on the left to see a list of all books registered
                on the bellbook book database. From there, you can click on
                "See offers" to find a list of everyone who is selling that
                book.
                <br />
                If you know the ISBN, you can also directly see the offers for
                that book by typing it into the search bar at the top of the
                page.
                <br />
                If you want to buy books for a specific course, you can visit
                the "Browse courses" tab. After selecting a course name, you can
                view a list of required and optional books for that course.
                <br />
                Once you find a good book offer, you should contact the person
                through the e-mail address displayed. If you would like to see
                other books the same person is selling, you can click on his
                name, which will show a list of those books. You can also track
                the book by clicking on the "Track" button.
            </p>
            <hr />
            <h3>Tracking</h3>
            <p>
                Tracking a book allows you monitor the status of a book that
                you're interested in buying. It currently does not have any
                other function.
                <br />
                In order to track books, you must first have an account.
                <a href="register.php">Register</a> to get one. 
            </p>
            <hr />
            <h3>Selling</h3>
            <p>
                To sell a book, you must first <a href="register.php">register
                </a> at bellbook by providing the necessary information.
                <br />
                Once you have an account, click on the "Sell a book" tab on the
                left. Enter the ISBN, price, and an (optional) description of
                the book's condition. (You can also any other notes here.)
                <br />
                If the book is not currently registered on bellbook's database,
                you will be asked to record the book's title and any required
                and optional courses. Please enter the title as accurately as
                possible, <b>including edition information</b>. This must only
                be completed once for any book ISBN.
                <br />
                You will be able to confirm your offer first. If you are trying
                to sell a book already registered and you notice that a course
                is missing, refer below to modify book information.
            </p>
            <hr />
            <h3>Modifying book data</h3>
            <p>
                If you would like to modify data for a book by adding courses
                required or optional, contact
                <a href="mailto:derek.leung12@bcp.org">Derek Leung</a>.
            </p>
        </div>
        <? require("util/footer.php"); ?>
    </body>
</html>

<!--
    Authors: Derek Leung
    Project BellBook - 1.0
    Bellarmine College Preparatory, 2011
-->