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
        <td class='leftcol'><b>ISBN </b></td>
        <td>$fisbn</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Title </b></td>
        <td>$ftitle</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Price </b></td>
        <td>$fprice</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Date posted </b></td>
        <td>$fdate</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Notes </b></td>
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
            $fcontact, $fid, $ffname, $flname) {
        $mail="mailto:" . $fcontact;
        $account="account.php?id=$fid";
        return "
<!--listing-->
<table>
    <tr>
        <td class='leftcol'><b>ISBN </b></td>
        <td>$fisbn</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Title </b></td>
        <td>$ftitle</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Price </b></td>
        <td>$fprice</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Date posted </b></td>
        <td>$fdate</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Seller </b></td>
        <td><a href='$account'>$ffname" . " " . "$flname</a></td>
    </tr>
    <tr>
        <td class='leftcol'><b>Contact </b></td>
        <td><a href='$mail'>$fcontact</a></td>
    </tr>
    <tr>
        <td class='leftcol'><b>Notes </b></td>
        <td>$fdescr</td>
    </tr>
</table>
<!--//listing-->"; }

/**
 * Listing for books
 * @param <type> $fisbn Book ISBN
 * @param <type> $ftitle Book title
 * @param <type> $fclist (string) Array containing courses used for books
 */
function generateListing_B($fisbn, $ftitle, $fclist) {
    if($fclist=="") $clabel="";
    else $clabel="Courses ";
<<<<<<< .working
    return "
<table>
    <tr>
        <td class='leftcol'><b>ISBN </b></td>
        <td>$fisbn</td>
    </tr>
    <tr>
        <td class='leftcol'><b>Title </b></td>
        <td>$ftitle</td>
    </tr> 
    <tr>
        <td class='leftcol'><b>$clabel</b></td>
        <td>$fclist</td>
</table>
"; }
=======
    $return = "
		<div class='item-title'>$ftitle</div>
		<div class='item-isbn item-info'><p>ISBN: $fisbn</p></div>";
	if(!$clabel=="") {
		foreach($fclist as $key => $val) { 
			$return = $return . "<div class='item-course item-info'><p>$val</p></div>";
		}
	}	
	return $return;
}
>>>>>>> .merge-right.r81

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
    $query="SELECT * FROM CMap WHERE ISBN='$fisbn'";
    $resource=mysql_query($query);
    $first=true;
    $result="";
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            $cid=$row['courseId'];
            $req=false;
            if($row['required']==1) {
                $req=true;
            }
            $query2="SELECT * FROM Courses WHERE courseId='$cid'";
            $resource2=mysql_query($query2);
            if($resource2) {
                $row2=mysql_fetch_array($resource2);
                $cname=$row2['courseName'];
                if($req) $cname='<b>'.$cname.'</b>';
                if(!$first) $result=$result.', ';
                else $first=false;
                $result=$result.$cname;
            }
        }
    }
    return $result;
}
?>