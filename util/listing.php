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
        $formatted=formatISBN($fisbn);
    	$return = "
	    	<div class='item-title'>$ftitle</div>
				<div class='item-price item-info'><p>$$fprice</p></div>
                                $formatted
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
        $formatted=formatISBN($fisbn);
        $return = "
        	<div class='item-title'>$ftitle</div>
				<div class='item-price item-info'><p>$$fprice</p></div>
				$formatted
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
    $formatted=formatISBN($fisbn);
    if(count($fclist)==0) $clabel="";
    else $clabel="Courses ";
    $return = "
		<div class='item-title'>$ftitle</div>
		$formatted";
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

/**
 * Given either an ISBN-10 or ISBN-13, determines which it is and finds mapped
 * counterpart, if available. 
 * @param <type> $fisbn the ISBN to look for
 * @return <type> an array with the mappings: 10->ISBN10 and 13->ISBN13. Empty
 * entries denote that Aliases table does not contain query. 
 */
function ISBNalias($fisbn) {
    $query="SELECT * FROM Aliases WHERE ";
    if(strlen($fisbn)==10) {
        $query.="ISBN10='$fisbn'";
        $arr['10']=$fisbn;
    } else if (strlen($fisbn)==13) {
        $query.="ISBN13='$fisbn'";
        $arr['13']=$fisbn;
    }
    $resource=mysql_query($query);
    if($resource) {
        while($row=mysql_fetch_array($resource)) {
            $arr['10']=$row['ISBN10'];
            $arr['13']=$row['ISBN13'];
        }
    }
    return $arr;
}

/**
 * Returns formatted ISBN-10 and ISBN-13 data
 * @param <type> $fisbn ISBN to format (unknown type)
 * @return <type> formatted ISBN
 */
function formatISBN($fisbn) {
    $isbnarr=ISBNalias($fisbn);
    $isbn13=$isbnarr['13'];
    $isbn10=$isbnarr['10'];
    $isbndata="";
    if(isset($isbn13) && strlen($isbn13)==13) {
        $isbndata.="<div class='item-isbn item-info'><p>ISBN-13: $isbn13</p></div>";
    }
    if(isset($isbn10) && strlen($isbn10)==10) {
        $isbndata.="<div class='item-isbn item-info'><p>ISBN-10: $isbn10</p></div>";
    }
    return $isbndata;
}
?>