<?php
/*
 * The way this script works is that whenever a student inputs an ISBN into 
 * the ISBN field or a course into the Course field, the page sends an AJAX
 * request to proc.add.php with two GET variables: the ISBN or course ID, and
 * the index of the current entry. These indices are kept unique with the 
 * bookCount variable, which increments if the AJAX request returns information
 * on the book (indicating that it's valid). If the book is valid, its 
 * information is added to the bottom of the page in the bookList element. This
 * also includes a bunch of form input elements which are name "price" + index, 
 * "type" + index, and "description" + index. Additionally, the entire section 
 * is headed under the span element "listing" + index.
 *
 * When everything is complete, the input information is POSTed to proc.add.php
 * where the books are subsequently added to the database. The user can remove 
 * a book that they wish to sell by clicking the Remove button which will clear
 * everything under the "listing" span, hiding the book information. 
 * Additionally, it will add an additional hidden field called :removed" set to
 * true, indicating the listing has been removed.
 *
 * If the AJAX request returns an empty page, it simply displays a message
 * indicating that the ISBN was invalid. This shouldn't happen for inputs of 
 * course IDs, which are found under a drop-down list.
 */
?>
<div><noscript>You may need to enable Javascript for this page</noscript></div>
<script type='text/javascript'>
var bookCount = 0;
var valid = true; // toggle to display the string that the ISBN is invalid

/**
 * Clear the field if a valid ISBN is entered.
 */
function resetEntry() {
	document.getElementById("bookForm").innerHTML="\n<input id='entry' type='text' name='entry' /> <button type='submit' onclick='updateIsbn()'>Add</button>";
}

/**
 * Send the AJAX request.
 */
function updateIsbn() {
	var isbn = document.getElementById("entry").value;
	var xmlhttp;
	if (isbn.length==0) {
		return;
	}
	if (window.XMLHttpRequest) { // IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else { // IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) { // on complete
			var result = xmlhttp.responseText;
			if(result.length == 0) { // empty page
				if(valid) {
					document.getElementById("bookForm").innerHTML += " <i>This ISBN is invalid</i>";
					valid = false;
				}
			} else {
				resetEntry();
				bookCount++; // add another book
				document.getElementById("numBooks").innerHTML="<input type='hidden' name='count' value='" + bookCount + "' />";
				document.getElementById("bookList").innerHTML+=result;
			}
		}
	}
	xmlhttp.open("GET","process/proc.add.php?isbn="+isbn+"&index="+bookCount,true);
	xmlhttp.send();
}

/**
 * Remove a listing by wiping its entry.
 */
function removeBook(id) {
	document.getElementById("listing" + id).innerHTML = "<input type='hidden' name='removed" + id + "' value = 'true' />";
}
function checkCourse(course) {

}
</script>

<div>
	<p>Add by book</p>
		<label for='entry'>ISBN</label>
		<span id='bookForm'></span>
	<p>Add by course</p>
		<label for='courseName'>Course</label>
		<select name='courseId'> <? // TODO course option list goes here ?> </select> <input type='submit' value='Add' /> <br />
	<p>Listing information to add</p>
		<form action='process/proc.add.php' method='post'>
		<span id='numBooks'> <input type='hidden' name='count' value='0' /> </span>
		<span id='bookList'> </span>
		<input type='hidden' name='finalize' value='true' />
		<input type='submit' value='Post!' />
		</form> </div>
<script type='text/javascript'> resetEntry(); // call for initial field display </script>