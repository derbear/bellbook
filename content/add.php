<div><noscript>You may need to enable Javascript for this page</noscript></div>
<!--
<div> <form action='proc.add.php' method='post'>
	<input type='hidden' name='finalize' value='true' />
	<input type='submit' value='Post!' />
</form> </div>
-->
<script type='text/javascript'>
var books;
var bookCount = 0;
function resetEntry() {
	// document.getElementById("numBooks").innerHTML="<input type='hidden' name='numBooks' value='" + bookCount + "' />";
	// bookCount += 1;
	document.getElementById("bookForm").innerHTML="\n<label for='entry" + bookCount + "'>ISBN</label>";
	document.getElementById("bookForm").innerHTML+="\n<input id='entry" + bookCount + "' type='text' name='entry" + bookCount + "' />";
	document.getElementById("bookForm").innerHTML+="\n<input type='submit' onclick='updateIsbn(" + bookCount + ")' value='Add' />";
	document.getElementById("bookForm").innerHTML+="\n<span id='text" + bookCount + "'> </span>";
	document.getElementById("bookForm").innerHTML+="\n<br />";
}

function updateIsbn(field) {
	var isbn = document.getElementById("entry" + field).value;
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
			document.getElementById("bookList").innerHTML+=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","process/proc.add.php?isbn="+isbn,true);
	xmlhttp.send();
	resetEntry();
}
function checkCourse(course) {

}
</script>

<div>
	<!-- <input type='hidden' name='finalize' value='false' /> -->
	<p>Add by book</p>
		<form action='#' method='get'>
		<span id='bookForm'></span>
		</form>
	<p>Add by course</p>
		<label for='courseName'>Course</label>
		<select name='courseId'> <? // TODO course option list goes here ?> </select> <input type='submit' value='Add' /> <br />
	<p>Listing information to add</p>
		<form action='process/proc.add.php' method='post'>
		<span id='numBooks'> </span>
		<span id='bookList'> </span>
		<input type='hidden' name='finalize' value='true' />
		<input type='submit' value='Post!' />
		</form> </div>
<script type='text/javascript'> resetEntry(); </script>