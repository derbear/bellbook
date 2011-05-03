<?php
    /**
     * Listing on myBooks
     * @return a formatted listing of the book's ISBN, title, and description.
     */
    function generateListing($fisbn, $ftitle, $fprice, $fdate, $fdescr) {
        return "
<!--listing-->
<table>
    <tr>
        <td><b>ISBN: </b></td>
        <td>$fisbn</td>
    </tr>
    <tr>
        <td><b>Title: </b></td>
        <td>$ftitle</td>
    </tr>
    <tr>
        <td><b>Price: </b></td>
        <td>$fprice</td>
    </tr>
    <tr>
        <td><b>Date posted: </b></td>
        <td>$fdate</td>
    </tr>
    <tr>
        <td><b>Notes: </b></td>
        <td>$fdescr</td>
    </tr>
</table>
<!--//listing-->
"; } 

    /**
     * Listing on search
     * @return a formatted listing of the book's seller and contact, as well as
     * its ISBN, title, and description.
     */
    function generateListing_S($fisbn, $ftitle, $fprice, $fdate, $fdescr,
            $fcontact, $ffname, $flname) {$mail="mailto:" . $fcontact;
        return "
<!--listing-->
<table>
    <tr>
        <td><b>ISBN: </b></td>
        <td>$fisbn</td>
    </tr>
    <tr>
        <td><b>Title: </b></td>
        <td>$ftitle</td>
    </tr>
    <tr>
        <td><b>Price: </b></td>
        <td>$fprice</td>
    </tr>
    <tr>
        <td><b>Date posted: </b></td>
        <td>$fdate</td>
    </tr>
    <tr>
        <td><b>Seller: </b></td>
        <td>$ffname" . " " . "$flname</td>
    </tr>
    <tr>
        <td><b>Contact: </b></td>
        <td><a href='$mail'>$fcontact</a></td>
    </tr>
    <tr>
        <td><b>Notes: </b></td>
        <td>$fdescr</td>
    </tr>
</table>
<!--//listing-->"; }

/**
 * Listing for books
 * @param <type> $fisbn Book ISBN
 * @param <type> $ftitle Book title
 * @param <type> $fcarray (string) Array containing courses used for books
 */
function generateListing_B($fisbn, $ftitle, $fcarray=array()) {
    $formatted="";
    $first=true;
    foreach($fcarray as $entry=>$value) {
        if($first) {
            $first=false;
            $formatted=$entry;
        } else {
            $formatted=$formatted . ", " . $entry;
        }
    }
    if($first) $clabel="";
    else $clabel="All courses used: ";
    return "
<table>
    <tr>
        <td><b>ISBN: </b></td>
        <td>$fisbn</td>
    </tr>
    <tr>
        <td><b>Title: </b></td>
        <td>$ftitle</td>
    </tr> 
    <tr>
        <td><b>$clabel</b></td>
        <td>$formatted</td>
</table>
"; }

/**
 * Finds the title associated with the ISBN
 * @param <type> $fisbn the ISBN from which to find the associated title
 * @return <type> the associated title, or "" if the isbn is not in the database
 */
function mappedTitle($fisbn) {
    $query="SELECT * FROM Books WHERE ISBN='$fisbn'";
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            return $row['title'];
        }
    }
    return "";
}

function mappedClasses($fisbn) {
    $arr=array('<feature not available>' => 'construction');//TODO map courses
    return $arr;
}
?>