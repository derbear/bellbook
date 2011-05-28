<?php
	/**
	 * All listings generated require enclosure using a div tag w/ class item for proper formatting.
	 * This div tag is usually added alongside the remove/see offers button that goes with listings
	 * A more ingenious solution that keeps everything in this file (instead of divs all over the place) would be useful.
	 */
	 
    /**
     * Listing on myBooks
     * @return a formatted listing of the book's ISBN, title, and description.
     */
    function generateListing($fisbn, $ftitle, $fprice, $fdate, $fdescr) {
    	$return = "
	    	<div class='item-title'>$ftitle</div>
				<div class='item-price item-info'><p>$$fprice</p></div>
				<div class='item-isbn item-info'><p>ISBN: $fisbn</p></div>
				<div class='item-date item-info'><p>Posted: $fdate</p></div>
				<div class='item-notes item-info'><p><span class='required'>Notes:</span> $fdescr</p></div>";
		return $return;
	} 

    /**
     * Listing on search
     * @return a formatted listing of the book's seller and contact, as well as
     * its ISBN, title, and description.
     */
    function generateListing_S($fisbn, $ftitle, $fprice, $fdate, $fdescr,
            $fcontact, $fid, $ffname, $flname) {
        $mail="mailto:" . $fcontact;
        $account="account.php?id=$fid";
        $return = "
        	<div class='item-title'>$ftitle</div>
				<div class='item-price item-info'><p>$$fprice</p></div>
				<div class='item-isbn item-info'><p>ISBN: $fisbn</p></div>
				<div class='item-seller item-info'><p>Seller: <a href='$account'>$ffname" . " " . "$flname</a></p></div>
				<div class='item-date item-info'><p>Posted: $fdate</p></div>
				<div class='item-contact item-info'><p>Contact: <a href='$mail'>$fcontact</a></p></div>
				<div class='item-notes item-info'><p><span class='required'>Notes:</span> $fdescr</p></div>
        ";
        return $return;
   	}

/**
 * Listing for books
 * @param <type> $fisbn Book ISBN
 * @param <type> $ftitle Book title
 * @param <type> $fclist Array containing courses used for books
 */
function generateListing_B($fisbn, $ftitle, $fclist) {
    if(count($fclist)==0) $clabel="";
    else $clabel="Courses ";
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

function mappedClasses($fisbn) { /* returns a string with courses separated by a comma and space */
    $query="SELECT * FROM CMap WHERE ISBN='$fisbn'";
    $resource=mysql_query($query);
    $first=true;
    $result=array();
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
                if($req) $cname='<span class="required">Required:</span> '.$cname;
                if(!$first);
                else $first=false;
                $result[] = $cname;
            }
        }
    }
    return $result;
}
?>